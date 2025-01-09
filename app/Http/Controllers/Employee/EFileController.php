<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\File;
use App\Models\User;
use App\Models\Folder;
use App\Models\SubFolder;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Illuminate\Support\Facades\Log;
use Auth;
use Hash;
use DB;


class EFileController extends Controller
{   
    //home page
public function home(Request $request)
{
    // Get Role Access Permissions for the current user
    $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add', 'role_accesses.view', 'role_accesses.update', 'role_accesses.delete', 'permissions.name as per_name')
        ->join('employee_details', 'employee_details.job_role_id', 'role_accesses.role_id')
        ->leftJoin('permissions', 'permissions.id', 'role_accesses.permission_id')
        ->where('employee_details.user_id', Auth::user()->id)
        ->where(function($query) {
            $query->whereNotNull('role_accesses.view')
                ->orWhereNotNull('role_accesses.add')
                ->orWhereNotNull('role_accesses.update')
                ->orWhereNotNull('role_accesses.delete');
        })
        ->get()
        ->toArray();
    $employees = User::select('first_name', 'id', 'last_name', 'profile_img')->where('type', 4)->get();

    $canViewFiles = array_search('File', array_column($RoleAccess, 'per_name')) !== false &&
                    $RoleAccess[array_search('File', array_column($RoleAccess, 'per_name'))]['view'] == 1;

    if ($canViewFiles) {
        $userId = Auth::user()->id;

        $files = File::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(10);

        $folders1 = Folder::where('employee_id', $userId)->get();
        $folders2 = Folder::where('share_ids', $userId)->get();
        $folders = $folders1->merge($folders2);

        $department_folders = SubFolder::where('user_id', $userId)->get();
        $shared_department_folders = SubFolder::where('share_ids', $userId)->get();
        $all_department_folders = $department_folders->merge($shared_department_folders);

        $subFolders = SubFolder::where('user_id', $userId)->get();

        $allFolders = Folder::where('employee_id', $userId)->orderBy('created_at', 'desc')->get();

        $adminShared = Folder::where('share_ids', $userId)->get();
        $recentFiles = File::where('user_id', $userId)->orderBy('created_at', 'desc')->take(5)->get();
        $docxCount = File::where('user_id', $userId)->where('type', 'document')->count();
       
        // Calculate disk usage
        $directory = public_path('images/filemanagement');
        $diskUsage = $this->getDirectorySize($directory);

        // Format sizes and percentages for each file type
        $formattedSize = $this->formatFileSize(array_sum($diskUsage));

        // Initialize counts for file types
        $imageCount = $diskUsage['image'] ?? 0;
        $videoCount = $diskUsage['video'] ?? 0;
        $audioCount = $diskUsage['audio'] ?? 0;
        $documentCount = $diskUsage['document'] ?? 0;

        // Calculate sizes and percentages for each file type
        $totalSize = array_sum($diskUsage);
        $imageSizeFormatted = $this->formatFileSize($diskUsage['image']);
        $videoSizeFormatted = $this->formatFileSize($diskUsage['video']);
        $audioSizeFormatted = $this->formatFileSize($diskUsage['audio']);
        $documentSizeFormatted = $this->formatFileSize($diskUsage['document']);

        $imagePercentage = $videoPercentage = $audioPercentage = $documentPercentage = 0;
        if ($totalSize > 0) {
            $imagePercentage = ($diskUsage['image'] / $totalSize) * 100;
            $videoPercentage = ($diskUsage['video'] / $totalSize) * 100;
            $audioPercentage = ($diskUsage['audio'] / $totalSize) * 100;
            $documentPercentage = ($diskUsage['document'] / $totalSize) * 100;
        }

        $sub_folders = SubFolder::leftJoin('folders', 'folders.id', 'sub_folders.folder_id')
            ->where('sub_folders.user_id', $userId)
            ->select('sub_folders.*', 'folders.folder_name as folder_name')
            ->get();

        $recent_files = File::where('sub_folder_id', 0)->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')->take(5)->get();
        $all_Files = File::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        $files = File::where('user_id', Auth::user()->id)->get();
        $shared_folders = SubFolder::whereNotNull('share_ids')->where('user_id', Auth::user()->id)->get();
        // Retrieve file types
            $imgFile = File::where('user_id', Auth::user()->id)->where('type', 'image')->get();
            $docFile = File::where('user_id', Auth::user()->id)->where('type', 'document')->get();
            $audioFile = File::where('user_id', Auth::user()->id)->where('type', 'audio')->get();
            $videoFile = File::where('user_id', Auth::user()->id)->where('type', 'video')->get();
        return view('Employee.Humanesources.File.home', compact(
            'adminShared', 'folders', 'subFolders', 'formattedSize','imgFile','videoFile','audioFile','docFile', 'docxCount', 'allFolders',
            'employees', 'recentFiles', 'files', 'imageCount', 'videoCount', 'audioCount', 'documentCount',
            'imageSizeFormatted', 'videoSizeFormatted', 'audioSizeFormatted', 'documentSizeFormatted',
            'imagePercentage', 'videoPercentage', 'shared_folders', 'audioPercentage', 'documentPercentage',
            'department_folders', 'all_department_folders', 'sub_folders', 'recent_files'
        ));
    }

    // If the user doesn't have permission to view files, redirect or show an error
    return redirect()->back()->with('error', 'You do not have permission to view files.');
}
    
