<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'company',
        'position',
        'year',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}