<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'vacancy',
        'email',
        'short_description',
        'description',
        'published_at',
        'employment_status',
        'experience',
        'gender',
        'job_location',
        'salary',
        'alt',
        'meta',
        'application_deadline',
        'status',
    ];

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst(strtolower($value));
        $this->attributes['slug'] = Str::slug($value);
    }
}