    //to view list of all files or show all files
    public function getAllFiles(Request $request)
    {
    $employees = User::select('first_name', 'id', 'last_name', 'profile_img')->where('type', 4)->get();

            $files = File::where('user_id',Auth::user()->id)->get();
             return view('Employee.Humanesources.File.allFiles', compact('files','employees'));
   
    }

function getDirectorySize($directory)
{
    $sizes = [
        'image' => 0,
        'document' => 0,
        'video' => 0,
        'audio' => 0
    ];

    if (is_dir($directory)) {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $filePath = $file->getPathname();
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $fileSize = $file->getSize();

                // Update size based on file type
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg'])) {
                    $sizes['image'] += $fileSize;
                } elseif (in_array($extension, ['doc', 'docx', 'pdf', 'txt'])) {
                    $sizes['document'] += $fileSize;
                } elseif (in_array($extension, ['mp4', 'avi', 'mkv'])) {
                    $sizes['video'] += $fileSize;
                } elseif (in_array($extension, ['mp3'])) {
                    $sizes['audio'] += $fileSize;
                }
            }
        }
    }

    return $sizes;
}

function formatFileSize($size)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $unitIndex = 0;
    while ($size >= 1024 && $unitIndex < count($units) - 1) {
        $size /= 1024;
        $unitIndex++;
    }

    return round($size, 2) . ' ' . $units[$unitIndex];
}
     public function updateSubFolder(Request $request)
        {
            //return $request->all();
            // Validate the incoming request data
            $request->validate([
                'folder_id' => 'required',
                'folder_name' => 'required|string|max:255',
            ]);
        
            $folder = SubFolder::find($request->folder_id);
            if ($folder) {
                $previousFolderName = $folder->sub_folder_name;
                $Folder_id = $folder->folder_id;
                $ParentFolder = Folder::find($Folder_id);
                $previousFolderPath = public_path('images/filemanagement/' .$ParentFolder->folder_name.'/'. $previousFolderName);
                
                $SubfolderName = $this->formatFolderName($request->folder_name);

                $newFolderPath = public_path('images/filemanagement/' .$ParentFolder->folder_name.'/'. $SubfolderName);
            if ($previousFolderName != $SubfolderName) {
                    if (FileFacade::exists($previousFolderPath)) {
                        FileFacade::move($previousFolderPath, $newFolderPath);
                    } else {
                        FileFacade::makeDirectory($newFolderPath, 0755, true);
                    }
                }
                                $folder->sub_folder_name = $SubfolderName;

                        $folder->save();

                // Redirect back with a success message
                return redirect()->back()->with('message', 'Sub Folder has been updated successfully.');
            }
        
            // Redirect back with an error message if the folder is not found
            return redirect()->back()->withErrors(['folder_id' => 'Folder not found']);
        }

 public function deleteSubFolder($id)
    {
       
    $folder = SubFolder::find($id);
    $Mainfolder = Folder::find($folder->folder_id);

    if (!$folder) {
        return response()->json(['success' => false, 'message' => 'Folder not found.']);
    }

    // Delete the folder from the filesystem
    $folderPath = public_path('images/filemanagement/'. $Mainfolder->folder_name .'/'. $folder->sub_folder_name);

    if (FileFacade::exists($folderPath)) {
        FileFacade::deleteDirectory($folderPath);
    }

    // Delete the folder from the database
    $folder->delete();

    return response()->json(['success' => true, 'message' => 'Folder deleted successfully.']);
}    


private function countAndSizeFiles($files)
{
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    $videoExtensions = ['mp4', 'avi', 'mkv'];
    $audioExtensions = ['mp3'];

    $imageCount = 0;
    $videoCount = 0;
    $audioCount = 0;
    $documentCount = 0;

    $imageSize = 0;
    $videoSize = 0;
    $audioSize = 0;
    $documentSize = 0;

    foreach ($files as $file) {
        if (file_exists(public_path($file->documents))) {
            $extension = strtolower(pathinfo($file->documents, PATHINFO_EXTENSION));
            if (in_array($extension, $imageExtensions)) {
                $imageCount++;
                $imageSize += filesize(public_path($file->documents));
            } elseif (in_array($extension, $videoExtensions)) {
                $videoCount++;
                $videoSize += filesize(public_path($file->documents));
            } elseif (in_array($extension, $audioExtensions)) {
                $audioCount++;
                $audioSize += filesize(public_path($file->documents));
            } else {
                $documentCount++;
                $documentSize += filesize(public_path($file->documents));
            }
        }
    }

    return [$imageCount, $videoCount, $audioCount, $documentCount, $imageSize, $videoSize, $audioSize, $documentSize];
}

