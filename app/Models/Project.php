<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Project extends Model implements HasMedia
{
    use HasMediaTrait;
    
    public $table = "projects";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
      'id',
  		'user_id',
  		'name',
  		'status',
  		'started_date',
  		'closed_date',
  		'created_at',
  		'updated_at'
    ];

    public static $rules = [
        'name' => 'required|unique:projects',
        'status' => 'required',
    ];

    /**
     * Get Model uploaded media files
     * @return Array
     */
    public function getUploadedFiles()
    {
        return $this->getMedia($this->table)->map(function($media){
          $data = $media->only(['id', 'model_id', 'file_name', 'collection_name', 'size', 'mime_type', 'created_at']);
          $data['full_url'] = $media->getFullUrl();
          $data['file_type'] = trim(str_before($data['mime_type'], '/'));
          $data['created_at'] = $data['created_at']->diffForhumans();
          return $data;
        });
    }
}