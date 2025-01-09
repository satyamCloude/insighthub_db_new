<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Folder;
use App\Models\SubFolder;
use App\Models\File; // Ensure you have a model for your files table
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FileFacade;
use Auth;
use DB;
use App\Models\StorageSetting;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Log;
use App\Models\SharedFile; // Ensure you create this model if not already created


class FileManagementController extends Controller
{
    // Home page
 

public function home(Request $request)
{
    // Existing code to retrieve data
    $folders = Folder::all();
    $sub_folders = SubFolder::all();
    $all_folders = Folder::orderBy('created_at', 'desc')->whereNotIn('id', [1, 5])->get();
    $adminfolders = Folder::whereNull('employee_id')->whereNotBetween('id', [1, 5])->get();
    $empfolders = Folder::whereNotNull('employee_id')->get();
    $department_folders = Folder::whereBetween('id', [1, 5])->get();
    $recent_files = File::where('sub_folder_id', 0)->orderBy('created_at', 'desc')->take(5)->get();
    $all_Files = File::orderBy('created_at', 'desc')->get();
    $files = File::all();

    // Retrieve file types
    $imgFile = File::where('type', 'image')->get();
    $docFile = File::where('type', 'document')->get();
    $audioFile = File::where('type', 'audio')->get();
    $videoFile = File::where('type', 'video')->get();

    $employees = User::select('first_name', 'id', 'last_name', 'profile_img')->where('type', 4)->get();
    $docxCount = File::where('type', 'document')->count();
    $directory = public_path('images/filemanagement');
    $diskUsage = $this->getDirectorySize($directory);
    $formattedSize = $this->formatFileSize(array_sum($diskUsage));

    // Get shared folders
    $shared_folders = Folder::whereNotNull('share_ids')->whereNull('employee_id')->get();
    $shared_sub_folders = SubFolder::whereNotNull('share_ids')->get();

    // Calculate sizes and percentages for each file type
    $imageSizeFormatted = $this->formatFileSize($diskUsage['image']);
    $videoSizeFormatted = $this->formatFileSize($diskUsage['video']);
    $audioSizeFormatted = $this->formatFileSize($diskUsage['audio']);
    $documentSizeFormatted = $this->formatFileSize($diskUsage['document']);

    $totalSize = array_sum($diskUsage);
    $imagePercentage = $videoPercentage = $audioPercentage = $documentPercentage = 0;
    if ($totalSize > 0) {
        $imagePercentage = ($diskUsage['image'] / $totalSize) * 100;
        $videoPercentage = ($diskUsage['video'] / $totalSize) * 100;
        $audioPercentage = ($diskUsage['audio'] / $totalSize) * 100;
        $documentPercentage = ($diskUsage['document'] / $totalSize) * 100;
    }

    // Return view with data
    return view('admin.FileManagement.home', compact(
        'imgFile', 'shared_sub_folders', 'docFile', 'audioFile', 'videoFile',
        'shared_folders', 'adminfolders', 'all_Files', 'empfolders', 'sub_folders',
        'formattedSize', 'docxCount', 'folders', 'employees', 'recent_files', 'files',
        'department_folders', 'all_folders', 'imageSizeFormatted', 'videoSizeFormatted',
        'audioSizeFormatted', 'documentSizeFormatted', 'imagePercentage', 'videoPercentage',
        'audioPercentage', 'documentPercentage'
    ));
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

 public function home2Old(Request $request)
    {
    $folders = Folder::all();
    $all_folders = Folder::orderBy('created_at', 'desc')->get();
    $department_folders = Folder::whereBetween('id', [1, 5])->get();
   

    $recent_files = File::orderBy('created_at', 'desc')->take(5)->get();
    $files = File::all();
    $employees = User::select('first_name', 'id','last_name')->where('type', 4)->get();

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

 // Fetch shared folders where share_ids is not null and shared by the authenticated user
    $shared_folders = Folder::whereNotNull('share_ids')->whereNull('employee_id')
                            ->get();
    return view('admin.FileManagement.home', compact('shared_folders','folders', 'employees', 'recent_files', 'files', 'docxCount', 'imageCount', 'videoCount', 'audioCount','department_folders','all_folders'));
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
    // Validate the incoming request
    $request->validate([
        'file_id' => 'required|integer|exists:files,id',
        'share_ids' => 'required|array',
        'share_ids.*' => 'integer|exists:users,id',
        'permissions' => 'required|array',
        'permissions.*' => 'string|in:all,view,share,delete', // Adjust the permissions as needed
    ]);

    $file_id = $request->file_id;
    $emp_ids = $request->share_ids;
    $permissions = $request->permissions;

    // Find the file by ID
    $folder = File::find($file_id);

    if (!$folder) {
        return redirect()->back()->with('error', 'File not found.');
    }

    // Get the existing shared IDs from the folder
    $existing_ids = $folder->share_ids ? explode(',', $folder->share_ids) : [];

    // Merge existing IDs with new IDs and remove duplicates
    $new_ids = array_unique(array_merge($existing_ids, $emp_ids));

    // Update the share_ids column in the files table
    $folder->share_ids = implode(',', $new_ids);
    $folder->save();

    foreach ($emp_ids as $emp_id) {
        // Check if there's an existing entry for the same file and employee
        $existingSharedFile = SharedFile::where('file_id', $file_id)
                                        ->where('emp_id', $emp_id)
                                        ->first();

        if ($existingSharedFile) {
            // Update permissions if an entry already exists
            $existingPermissions = explode(',', $existingSharedFile->permissions);
            $updatedPermissions = array_unique(array_merge($existingPermissions, $permissions));
            $existingSharedFile->permissions = implode(',', $updatedPermissions);
            $existingSharedFile->save();
        } else {
            // Create a new entry if no existing entry is found
            SharedFile::create([
                'file_id' => $file_id,
                'emp_id' => $emp_id,
                'permissions' => implode(',', $permissions),
            ]);
        }
    }

    
    return redirect()->back()->with('message', 'File shared successfully.');
}

   public function sharefile2sOld(Request $request)
    {
      //  return $request->all();
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
            
                 $folder->folder_name = $this->formatFolderName($request->folder_name);
                 
                 $folderName = $this->formatFolderName($request->folder_name);
        
        
                $previousFolderPath = public_path('images/filemanagement/' . $previousFolderName);
                $newFolderPath = public_path('images/filemanagement/' . $folderName);
        
                // Rename the folder directory if the name has changed
                if ($previousFolderName != $folderName) {
                    if (FileFacade::exists($previousFolderPath)) {
                        FileFacade::move($previousFolderPath, $newFolderPath);
                    } else {
                        FileFacade::makeDirectory($newFolderPath, 0755, true);
                    }
                }
        
                            $folder->save();

                // Redirect back with a success message
                return redirect()->back()->with('message', 'Folder has been updated successfully.');
            }
        
            // Redirect back with an error message if the folder is not found
            return redirect()->back()->withErrors(['folder_id' => 'Folder not found']);
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

    // Format folder name
    $folderName = $this->formatFolderName($data['folder_name']);

    // Check if the folder name already exists
    $existingFolder = Folder::where('folder_name', $folderName)->first();
    if ($existingFolder) {
        return redirect()->back()->with('error', 'Folder with the same name already exists.');
    }

    // Create the folder record
    $folder = Folder::create([
        'folder_name' => $folderName,
        'user_id' => $data['user_id'],
    ]);

   
        $folderPath = public_path('images/filemanagement/' . $folderName);

        if (!FileFacade::exists($folderPath)) {
            // Create the folder
            FileFacade::makeDirectory($folderPath, 0755, true);
        }


    // Redirect back with a success message
    return redirect()->back()->with('message', 'New folder has been created successfully.');
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

    public function storeFolder2Old(Request $request)
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
    
    // Ensure the parent folder exists in the filesystem
    if (!FileFacade::exists($parentFolderPath)) {
        FileFacade::makeDirectory($parentFolderPath, 0755, true);
    }

    $data = $request->all();
    $data['user_id'] = Auth::user()->id;
    $data['share_ids'] = $emp_ids;

    $SubfolderName = $this->formatFolderName($data['sub_folder_name']);

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
    $folder_id = 0;
    $sub_folder_id = 0;
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

    // // Adjust the document path based on folder_id and sub_folder_id
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



    public function getEmployeesByDepartment(Request $request)
    {
        $departmentId = $request->folder_id;
          if ($request->folder_id && $departmentId <= 5) {
            $employees = User::leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
                ->select('users.id', 'users.first_name', 'users.last_name','users.profile_img')
                ->where('users.type', 4)
                ->where('employee_details.department_id', $departmentId) // Fixed the double $
                ->get();
        } else {
            $employees = User::select('id', 'first_name', 'last_name','profile_img')
                ->where('type', 4)
                ->get();
        }
    
        return response()->json($employees);
    }
public function getSubFolders(Request $request)
    {
        $folder_id = $request->folder_id;
        $folder = SubFolder::where('folder_id',$folder_id)->get();
        
        
        return response()->json($folder);
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
                leftjoin('folders','folders.id','files.folder_id')->where('files.folder_id', $id)->select('files.*','folders.folder_name')->get();

                   return response()->json($files);
           
       
    }
    
    //to view list of all files under selected folder
    public function viewFolderFiles($id)
    {
       
            $folder = Folder::findOrFail($id);
            $type= 'folder';
            $employees = User::select('first_name', 'id','last_name')->where('type', 4)->get();
            $sub_folder = SubFolder::where('folder_id', $id)->get();
            $folders = Folder::all();
            $files = File::
                leftjoin('folders','folders.id','files.folder_id')->where('files.folder_id', $id)->where('files.sub_folder_id',0)->select('files.*','folders.folder_name')->get();
             return view('admin.FileManagement.folderFiles', compact('files', 'folder','folders','employees','sub_folder','type'));
                     
               
           
       
    }  
    
    //to view list of all files or show all files
    public function getAllFiles(Request $request)
    {
       
            $files = File::where('folder_id',0)->get();
             return view('admin.FileManagement.allFiles', compact('files'));
   
    }

    public function viewSubFolderFiles($id)
    {
       
            $folder = SubFolder::
                where('id',$id)->select('sub_folders.*','sub_folders.sub_folder_name as folder_name')->first();
            $employees = User::select('first_name', 'id','last_name')->where('type', 4)->get();
            $sub_folder = [];
             $type= 'sub_folder';
            $folders = SubFolder::all();
            $files = File::
                leftjoin('folders','folders.id','files.folder_id')
                ->leftjoin('sub_folders','sub_folders.id','files.sub_folder_id')
                ->where('files.sub_folder_id', $id)->select('files.*','sub_folders.sub_folder_name as folder_name')->get();
             return view('admin.FileManagement.folderFiles', compact('files', 'folder','folders','employees','sub_folder','type'));
     
    }

    

    public function storeFolderOld(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Folder::create($data);
        return redirect()->back()->with('message','New folder has been created successfully.');
    }


    public function recentFiles(Request $request){
        return view('admin.FileManagement.recent-files');
    }
    
    public function workHistory(Request $request){
        return view('admin.FileManagement.work-history');
    }
    
    public function show_user_list(Request $request){
        $section = $request->section ?? 'Projects';
        $UserData = User::paginate(10); 
        return view('admin.FileManagement.showUserList', compact('UserData', 'section'));

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

    return view('admin.FileManagement.ShowUserFileList', compact('data', 'section', 'id'));
}

}