private function formatFileSiz($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

private function getDirectorySiz($directory)
{
    $size = 0;
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file) {
        $size += $file->getSize();
    }
    return $size;
}



 public function home2Old(Request $request)
    {
    $folders = Folder::all();
    $all_folders = Folder::orderBy('created_at', 'desc')->get();
    $department_folders = Folder::whereBetween('id', [1, 5])->get();
   

    $recent_files = File::orderBy('created_at', 'desc')->take(5)->get();
    $files = File::all();
    $employees = User::select('first_name', 'id', 'last_name', 'profile_img')->where('type', 4)->get();

    // Count the different types of files
    $docxCount = File::where('documents', 'like', '%.docx')->count();
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    $imageCount = File::where(function($query) use ($imageExtensions) {
        foreach ($imageExtensions as $extension) {
            $query->orWhere('documents', 'like', '%.' . $extension);
        }
    })->count();

    $videoExtensions = ['mp4', 'avi', 'mkv'];
    $videoCount = File::where(function($query) use ($videoExtensions) {
        foreach ($videoExtensions as $extension) {
            $query->orWhere('documents', 'like', '%.' . $extension);
        }
    })->count();

    $audioExtensions = ['mp3'];
    $audioCount = File::where(function($query) use ($audioExtensions) {
        foreach ($audioExtensions as $extension) {
            $query->orWhere('documents', 'like', '%.' . $extension);
        }
    })->count();

     return view('Employee.Humanesources.File.home', compact('shared_folders','folders', 'employees', 'recent_files', 'files', 'docxCount', 'imageCount', 'videoCount', 'audioCount','department_folders','all_folders'));
}

//to share folder
   public function shareFolder(Request $request)
    {
    $folder_id = $request->folder_id;
    $emp_ids = $request->share_employee_id;
    $folder = Folder::find($folder_id);
    
    // Get the existing shared IDs from the folder
    $existing_ids = $folder->share_ids ? explode(',', $folder->share_ids) : [];

    // Merge existing IDs with new IDs and remove duplicates
    $new_ids = array_unique(array_merge($existing_ids, $emp_ids));

    // Update the share_ids column
    $folder->share_ids = implode(',', $new_ids);
    $folder->save();

    return redirect()->back()->with('message', 'Folder Shared successfully.');
} 
public function shareSubFolder(Request $request)
    {
        $folder_id = $request->folder_id;
        $emp_ids = $request->share_sub_employee_id;
        $folder = SubFolder::find($folder_id);
        // Get the existing shared IDs from the folder
        $existing_ids = $folder->share_ids ? explode(',', $folder->share_ids) : [];
         
        // Merge existing IDs with new IDs and remove duplicates
        $new_ids = array_unique(array_merge($existing_ids, $emp_ids));
    
        // Update the share_ids column
        $folder->share_ids = implode(',', $new_ids);
        $folder->save();
    
        return redirect()->back()->with('message', 'Folder Shared successfully.');
} 
//to share File
   public function sharefile(Request $request)
    {
    $folder_id = $request->file_id;
    $emp_ids = $request->share_ids;
    $folder = File::find($folder_id);
    
    // Get the existing shared IDs from the folder
    $existing_ids = $folder->share_ids ? explode(',', $folder->share_ids) : [];

    // Merge existing IDs with new IDs and remove duplicates
    $new_ids = array_unique(array_merge($existing_ids, $emp_ids));

    // Update the share_ids column
    $folder->share_ids = implode(',', $new_ids);
    $folder->save();

    return redirect()->back()->with('message', 'File Shared successfully.');
} 

    //to store folder name in table
    
    public function storeFolder(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);

        // Retrieve all request data
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        $folder = Folder::create($data);

        $folderPath = public_path('images/filemanagement/' . $data['folder_name']);

        if (!FileFacade::exists($folderPath)) {
            // Create the folder
            FileFacade::makeDirectory($folderPath, 0755, true);
        }

        // Redirect back with a success message
        return redirect()->back()->with('message', 'New folder has been created successfully.');
    }
    
    //make sub folder under folder
public function storeSubFolder(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'folder_id' => 'required', // Ensure folder exists
        'sub_folder_name' => 'required|string|max:255',
    ]);

    $emp_ids = $request->has('share_ids') ? implode(",", $request->share_ids) : null;
    $folder = Folder::find($request->folder_id);
      $folderName = $this->formatFolderName($folder->folder_name);
    $parentFolderPath = public_path('images/filemanagement/' . $folderName);
    if (!FileFacade::exists($parentFolderPath)) {
        FileFacade::makeDirectory($parentFolderPath, 0755, true);
    }

    $data = $request->all();
    $data['user_id'] = Auth::user()->id;
    $data['share_ids'] = $emp_ids;

        $SubfolderName = $this->formatFolderName($data['sub_folder_name']);


    // Create the new sub-folder entry in the database
    $subFolder = new SubFolder();
    $subFolder->sub_folder_name = $SubfolderName;
    $subFolder->folder_id = $folder->id; // Assuming you have a folder_id column for sub-folder relationships
    $subFolder->user_id = $data['user_id'];
    $subFolder->share_ids = $data['share_ids'];
    $subFolder->save();

    // Define the full path for the new sub-folder
    $subFolderPath = $parentFolderPath . '/' . $SubfolderName;

    // Ensure the sub-folder exists in the filesystem
    if (!FileFacade::exists($subFolderPath)) {
        // Create the sub-folder
        FileFacade::makeDirectory($subFolderPath, 0755, true);
    }

    // Redirect back with a success message
    return redirect()->back()->with('message', 'New sub-folder has been created successfully.');
}
// Helper function to format folder name
private function formatFolderName($folderName)
{
    // Replace spaces with underscores
    $folderName = str_replace(' ', '_', $folderName);
    // Replace hyphens with underscores
    $folderName = str_replace('-', '_', $folderName);
    // Replace any consecutive underscores with a single underscore
    $folderName = preg_replace('/_+/', '_', $folderName);
    return $folderName;
}

