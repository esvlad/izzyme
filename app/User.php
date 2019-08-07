<?php

namespace App;

use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
      return Role::user_role_name($this->id);
    }

    public static function companyId($user_id){
      return DB::table('companies_users')->where('users_id', $user_id)->value('companies_id');
    }

    public static function getUser($user_id){
      return DB::table('users')->select('name', 'email', 'created_at')->where('id', $user_id)->first();
    }
}
