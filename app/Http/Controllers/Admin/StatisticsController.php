<?php

namespace App\Http\Controllers\Admin;

use App\Statistics;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view(){
      $user_id = Auth::id();
      $role_slug = Role::user_role($user_id);

      /*echo '<pre>';
      print_r(Carbon::create('2019-07')->locale('ru'));
      echo '</pre>';*/

      if($role_slug != 'partner'){
        $is_admin = true;
        $view = 'admin.statistics.index';
        $profiles = Statistics::getProfiles();

        $get_clients_statistics = Statistics::getClientsStatistics();
        $get_statistics_all = Statistics::getStatisticsAll();
      } else {
        $company_id = User::companyId($user_id);
        $view = 'partners.statistics.index';
        $profiles = Statistics::getProfiles($company_id);

        $get_clients_statistics = Statistics::getClientsStatistics($company_id);
        $get_statistics_all = Statistics::getStatisticsAll($company_id);
      }

      $profiles_count = count((array)$profiles);

      $sex_woman = 0;
      $sex_man = 0;

      $age_arr = [
        'w' => array(0,0,0,0,0,0),
        'm' => array(0,0,0,0,0,0),
      ];

      $city_array = array();

      foreach($profiles as $profile){
        ## SEX
        switch($profile->sex){
          case 1 :
            $sex_woman++;
            break;
          case 2 :
            $sex_man++;
            break;
          default : break;
        }

        ## AGE
        $date = new \DateTime($profile->birthday);
        $interval = $date->diff(new \DateTime(date("Y-m-d")));
        $y = $interval->format("%Y");

        switch($y){
          case $y < 18 :
            if($profile->sex == 1){
              $age_arr['w'][0]++;
            } elseif($profile->sex == 2){
              $age_arr['m'][0]++;
            }
            break;
          case $y >= 18 && $y <= 25 :
            if($profile->sex == 1){
              $age_arr['w'][1]++;
            } elseif($profile->sex == 2){
              $age_arr['m'][1]++;
            }
            break;
          case $y >= 26 && $y <= 32 :
            if($profile->sex == 1){
              $age_arr['w'][2]++;
            } elseif($profile->sex == 2){
              $age_arr['m'][2]++;
            }
            break;
          case $y >= 33 && $y <= 44 :
            if($profile->sex == 1){
              $age_arr['w'][3]++;
            } elseif($profile->sex == 2){
              $age_arr['m'][3]++;
            }
            break;
          case $y >= 45 && $y <= 60 :
            if($profile->sex == 1){
              $age_arr['w'][4]++;
            } elseif($profile->sex == 2){
              $age_arr['m'][4]++;
            }
            break;
          case $y > 60 :
            if($profile->sex == 1){
              $age_arr['w'][5]++;
            } elseif($profile->sex == 2){
              $age_arr['m'][5]++;
            }
            break;
          default : break;
        }

        ## CITY
        if(array_key_exists($profile->city_id, $city_array)){
          $city_array[$profile->city_id]['count']++;
        } else {
          $city_array[$profile->city_id] = [
            'name' => $profile->city_name,
            'count' => 1
          ];
        }
      }

      ## SEX DATA ##
      $graphic_config_sex_woman = $sex_woman;
      $graphic_config_sex_man = $sex_man;
      ## SEX DATA ##

      ## AGE DATA ##
      $array_age = ['младше 18', '18-25', '26-32', '33-44', '45-60', 'старше 60'];

      $graphic_config_age_data_woman = Statistics::getProcentCount($profiles_count, [$age_arr['w']]);
      $graphic_config_age_data_man = Statistics::getProcentCount($profiles_count, [$age_arr['m']]);

      ## AGE DATA ##

      ## CITY
      $array_city_name = array();
      $array_city_count = array();
      foreach($city_array as $key => $value){
        $array_city_name[] = $value['name'];
        $array_city_count[] = $value['count'];
      }
      ## CITY
      $array_color = array();
      $count_city = count((array)$city_array);
      $cdn = 0.3;
      $c_color = '#ffa500';
      $rgba_color = 'rgba(255, 165, 0, 0.6)';

      for($c = 0; $c < $count_city; $c++){
        if($count_city > 5){
          $cdn = 0.8;
        } else {
          $cdn = 0.6;
        }
        $ncdn = $cdn - ($c / 20);

        $array_color[] = Statistics::adjustBrightness($c_color, $ncdn);
      }

      $graphic_config_age = array(
  			'labels' => $array_age,
        'datasets' => [array(
  				'label' => 'Жен',
  				'backgroundColor' => 'rgba(255, 0, 0, 0.6)',
  				'borderColor' => '#ff0000',
  				'borderWidth' => 1,
  				'data' => $graphic_config_age_data_woman,
  			), array(
  				'label' => 'Муж',
  				'backgroundColor' => 'rgba(255, 165, 0, 0.6)',
  				'borderColor' => '#ffa500',
  				'borderWidth' => 1,
  				'data' => $graphic_config_age_data_man,
  			)]
      );

      $graphic_config_sex = array(
        'type' => 'pie',
  			'data' => array(
  				'datasets' => [array(
  					'data' => [$graphic_config_sex_woman, $graphic_config_sex_man],
  					'backgroundColor' => ['rgba(255, 0, 0, 0.6)', 'rgba(255, 165, 0, 0.6)'],
  					'label' => ''
  				)],
  				'labels' => ['Жен', 'Муж']
  			),
  			'options' => array(
  				'responsive' => true,
  			)
      );

      $graphic_config_city = array(
        'type' => 'doughnut',
  			'data' => array(
  				'datasets' => [array(
  					'data' => $array_city_count,
  					'backgroundColor' => $array_color,
  					'label' => ''
  				)],
  				'labels' => $array_city_name,
  			),
  			'options' => array(
  				'responsive' => true,
  				'legend' => array(
  					'position' => 'top',
  				),
  				'title' => array(
  					'display' => false,
  					'text' => ''
  				),
  				'animation' => array(
  					'animateScale' => true,
  					'animateRotate' => true
  				)
  			)
      );

      $view_array = [
        'clients' => $get_clients_statistics,
        'statistics_all' => $get_statistics_all,
        'config_char_age' => json_encode($graphic_config_age),
        'config_char_sex' => json_encode($graphic_config_sex),
        'config_char_city' => json_encode($graphic_config_city)
      ];

      return view($view, $view_array);
    }

    public function graphics(Request $request){
      $user_id = Auth::id();
      $role_slug = Role::user_role($user_id);
      $type = $request->input('type');

      if($role_slug != 'partner'){
        $is_admin = true;
        $profiles = Statistics::getProfiles();

        $get_statistics = Statistics::getStatisticsPostsViewCoverage();
      } else {
        $company_id = User::companyId($user_id);
        $profiles = Statistics::getProfiles($company_id);

        $get_statistics = Statistics::getStatisticsPostsViewCoverage($company_id);
      }

      switch($type){
        case 'views' :
          $points_all = $get_statistics['view']['all'];
          $points_vk = $get_statistics['view']['vk'];
          //$points_fb = Statistics::getStatisticsViews('fb');
          //$points_in = array(1683, 2256, 3469);
          break;
        case 'coverage' :
          $points_all = $get_statistics['coverage']['all'];
          $points_vk = $get_statistics['coverage']['vk'];
          //$points_fb = Statistics::getStatisticsCoverage('fb');
          $points_in = $get_statistics['coverage']['in'];
          break;
        case 'count' :
          $points_all = $get_statistics['count']['all'];
          $points_vk = $get_statistics['count']['vk'];
          //$points_fb = Statistics::getStatisticsCount('all');
          $points_in = $get_statistics['count']['in'];
          break;
        default : break;
      }

      $dates_arr = Statistics::getNowEndDate('month');
      $dates = array();
      foreach($dates_arr as $key => $date){
        $dates[] = $date['month_name'];
      }

      $datasets = [
        array(
          'label' => 'Общее',
          'backgroundColor' => 'red',
          'borderColor' => 'red',
          'data' => $points_all,
          'fill' => false,
        ),
        array(
          'label' => 'ВКонтакте',
          'backgroundColor' => '#3097D1',
          'borderColor' => '#3097D1',
          'data' => $points_vk,
          'fill' => false,
        )
      ];

      if(!empty($points_fb)){
        $datasets[] = array(
          'label' => 'Instargam',
          'backgroundColor' => 'orange',
          'borderColor' => 'orange',
          'data' => $points_fb,
          'fill' => false,
        );
      }

      if(!empty($points_in)){
        $datasets[] = array(
          'label' => 'Instargam',
          'backgroundColor' => 'orange',
          'borderColor' => 'orange',
          'data' => $points_in,
          'fill' => false,
        );
      }

      $graphic_config = Statistics::getGraphicsBasicLine($dates, $datasets);

      return response()->json(array('config_char'=> $graphic_config), 200);
    }

    public function posts(Request $request){
      $user_id = Auth::id();
      $role_slug = Role::user_role($user_id);
      $type = $request->input('type');

      if($role_slug != 'partner'){
        $is_admin = true;
        $company_id = false;
      } else {
        $company_id = User::companyId($user_id);
      }

      $get_statistics = Statistics::getStatisticsPostsViewCoverage($company_id, $type);

      $points_view_all = $get_statistics['view']['all'];
      $points_coverage_all = $get_statistics['coverage']['all'];

      $dates_arr = Statistics::getNowEndDate($type);
      $dates = array();

      foreach($dates_arr as $key => $date){
        if($type == 'days'){
          $dates[] = $date['period'];
        } elseif($type == 'weeks'){
          $dates[] = $date['period'];
        } else {
          $dates[] = $date['month_name'];
        }
      }

      $datasets = [
        array(
          'label' => 'Просмотров',
          'backgroundColor' => 'blue',
          'borderColor' => 'blue',
          'data' => $points_view_all,
          'fill' => false,
        ),
        array(
          'label' => 'Охват',
          'backgroundColor' => '#3097D1',
          'borderColor' => '#3097D1',
          'data' => $points_coverage_all,
          'fill' => false,
        ),
      ];

      $graphic_config = Statistics::getGraphicsBasicLine($dates, $datasets);
      return response()->json(array('config_char'=> $graphic_config), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Statistics  $statistics
     * @return \Illuminate\Http\Response
     */
    public function show(Statistics $statistics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statistics  $statistics
     * @return \Illuminate\Http\Response
     */
    public function edit(Statistics $statistics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statistics  $statistics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statistics $statistics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statistics  $statistics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statistics $statistics)
    {
        //
    }
}
