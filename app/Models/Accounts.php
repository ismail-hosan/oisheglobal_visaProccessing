<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model {

    use HasFactory;
   // use SoftDeletes;

    protected $table = 'chart_of_accounts';

    public function stores() {
        return $this->hasMany(Store::class);
    }

    public function fiscal_years() {
        return $this->hasMany(FiscalYear::class);
    }

    public function branch()
    {
      return  $this->belongsTo(Branch::class ,'branch_id','id');
    }

}
