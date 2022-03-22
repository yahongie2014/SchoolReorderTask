<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class School extends Model
{
    use HasFactory, SoftDeletes, Searchable,HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'created_at',
    ];
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function searchableAs()
    {
        return 'schools_index';
    }

}
