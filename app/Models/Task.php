<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_date',
        'deadline',
        'status',
        'assigned_to',
        'owner_id',
    ];




    protected $primaryKey = 'task_id';
    public $incrementing = true;

    public $timestamps = true;

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_on';

    protected $table = 'user_tasks';



    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y H:i') : null;
    }

    public function getDeadlineAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::parse($value) : null;
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = Carbon::createFromFormat('d-m-Y H:i', $value);
    }


//=========================================Scop================================

    public function scopePriority($query, $priority)
    {
        if ($priority) {
            return $query->where('priority', $priority);
        }

        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }

        return $query;
    }


    //============================Relation======================================

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