public function Upload($StorageSetting, $file, $basePath)
{
    config([
        'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
        'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
        'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
        'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
    ]);

    // Upload the file to S3 with the specified path
    Storage::disk('s3')->put($basePath, file_get_contents($file));
    // Generate the URL using the specified path
    $url = $StorageSetting->S3_BASE_URL . '/' . $basePath;
    return $url;
}

public function storeFile(Request $request)
{

    $uploadedFile = $request->file('file');
    // $folderPath = public_path('images/filemanagement/');
    $folder_id = 0;
    $sub_folder_id = 0;
    $folderName = '';
    $SubfolderName = '';
    
    


    $StorageSetting = StorageSetting::find(1);
    $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
    $extension = $uploadedFile->getClientOriginalExtension();
    $mimeType = $uploadedFile->getClientMimeType();
if ($StorageSetting->status == 0) 
    {
        $folderPath = public_path('images/filemanagement/');
    
     if ($request->sub_folder_id) {
            $sub_folder = SubFolder::find($request->sub_folder_id);
            $folder_id = $sub_folder->folder_id;
            $folder = Folder::find($folder_id);
            $folderName = $this->formatFolderName($folder->folder_name);
            $SubfolderName = $this->formatFolderName($sub_folder->sub_folder_name);
            $folderPath = 'images/filemanagement/' . $folderName . '/' . $SubfolderName;
        } elseif ($request->folder_id) {
            $folder_id = $request->folder_id;
            $folder = Folder::find($folder_id);
            if ($folder) {
                $folderName = $this->formatFolderName($folder->folder_name);
                $folderPath = 'images/filemanagement/' . $folderName;
            }
        }
        if (!FileFacade::exists($folderPath))
        {
            FileFacade::makeDirectory($folderPath, 0755, true);
        }
       // return $request->all();

        $uploadedFile->move(public_path($folderPath), $fileName);

        $url = url('/').'/public/'.$folderPath.'/'.$fileName;
}if ($StorageSetting->status == 1) {
        if ($request->sub_folder_id) {
            $sub_folder = SubFolder::find($request->sub_folder_id);
            $folder_id = $sub_folder->folder_id;
            $folder = Folder::find($folder_id);
            $folderName = $this->formatFolderName($folder->folder_name);
            $SubfolderName = $this->formatFolderName($sub_folder->sub_folder_name);
            $folderPath = 'images/filemanagement/' . $folderName . '/' . $SubfolderName . '/' . $fileName;
        } elseif ($request->folder_id) {
            $folder_id = $request->folder_id;
            $folder = Folder::find($folder_id);
            if ($folder) {
                $folderName = $this->formatFolderName($folder->folder_name);
                $folderPath = 'images/filemanagement/' . $folderName . '/' . $fileName;
            }
        } else {
            $folderPath = 'images/filemanagement/' . $fileName;
        }
        // Log::info('Folder path:', ['folderPath' => $folderPath]);

        $url = $this->Upload($StorageSetting, $uploadedFile, $folderPath);

    }
  
   
    
    $emp_ids = $request->has('share_ids') ? implode(",", $request->share_ids) : null;
    $sub_folder_id = $request->sub_folder_id ?? 0;

  
    // if (!FileFacade::exists($folderPath)) {
    //     FileFacade::makeDirectory($folderPath, 0755, true);
    // }

    // $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
    // $uploadedFile->move($folderPath, $fileName);
    // $extension = $uploadedFile->getClientOriginalExtension();
    // $mimeType = $uploadedFile->getClientMimeType();

    $type = '';
    switch ($mimeType) {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
        case 'image/svg+xml':
            $type = 'image';
            break;
        case 'application/pdf':
        case 'application/msword':
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
        case 'application/vnd.ms-excel':
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
        case 'text/plain':
            $type = 'document';
            break;
        case 'audio/mpeg':
        case 'audio/mp3':
            $type = 'audio';
            break;
        case 'video/mp4':
        case 'video/x-msvideo':
        case 'video/x-matroska':
            $type = 'video';
            break;
        default:
            $type = 'other';
            break;
    }
    //   // Adjust the document path based on folder_id and sub_folder_id
    // $documentsPath = 'images/filemanagement/';
    // if ($folder_id) {
    //     $documentsPath .= $folderName . '/';
    // }
    // if ($sub_folder_id) {
    //     $documentsPath .= $SubfolderName . '/';
    // }
    // $documentsPath .= $fileName;


    $fileData = [
        'folder_id' => $folder_id,
        'sub_folder_id' => $sub_folder_id,
        'share_ids' => $emp_ids,
        // 'document_name' => $request->document_name,
        'document_name' => $fileName,
        'file_name' => $fileName,
        'documents' => $url,
        'user_id' => Auth::user()->id,
        'type' => $type
    ];

    // Ensure the file entry is saved to the database
    File::create($fileData);

    // Redirect back with a success message
    return redirect()->back()->with('message', 'File has been uploaded and stored successfully.');
}



