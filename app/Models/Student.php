<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'sex',
        'date_of_birth',
        'phone',
        'address',
        'class_id',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
