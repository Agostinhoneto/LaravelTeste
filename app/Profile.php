<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'dob', 'gender',
    ];

    public function reports()
    {
        return $this->belongsToMany(Report::class, 'profile_report', 'profile_id', 'report_id');
    }
}