public function storeFilesOld(Request $request)
{
    
    $uploadedFile = $request->file('file');
    
    if($request->sub_folder_id){
     $sub_folder = SubFolder::find($request->sub_folder_id);   
     $folder_id = $sub_folder->folder_id;
       $folder = Folder::find($folder_id);
       
        $folderName = $this->formatFolderName($folder->folder_name);
        $SubfolderName = $this->formatFolderName($sub_folder->sub_folder_name);
        
        $folderPath = public_path('images/filemanagement/' . $folderName .'/'.$SubfolderName);
    }else{
        $folder_id = $request->folder_id;
          $folder = Folder::find($folder_id);
         if($folder){
            $folderPath = public_path('images/filemanagement/' .$folderName);
        }else{
                $folderPath = public_path('images/filemanagement/');
        }
    }
  
    
    if (!FileFacade::exists($folderPath)) {
        FileFacade::makeDirectory($folderPath, 0755, true);
    }

    $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

    $uploadedFile->move($folderPath, $fileName);
    $extension = $uploadedFile->getClientOriginalExtension();
    $mimeType = $uploadedFile->getClientMimeType();
    Log::info("Uploaded file extension: $extension, MIME type: $mimeType");
    $type = '';
  switch ($mimeType) {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
        case 'image/svg+xml':
            $type = 'image';
            break;
        case 'application/pdf':
        case 'application/msword':
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
        case 'application/vnd.ms-excel':
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
        case 'text/plain':
            $type = 'document';
            break;
        case 'audio/mpeg':
        case 'audio/mp3':
            $type = 'audio';
            break;
        case 'video/mp4':
        case 'video/x-msvideo':
        case 'video/x-matroska':
            $type = 'video';
            break;
        default:
            $type = 'other';
            break;
    }
    $emp_ids = $request->has('share_ids') ? implode(",", $request->share_ids) : null;
    $sub_folder_id = $request->sub_folder_id ?? 0;
    if($folder){
             $document =  'images/filemanagement/' . $folder->folder_name . '/' . $fileName;
    }else{
             $document =  'images/filemanagement/' . $fileName;
    }

    $fileData = [
        'folder_id' => $folder_id,
        'sub_folder_id' => $sub_folder_id,
        'share_ids' => $emp_ids,
        'document_name' => $request->document_name,
        'file_name' => $fileName,
        'documents' =>$document,
        'user_id' => Auth::user()->id,
        'type' => $type
    ];

    // Ensure the file entry is saved to the database
    File::create($fileData);

    // Redirect back with a success message
    return redirect()->back()->with('message', 'File has been uploaded and stored successfully.');
}

    public function getEmployeesByDepartment(Request $request)
    {
        $departmentId = $request->folder_id;
          if ($departmentId >= 1 && $departmentId <= 5) {
            $employees = User::leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                ->select('users.id', 'users.first_name', 'users.last_name')
                ->where('users.type', 4)
                ->where('employee_details.department_id', $departmentId) // Fixed the double $
                ->get();
        } else {
            $employees = User::select('id', 'first_name', 'last_name')
                ->where('type', 4)
                ->get();
        }
    
        return response()->json($employees);
    }



     public function storeFileold2(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'folder_id' => 'required|integer|exists:folders,id',
            'employee_id' => 'nullable|array', // Change to nullable array since it's optional and can contain multiple values
            'document_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,svg,pdf,doc,docx,xls,xlsx,mp3,mp4,avi,mkv,txt|max:20480' // 20MB max size
        ]);
    
        // Process the employee IDs
        $empid = $request->has('employee_id') ? implode(",", $request->employee_id) : null;
    
        // Retrieve the uploaded file
        $uploadedFile = $request->file('file');
    
        // Validate the uploaded file
        if (!$uploadedFile || !$uploadedFile->isValid()) {
            return redirect()->back()->withErrors(['file' => 'Invalid file upload']);
        }
    
        // Retrieve the selected folder
        $folder = Folder::find($request->folder_id);
    
        // Ensure the folder exists
        if (!$folder) {
            return redirect()->back()->withErrors(['folder_id' => 'Folder not found']);
        }
    
        // Define the path where the new file should be stored
        $folderPath = public_path('images/filemanagement/' . $folder->folder_name);
    
        // Ensure the folder exists in the filesystem
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }
    
        // Generate a unique file name to avoid collisions
        $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
        
        // Move the file to the specified folder
        $uploadedFile->move($folderPath, $fileName);
    
        // Create the file record in the database
        $fileData = [
            'folder_id' => $request->folder_id,
            'employee_id' => $empid,
            'document_name' => $request->document_name,
            'file_name' => $fileName,
            'documents' => 'images/filemanagement/' . $folder->folder_name . '/' . $fileName,
            'user_id' => Auth::user()->id,
        ];
    
        // Ensure the file entry is saved to the database
        File::create($fileData);
    
        // Redirect back with a success message
        return redirect()->back()->with('message', 'File has been uploaded and stored successfully.');
    }


