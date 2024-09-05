<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaSlider extends Model
{
    use HasFactory;
    protected $fillable = [
        'visa_id',
        'image',
        
    ];
}
