<?php

namespace App\Http\Controllers\Admin;

use App\Statistics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
      $graphic_config_age = array(
  			'labels' => ['-18', '18-25', '26-32', '33-44', '45-60', '60+'],
        'datasets' => [array(
  				'label' => 'Жен',
  				'backgroundColor' => 'rgba(255, 0, 0, 0.6)',
  				'borderColor' => '#ff0000',
  				'borderWidth' => 1,
  				'data' => [6.45, 18.4, 22.6, 14.7, 6, 1.8], //14, 40, 49, 32, 13, 4
  			), array(
  				'label' => 'Муж',
  				'backgroundColor' => 'rgba(255, 165, 0, 0.6)',
  				'borderColor' => '#ffa500',
  				'borderWidth' => 1,
  				'data' => [4.2, 9.7, 10.7, 8.8, 0.5, 0], //7, 19, 21, 17, 1, 0
  			)]
      );

      $graphic_config_sex = array(
        'type' => 'pie',
  			'data' => array(
  				'datasets' => [array(
  					'data' => [70.04, 39.96],
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
  					'data' => [13, 198, 6],
  					'backgroundColor' => ['rgba(48, 151, 209, 0.6)', 'rgba(255, 165, 0, 0.6)', 'rgba(37, 121, 169, 0.6)',],
  					'label' => ''
  				)],
  				'labels' => ['Стерлитамак', 'Уфа', 'Салават']
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

      return view('partners.statistics.index', [
        'config_char_age' => json_encode($graphic_config_age),
        'config_char_sex' => json_encode($graphic_config_sex),
        'config_char_city' => json_encode($graphic_config_city)
      ]);
    }

    public function graphics(Request $request){
      switch($request->input('type')){
        case 'views' :
          $points_all = array(2590, 3392, 4679);
          $points_vk = array(569, 684, 721);
          $points_fb = array(318, 452, 489);
          $points_in = array(1683, 2256, 3469);
          break;
        case 'coverage' :
          $points_all = array(4982, 6257, 7631);
          $points_vk = array(1682, 1938, 2245);
          $points_fb = array(814, 1212, 1358);
          $points_in = array(2486, 3107, 4028);
          break;
        case 'count' :
          $points_all = array(59, 81, 110);
          $points_vk = array(19, 23, 27);
          $points_fb = array(8, 14, 15);
          $points_in = array(32, 44, 68);
          break;
        default : break;
      }

      $dates = array('май', 'июнь', 'июль');


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
        ),
        array(
          'label' => 'Facebook',
          'backgroundColor' => '#2579a9',
          'borderColor' => '#2579a9',
          'data' => $points_fb,
          'fill' => false,
        ),
        array(
          'label' => 'Instargam',
          'backgroundColor' => 'orange',
          'borderColor' => 'orange',
          'data' => $points_in,
          'fill' => false,
        ),
      ];

      $statistics = new Statistics();
      $graphic_config = $statistics->getGraphicsBasicLine($dates, $datasets);

      return response()->json(array('config_char'=> $graphic_config), 200);
    }

    public function getCountPosts(){
      $msg = 'Hello World!';
      return response()->json(array('msg'=> $msg), 200);
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
