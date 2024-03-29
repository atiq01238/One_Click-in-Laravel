<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'task_name',
        'start_date',
        'end_date',
        'user_id',
        'attachment',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
