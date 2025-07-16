<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'name',
        'position',
        'company',
        'number',
        'email',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}