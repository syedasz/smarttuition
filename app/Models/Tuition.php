<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'fee',
        'category',
        'max_students',
        'tutor_id', // Ensure tutor_id is fillable
        'image_url',
        'description', // Added description
    ];

    // Define the relationship with User (Tutor)
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}