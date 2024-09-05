<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "service_id",
        "name",
        "onetime_amount",
        "monthly_amount",
        "description",
        "status",
        "updated_by",
        "created_by",
        "deleted_by",
        "order_by",
    ];



    public function details()
    {
        return $this->hasMany(PackageDetail::class, 'package_id', 'id')->orderBy('id', 'asc');
    }
}
