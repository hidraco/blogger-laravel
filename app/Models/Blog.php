<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];


    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
