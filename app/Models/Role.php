<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends EntrustRole
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="roles";

    protected $fillable = [
        'name', 'display_name', 'description',
    ];




    
 // tạo liên kết với bảng role_user qua role_id
    public function users(){
        return $this->belongsToMany('App\Models\User','role_users','role_id', 'user_id');
    }
    // tạo liên kết với bảng permission_user qua role_id
    public function permissions(){
        return $this->belongsToMany('App\Models\Permission','permission_roles','permission_id','role_id');
    }


}
