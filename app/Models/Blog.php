<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'deleted_by',
        'category_id',
        'title',
        'slug',
        'image',
        'alt',
        'meta',
        'short_description',
        'description'
    ];

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords(strtolower($value));
        $this->attributes['slug'] = Str::slug($value);
    }
}
