<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'age',
        'birthdate',
        'address',
        'sex',
        'medical_clearance_path',
    ];

    // Relationships
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }

    public function hasPayment() {
        return $this->payments()->exists();
    }
}