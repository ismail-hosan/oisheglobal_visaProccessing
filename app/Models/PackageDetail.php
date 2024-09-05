<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "package_id",
        "name",
        "description",
        "order_by",
    ];
}
