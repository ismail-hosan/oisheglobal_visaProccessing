<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'subtitle',
        'image',
        'module_title',
        'gallary_title',
        'video_title',
        'video_link',
        'description',
        'tecnology',
        'show_in_nav',
        'status',
        'updated_by',
        'created_by',
        'deleted_by',
        'meta',
    ];


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

    public function modules()
    {
        return $this->hasMany(Module::class, 'product_id', 'id');
    }

    public function gallaries()
    {
        return $this->hasMany(Gallary::class, 'product_id', 'id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'product_id', 'id')->orderBy('id', 'asc');
    }


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
