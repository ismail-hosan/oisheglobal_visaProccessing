<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'branch_id'
    ];

    // public function branch()
    // {
    //     return $this->belongsTo(Branch::class, 'branch_id', 'id');
    // }

    public function branch()
    {
        return $this->belongsTo(Project::class, 'branch_id', 'id');
    }


}
