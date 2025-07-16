<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'applicant_id',
        'job_id',
        'status',
        'payment_status', // ✅ add this
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }

    public function job() {
        return $this->belongsTo(\App\Models\JobOpening::class, 'job_id');
    }
}