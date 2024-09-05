<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'url',
        'details',
        'image',
        'show_in_nav',
        'services',
        'meta',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'service_id', 'id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'service_id', 'id');
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
