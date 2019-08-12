<?php

namespace App\Http\Controllers\Partners;

use App\Post;
use App\User;
use App\Statistics;
use Illuminate\Support\Facades\Auth;
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
       $user_id = Auth::id();
       $company_id = User::companyId($user_id);

       $posts = Post::getCompanyPost($company_id);

       return view('partners.posts.index', [
         'company_id' => $company_id,
         'posts' => $posts,
       ]);//Post::paginate(50)
     }

     public function view_date($date){
       return view('partners.posts.index', [
         'posts' => Post::paginate(50)
       ]);
     }

     public function main(){
       $company_id = User::companyId(Auth::id());
       $type = 'days';

       $posts = Post::getCompanyPost($company_id, 10);

       $dates_arr = Statistics::getNowEndDate($type);
       $dates = array();

       foreach($dates_arr as $key => $date){
         if($type == 'days'){
           $dates[] = $date['period'];
         }
       }

       $grafics_data = Post::getGraphicsPosts($dates_arr, $posts);
       $graphic_config = json_encode(Statistics::getGraphicsBasicLine($dates, $grafics_data));

       return view('partners.posts.main', [
         'company_id' => $company_id,
         'posts' => $posts,
         'config_char' => $graphic_config
       ]);
     }

     public function graphics(Request $request){
       $user_id = Auth::id();
       $company_id = User::companyId($user_id);
       $type = $request->input('type');

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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      $company_id = User::companyId(Auth::id());
      $type = 'days';
      $stories = Post::stories($post->id);

      $dates_arr = Statistics::getNowEndDate($type);
      $dates = array();

      foreach($dates_arr as $key => $date){
        if($type == 'days'){
          $dates[] = $date['period'];
        }
      }

      $grafics_data = Post::getGraphicsPost($dates_arr, $stories);

      $graphic_config = json_encode(Statistics::getGraphicsBasicLine($dates, $grafics_data));

      //'post' => $post
      return view('partners.posts.show', [
        'post' => $post,
        'post_info' => ['data' => json_decode($post->data), 'attachments' => json_decode($post->attachments)],
        'social_code' => $post->socialsCode(),
        'stories' => $stories,
        'profile' => json_decode($post->data),
        'company_id' => $company_id,
        'config_char' => $graphic_config
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
