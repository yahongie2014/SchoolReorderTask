<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Student extends Model
{
    use HasFactory, SoftDeletes, Searchable, HasFactory;

    protected $fillable = [
        'name',
        'school_id',
        'order',
        'status',
        'created_at'
    ];

    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function searchableAs()
    {
        return 'students_index';
    }


    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

}
