<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Point extends Model
{
    public function company(){
      $companies_id = $this->companyId($this->id);

      return DB::table('companies')->where('id', $companies_id)->value('name');
    }

    public function companyId($points_id)
    {
      return DB::table('companies_points')->where('points_id', $points_id)->value('companies_id');
    }

    public static function company_point_save($points_id, $company_id){
      DB::table('companies_points')->insert(
        ['companies_id' => $company_id, 'points_id' => $points_id]
      );
    }

    public static function company_point_update($points_id, $company_id){
      DB::table('companies_points')->where('points_id', $points_id)->update(['companies_id' => $company_id]);
    }

    public static function company_point_delete($points_id){
      DB::table('companies_points')->where('points_id', $points_id)->delete();
    }

    public static function staticSave($data){
      return DB::table('points')->insertGetId($data);
    }

    public static function getCompany(){
      return DB::select('SELECT c.id, c.name FROM companies_users cu, companies c WHERE cu.users_id = ? AND c.id = cu.companies_id', [Auth::id()]);
    }
}
