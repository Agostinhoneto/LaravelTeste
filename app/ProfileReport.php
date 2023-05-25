<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileReport extends Model
{
    protected $table = 'profile_reports'; 

    protected $fillable = [
        'profile_id', 'reports_id',
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