//to view selected file under selected folder
    public function folderFileView($id)
    {
    $file = File::find($id);

    if (!$file) {
        return response()->json(['error' => 'File not found.'], 404);
    }

    // Get the file path
    $filePath = public_path($file->documents);

    // Check if the file exists
    if (!file_exists($filePath)) {
        return response()->json(['error' => 'File not found.'], 404);
    }

    // Get the file extension
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

    // Set the appropriate content type
    $contentType = '';
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
        case 'svg':
            $contentType = 'image/' . $extension;
            break;
        case 'pdf':
            $contentType = 'application/pdf';
            break;
        case 'doc':
        case 'docx':
            $contentType = 'application/msword';
            break;
        case 'xls':
        case 'xlsx':
            $contentType = 'application/vnd.ms-excel';
            break;
        case 'txt':
            $contentType = 'text/plain';
            break;
        case 'mp3':
            $contentType = 'audio/mpeg';
            break;
        case 'mp4':
            $contentType = 'video/mp4';
            break;
        case 'avi':
            $contentType = 'video/x-msvideo';
            break;
        case 'mkv':
            $contentType = 'video/x-matroska';
            break;
        default:
            $contentType = 'application/octet-stream';
            break;
    }

    // If it's an image, display it in the browser
    if (strpos($contentType, 'image') !== false) {
        return response()->file($filePath, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="' . $file->document_name . '"'
        ]);
    }

    // For other file types, force download
    return response()->download($filePath, $file->document_name, [
        'Content-Type' => $contentType
    ]);
}



    public function updateFolder(Request $request)
        {
            // Validate the incoming request data
            $request->validate([
                'folder_id' => 'required|integer|exists:folders,id',
                'folder_name' => 'required|string|max:255',
            ]);
        
            // Find the folder by ID
            $folder = Folder::find($request->folder_id);
        
            if ($folder) {
                // Previous folder name
                $previousFolderName = $folder->folder_name;
        
                // Update the folder's name
                $folder->folder_name = $request->folder_name;
                $folder->save();
        
                // Define the previous and new folder paths
                $previousFolderPath = public_path('images/filemanagement/' . $previousFolderName);
                $newFolderPath = public_path('images/filemanagement/' . $request->folder_name);
        
                // Rename the folder directory if the name has changed
                if ($previousFolderName !== $request->folder_name) {
                    if (FileFacade::exists($previousFolderPath)) {
                        FileFacade::move($previousFolderPath, $newFolderPath);
                    } else {
                        FileFacade::makeDirectory($newFolderPath, 0755, true);
                    }
                }
        
                // Redirect back with a success message
                return redirect()->back()->with('message', 'Folder has been updated successfully.');
            }
        
            // Redirect back with an error message if the folder is not found
            return redirect()->back()->withErrors(['folder_id' => 'Folder not found']);
        }
        
       public function deleteFolder($id)
    {
    $folder = Folder::find($id);

    if (!$folder) {
        return response()->json(['success' => false, 'message' => 'Folder not found.']);
    }

    // Delete the folder from the filesystem
    $folderPath = public_path('images/filemanagement/' . $folder->folder_name);

    if (FileFacade::exists($folderPath)) {
        FileFacade::deleteDirectory($folderPath);
    }

    // Delete the folder from the database
    $folder->delete();

    return response()->json(['success' => true, 'message' => 'Folder deleted successfully.']);
}    


    public function deleteFolderFiles($id)
        {
            $folder = File::find($id);
            $folder->delete();
    
            return response()->json(['success' => true, 'message' => 'files deleted successfully.']);
}

//to get list of all files under selected folder
    public function getFolderFiles($id)
    {
       
            $folder = Folder::findOrFail($id);
            $files = File::
                leftjoin('folders','folders.id','files.folder_id')->where('files.folder_id', $id)->where('files.user_id', Auth::user()->id)->select('files.*','folders.folder_name')->get();

                   return response()->json($files);
           
       
    }
    
    //to view list of all files under selected folder

