<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public static function user_role($user_id){
      $role_id = DB::table('roles_users')->where('users_id', $user_id)->value('roles_id');

      return self::where('id', $role_id)->value('slug');
    }

    public static function user_role_name($user_id){
      $role_id = DB::table('roles_users')->where('users_id', $user_id)->value('roles_id');

      return self::where('id', $role_id)->value('name');
    }

    public static function user_role_save($user_id, $role_id){
      DB::table('roles_users')->insert(
        ['users_id' => $user_id, 'roles_id' => $role_id]
      );
    }

    public static function user_role_update($user_id, $role_id){
      DB::table('roles_users')->where('users_id', $user_id)->update(['roles_id' => $role_id]);
    }

    public static function user_role_delete($user_id){
      DB::table('roles_users')->where('users_id', $user_id)->delete();
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
