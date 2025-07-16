<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';
    protected $fillable = [
        'applicant_id',
        'school',
        'year_level',
        'school_year',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}