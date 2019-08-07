<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function userMail($company_id){
      $user_id = DB::table('companies_users')->where('companies_id', $company_id)->value('users_id');

      return DB::table('users')->where('id', $user_id)->value('email');
    }

    public static function company_user_save($company_id, $user_mail){
      $user_id = DB::table('users')->where('email', $user_mail)->value('id');

      DB::table('companies_users')->insert(
        ['companies_id' => $company_id, 'users_id' => $user_id]
      );
    }

    public static function company_user_update($company_id, $user_mail){
      $user_id = DB::table('users')->where('email', $user_mail)->value('id');

      DB::table('companies_users')->where('companies_id', $company_id)->update(['users_id' => $user_id]);
    }

    public static function company_user_delete($company_id){
      DB::table('companies_users')->where('companies_id', $company_id)->delete();
    }

    public static function staticSave($data){
      $company_id = DB::table('companies')->insertGetId($data);

      return $company_id;
    }

    public static function getCompany($company_id){
      return DB::table('companies')->where('id', $company_id)->first();
    }
}
