<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileReport extends Model
{
    protected $fillable = [
        'profile_id', 'report_id',
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    
    public function reports()
    {
        return $this->belongsToMany(Report::class);
    }
}