public function viewFolderFiles($id)
{
    $folder = Folder::findOrFail($id);
    $authUserId = Auth::id(); // Assuming you are using Laravel's Auth facade for user authentication

    // Retrieve employees
    $employees = User::select('first_name','last_name', 'id')->where('type', 4)->get();

    // Retrieve subfolders for the given folder
   $sub_folder = SubFolder::where('folder_id', $id)
                        ->where(function($query) use ($folder, $authUserId) {
                            $query->where('user_id', $authUserId) // Subfolders created by the logged-in user
                                  ->orWhere(function($subQuery) use ($authUserId) {
                                      $subQuery->where('user_id', '!=', $authUserId) // Subfolders not created by the logged-in user
                                               ->where(function($innerQuery) use ($authUserId) {
                                                   $innerQuery->whereRaw("FIND_IN_SET(?, share_ids)", [$authUserId]); // Subfolders shared with the logged-in user
                                               });
                                  });
                        })
                        ->get();


    // Retrieve files in the folder
    $files = File::leftJoin('folders', 'folders.id', '=', 'files.folder_id')
                ->where('files.folder_id', $id)
                ->where(function($query) use ($authUserId) {
                    $query->where('files.user_id', $authUserId)
                          ->orWhereJsonContains('files.share_ids', $authUserId);
                })
                ->where('files.sub_folder_id', 0)
                ->select('files.*', 'folders.folder_name')
                ->get();

    // Retrieve shared permissions for the logged-in employee
    $sharedFiles = DB::table('shared_files')
                     ->where('emp_id', $authUserId)
                     ->pluck('permissions', 'file_id');

    // Add permissions to each file
    foreach ($files as $file) {
        $file->user_permissions = isset($sharedFiles[$file->id]) ? $sharedFiles[$file->id] : '';
    }

    // Retrieve all folders
    $folders = Folder::all();

    // Pass data to the view
    return view('Employee.Humanesources.File.folderFiles', compact('files', 'folder', 'folders', 'employees', 'sub_folder'));
}

public function viewFolderFilesOld1($id)
{
    $folder = Folder::findOrFail($id);
    $authUserId = Auth::id(); // Assuming you are using Laravel's Auth facade for user authentication

    // Retrieve employees
    $employees = User::select('first_name','last_name', 'id')->where('type', 4)->get();

    // Retrieve subfolders for the given folder
    $sub_folder = SubFolder::where('folder_id', $id)
                            ->where(function($query) use ($folder, $authUserId) {
                                $query->where('user_id', $folder->user_id)
                                    ->orWhere('user_id', $authUserId)
                                    ->orWhere('share_ids', $authUserId)
                                    ->orWhereJsonContains('share_ids', $authUserId);
                            })
                            ->get();

    // Retrieve files in the folder
    $files = File::leftJoin('folders', 'folders.id', '=', 'files.folder_id')
                ->where('files.folder_id', $id)
                ->where(function($query) use ($authUserId) {
                    $query->where('files.user_id', $authUserId)
                          ->orWhereJsonContains('files.share_ids', $authUserId);
                })
                ->where('files.sub_folder_id', 0)
                ->select('files.*', 'folders.folder_name')
                ->get();

    // Retrieve shared permissions for the logged-in employee
    $sharedFiles = DB::table('shared_files')
                     ->where('emp_id', $authUserId)
                     ->pluck('permissions', 'file_id');

    // Add permissions to each file
    foreach ($files as $file) {
        $file->user_permissions = isset($sharedFiles[$file->id]) ? $sharedFiles[$file->id] : '';
    }

    // Retrieve all folders
    $folders = Folder::all();

    // Pass data to the view
    return view('Employee.Humanesources.File.folderFiles', compact('files', 'folder', 'folders', 'employees', 'sub_folder'));
}

