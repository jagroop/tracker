<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id'                    => $this->id,
          'project_id'            => $this->project_id,
          'project_name'          => $this->project->name,
          'assigned_to'           => $this->assignedTo->name,
          'assigned_to_id'        => $this->assigned_to,
          'assigned_by'           => $this->assignedBy->name,
          'assigned_by_id'        => $this->assigned_by,
          'task_name'             => $this->task_name,
          'task_desc'             => $this->task_desc,
          'task_status'           => $this->task_status,
          'completion_precentage' => $this->completion_precentage,
          'percentage_status'     => $this->percentageStatus(),
          'activity'              => $this->activity(),
          'task_status_formated'  => ucwords(str_replace('_', ' ', $this->task_status)),
          'created_at'            => $this->created_at->toDateTimeString(),
          'started_date'          => $this->started_date,
          'closed_date'           => $this->closed_date,
          'files'                 => $this->getUploadedFiles()
        ];
    }
}
