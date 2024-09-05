<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaVisited extends Model
{
    use HasFactory;
    protected $fillable = [
        'visa_id',
        'image', 
    ];
}
