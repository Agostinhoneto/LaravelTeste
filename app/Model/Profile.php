<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'dob', 'gender',
    ];

    public function reports()
    {
        return $this->belongsToMany(Report::class, 'profile_reports', 'profile_id', 'report_id');
    }
}
