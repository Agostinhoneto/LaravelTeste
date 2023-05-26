<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title', 'description',
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_reports', 'report_id', 'profile_id');
    }
}
