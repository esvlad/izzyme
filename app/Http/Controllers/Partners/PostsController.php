<?php

namespace App\Http\Controllers\Partners;

use App\Post;
use App\Statistics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){
       return view('partners.posts.index', [
         'post_id' => 1
       ]);//Post::paginate(50)
     }

     public function view_date($date){
       return view('partners.posts.index', [
         'posts' => Post::paginate(50)
       ]);
     }

     public function main(){
       $dates = array('05 июля', '06 июля', '07 июля', '08 июля', '09 июля', '10 июля');
       $points = array(29, 21, 17, 34, 12, 18);

       $datasets = [array(
         'label' => 'Просмотры',
         'backgroundColor' => '#3097D1',
         'borderColor' => '#2579a9',
         'data' => $points,
         'fill' => false,
       )];

       $statistics = new Statistics();
       $graphic_config = $statistics->getGraphicsBasicLine($dates, $datasets);

       return view('partners.posts.view', [
         'config_char' => json_encode($graphic_config)
       ]);
     }

     public function graphics(Request $request){
       switch($request->input('type')){
        case 'weeks' :
          $dates = array('29 мая', '05 июня', '12 июня', '19 июня', '26 июня', '03 июля', '10 июля');
          $points = array(15, 22, 18, 17, 14, 10, 3);
          break;
        case 'months' :
          $dates = array('май', 'июнь', 'июль');
          $points = array(32, 55, 8);
          break;
        default :
         $dates = array('04 июля', '05 июля', '06 июля', '07 июля', '08 июля', '09 июля', '10 июля');
         $points = array(7, 15, 9, 4, 13, 10, 6);
         break;
       }

       $datasets = [array(
         'label' => 'Всего просмотров',
         'backgroundColor' => 'blue',
         'borderColor' => 'blue',
         'data' => $points,
         'fill' => false,
       )];

       $statistics = new Statistics();
       $graphic_config = $statistics->getGraphicsBasicLine($dates, $datasets);
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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      $post_table = array(
        array('desc_id' => 3, 'static_date' => '2019/07/10 10:00', 'view' => 27, 'likes' => 4, 'comments' => 3),
        array('desc_id' => 2, 'static_date' => '2019/07/09 10:00', 'view' => 38, 'likes' => 8, 'comments' => 1),
        array('desc_id' => 1, 'static_date' => '2019/07/08 10:00', 'view' => 64, 'likes' => 5, 'comments' => 2)
      );

      $dates = array('8 июля', '9 июля', '10 июля');
      $points1 = array(64, 38, 27);
      $points2 = array(5, 8, 4);
      $points3 = array(2, 1, 3);

      $datasets = [
        array(
          'label' => 'Просмотры',
          'backgroundColor' => 'blue',
          'borderColor' => 'blue',
          'data' => $points1,
          'fill' => false,
        ),
        array(
          'label' => 'Лайки',
          'backgroundColor' => 'orange',
          'borderColor' => 'orange',
          'data' => $points2,
          'fill' => false,
        ),
        array(
          'label' => 'Комментарии',
          'backgroundColor' => 'green',
          'borderColor' => 'green',
          'data' => $points3,
          'fill' => false,
        ),
      ];

      $statistics = new Statistics();
      $graphic_config = $statistics->getGraphicsBasicLine($dates, $datasets);

      //'post' => $post
      return view('partners.posts.post', [
        'post_table' => $post_table,
        'config_char' => json_encode($graphic_config)
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
