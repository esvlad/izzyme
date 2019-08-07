<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
        return view('admin.posts.index', [
          'posts' => Post::paginate(50)
        ]);
    }

    public function show(Post $post)
    {
        $now = new \DateTime();
        $date = \DateTime::createFromFormat("Y-m-d H:i:s", Post::storiesLast($post->id));
        $interval = $now->diff($date); // получаем разницу в виде объекта DateInterval

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

        return view('admin.posts.show', [
          'post' => $post,
          'social_code' => $post->socialsCode(),
          'stories' => Post::stories($post->id),
          'profile' => json_decode($post->data),
          'config_char' => json_encode($graphic_config),
          'graphics_path' => 'post'
        ]);
    }
}
