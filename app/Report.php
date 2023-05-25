<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title', 'description',
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
