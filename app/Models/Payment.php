<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'amount',
        'paid_on',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
