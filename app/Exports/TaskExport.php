<?php
   
namespace App\Exports;
   
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Collection;
 
use Maatwebsite\Excel\Concerns\FromCollection;
   
class TaskExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

public function collection()
{
    $data = Task::selectRaw('
        tasks.project_name,
        CASE tasks.any_one
            WHEN 1 THEN "Internal Team"
            WHEN 2 THEN "Client"
        END as any_one,
        client.first_name as client_name,
        tasks.deadline,
        manager.first_name as project_manager_name,
        CASE tasks.priority_id
            WHEN 1 THEN "High"
            WHEN 2 THEN "Medium"
            WHEN 3 THEN "Low"
        END as priority,
        CASE tasks.Type_id
            WHEN 1 THEN "Hourly"
            WHEN 2 THEN "Fixed"
        END as type,
        CASE tasks.status_id
            WHEN 1 THEN "In Progress"
            WHEN 2 THEN "Completed"
            WHEN 3 THEN "Over Due"
            WHEN 4 THEN "Cancel"
        END as status,
        tasks.project_value,
        tasks.created_at')
    ->join('users as manager', 'manager.id', 'tasks.project_manager_id')
    ->join('users as client', 'client.id', 'tasks.client_id')
    ->whereNull('tasks.deleted_at')
    ->get();

    // Add a title row
    $titleRow = ['Sr. No', 'Project Name', 'Any One', 'Client Name', 'Deadline', 'Project Manager', 'Priority', 'Type', 'Status', 'Project Value', 'Created At'];

    // Add serial numbers to each row
    $dataArray = $data->toArray();
    foreach ($dataArray as $key => &$row) {
        array_unshift($row, $key + 1);
    }

    // Convert back to a collection
    $data = collect($dataArray);

    // Prepend the title row
    $data->prepend($titleRow);

    return $data;
}

}