<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_date',
        'deadline',
        'status',
        'assigned_to'
    ];



    protected $primaryKey = 'task_id';
    public $incrementing = true;

    public $timestamps = true;

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_on';

    protected $table = 'user_tasks';


    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
