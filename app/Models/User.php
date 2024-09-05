<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    public function manager()
    {
        return $this->belongsTo(Project::class, 'manager_id', 'id');
    }

    public function branch()
    {
        return  $this->belongsTo(Project::class, 'branch_id', 'id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'phone',
        'address',
        'branch_id',
        'type',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "phone",
        'email_verified_at' => 'datetime',
    ];


    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }
    public function agentData()
    {
        return $this->hasOne(AgentRegisterData::class,'agent_id','id');
    }
    public function branchData()
    {
        return $this->hasOne(Project::class,'id','branch_id');
    }
}
