<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaDataModel extends Model
{
    use HasFactory;
    protected $table = 'visa_data_models';

    protected $guarded = [
  
    ];

    public function branch()
    {
        return $this->belongsTo(Project::class, 'branch_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function countryName()
    {
        return $this->hasOne(VisaProcesing::class,'id','country_id');
    }

}
