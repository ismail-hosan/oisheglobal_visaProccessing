<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectimage extends Model
{
    use HasFactory;
    protected $fillable = [
        "project_id",
        "type",
        "title",
        "desc",
        "image",
        "created_by	",
        "order_by",
        "status",
        "created_at",
        "updated_at	",
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