public function getSubfolders($folderId)
{
    // $subfolders = SubFolder::where('folder_id', $folderId)->get(['id', 'sub_folder_name']);
    $folder = Folder::findOrFail($folderId);
    $authUserId = Auth::id(); 
    $subfolders = SubFolder::where('folder_id', $folderId)
                            ->where(function($query) use ($folder, $authUserId) {
                                $query->where('user_id', $folder->user_id)
                                    ->orWhere('user_id', $authUserId)
                                    ->orWhere('share_ids', $authUserId)
                                    ->orWhereJsonContains('share_ids', $authUserId);
                            })
                            ->get();

    return response()->json($subfolders);
}


    public function viewSubFolderFiles($id)
    {
       
             $folder = SubFolder::
                where('id',$id)->select('sub_folders.*','sub_folders.sub_folder_name as folder_name')->first();
            $employees = User::select('first_name','last_name', 'id')->where('type', 4)->get();
            $sub_folder = SubFolder::where('folder_id', $id)->get();
            $folders = SubFolder::all();
            $files = File::
                leftjoin('folders','folders.id','files.folder_id')
                ->leftjoin('sub_folders','sub_folders.id','files.sub_folder_id')
                ->where('files.sub_folder_id', $id)->select('files.*','sub_folders.sub_folder_name as folder_name')->get();
             return view('Employee.Humanesources.File.folderFiles', compact('files', 'folder','folders','employees','sub_folder'));
     
    }

    

    public function storeFolderOld(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Folder::create($data);
        return redirect()->back()->with('message','New folder has been created successfully.');
    }


    public function recentFiles(Request $request){
        return view('Employee.Humanesources.File.recent-files');
    }
    
    public function workHistory(Request $request){
        return view('Employee.Humanesources.File.work-history');
    }
    
    public function show_user_list(Request $request){
        $section = $request->section ?? 'Projects';
        $UserData = User::paginate(10); 
        return view('Employee.Humanesources.File.showUserList', compact('UserData', 'section'));

    }
    
    public function show_user_file_list(Request $request, $id, $section)
    {
    $data = [];
    if ($section == 'Projects') {
        $data = Project::where('user_id', $id)->paginate(10);
    } elseif ($section == 'Quotes') {
        $data = Quotes::where('user_id', $id)->select('signature as Document','created_at')->paginate(10);
    } elseif ($section == 'Invoices') {
        $data = Invoice::where('client_id', $id)->select('invoice_attachment as Document','created_at')->paginate(10);
    } elseif ($section == 'Task') {
        $data = Task::where('user_id', $id)->select('Addfile as Document','created_at')->paginate(10);
    } else {
        $data = Project::where('user_id', $id)->paginate(10);
    }

    return view('Employee.Humanesources.File.ShowUserFileList', compact('data', 'section', 'id'));
}
   public function home2()
    {
          $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                    ->join('employee_details','employee_details.job_role_id','role_accesses.role_id')
                    ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                    ->where('employee_details.user_id', Auth::user()->id)
                    ->where(function($query) {
                        $query->where('role_accesses.view', '!=', null)
                            ->orWhere('role_accesses.add', '!=', null)
                            ->orWhere('role_accesses.update', '!=', null)
                            ->orWhere('role_accesses.delete', '!=', null);
                    })
                    ->get()
                    ->toArray();
    
        if($RoleAccess[array_search('File', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $File = File::orderBy('created_at', 'desc')->paginate(10);
            
        }

        if($RoleAccess[array_search('File', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $File = File::orderBy('created_at', 'desc')->where('user_id',Auth::user()->id)->paginate(10);
                    
        }

        return view('Employee.Humanesources.File.home', compact('File','RoleAccess'));
    }



    //home page
    public function Create(Request $request)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "File Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/File/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

         $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                    ->join('employee_details','employee_details.job_role_id','role_accesses.role_id')
                    ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                    ->where('employee_details.user_id', Auth::user()->id)
                    ->where(function($query) {
                        $query->where('role_accesses.view', '!=', null)
                            ->orWhere('role_accesses.add', '!=', null)
                            ->orWhere('role_accesses.update', '!=', null)
                            ->orWhere('role_accesses.delete', '!=', null);
                    })
                    ->get()
                    ->toArray();
        if($RoleAccess[array_search('File', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {

        $Employee = User::select('first_name','last_name','id')->where('type',4)->get();
            
        }
        if($RoleAccess[array_search('File', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
        $Employee = User::select('first_name','id')->where('id',Auth::user()->id)->where('type',4)->get();
                    
        }



        return view('Employee.Humanesources.File.create',compact('Employee')); 
    }


    public function store(Request $req)
    {

            $url = url('/').'/public/images/';
        foreach ($req->employee_id as $key => $value) {
            $data = new File;
        
            $profileFilename = 'default_profile.jpg';
            if ($req->hasFile('documents')) {
                $rand = Str::random(4);
                $file = $req->file('documents')[$key];
                $extension = $file->getClientOriginalExtension();
                $profileFilename = 'file_doc_'.$rand.'.'.$extension;
                $file->move('public/images/', $profileFilename);
            }
            $data['documents'] = $url . $profileFilename;
            $data['employee_id'] = $value;
            $data['document_name'] = $req->document_name[$key];
            $data['user_id'] = Auth::User()->id;
            $data->save();


            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "File Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/File/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        }
        return redirect('Employee/File/home')->with('success', "New File Added Successfully");
    }


    //edit
    public function edit(Request $req,$id)
    {
        $File = File::find($id);

        $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                        ->leftjoin('employee_details','employee_details.job_role_id','role_accesses.role_id')
                        ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                        ->where('employee_details.user_id',Auth::user()->id)
                        ->where('role_accesses.view','!=',null)
                        ->orWhere('role_accesses.add','!=',null)
                        ->orWhere('role_accesses.update','!=',null)
                        ->orWhere('role_accesses.delete','!=',null)
                        ->get()
                        ->toArray();
    
        if($RoleAccess[array_search('File', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {

        $Employee = User::select('first_name','last_name','id')->where('type',4)->get();
            
        }
        if($RoleAccess[array_search('File', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
        $Employee = User::select('first_name','last_name','id')->where('id',Auth::user()->id)->where('type',4)->get();
                    
        }



        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "File Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/File/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.File.edit',compact('File','Employee'));
    }

    //updated
    public function update(Request $req,$id)
    {
        $url = url('/').'/public/images/';
     
        $data =File::find($id);
        $data['employee_id'] = $req->employee_id;
        $data['document_name'] = $req->document_name;
        if ($req->hasFile('documents')) {
            $profileFilename = 'file_doc_' . Str::random(4) . '.' . $req->file('documents')->getClientOriginalExtension();
            $req->file('documents')->move('public/images/', $profileFilename);
            $data->documents = url('/public/images/') . '/' . $profileFilename;
        }
        $data['user_id'] = Auth::User()->id;
        $data->save();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "File Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/File/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('Employee/File/home')->with('success', "File Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "File Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/File/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        File::find($id)->delete();
        return redirect('Employee/File/home')->with('success', "File Deleted Successfully");
    }
}
