<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'job_description',
        'date_needed',
        'date_expiry',
        'status',
        'location',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}