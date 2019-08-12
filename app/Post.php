<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    public function company(){
      $companies_id = DB::table('companies_posts')->where('posts_id', $this->id)->value('companies_id');

      return DB::table('companies')->where('id', $companies_id)->value('name');
    }

    public function socialsCode(){
      $socials_id = DB::table('posts_socials')->where('posts_id', $this->id)->value('socials_id');

      return DB::table('socials')->where('id', $socials_id)->value('code');
    }

    public static function stories($post_id){
      $stories_ids = DB::table('posts_stories')->where('posts_id', $post_id)->pluck('stories_id');

      return DB::table('stories')->whereIn('id', $stories_ids)->orderBy('id', 'desc')->get();
    }

    public static function storiesLast($post_id){
      $stories_ids = DB::table('posts_stories')->where('posts_id', $post_id)->pluck('stories_id');

      return DB::table('stories')->whereIn('id', $stories_ids)->orderBy('date_add')->limit(1)->value('date_add');
    }

    public static function getCompanyPost($company_id, $limit = false){
      $post_ids = DB::table('companies_posts')->where('companies_id', $company_id)->pluck('posts_id');

      if(!$limit){
        return DB::table('posts')->whereIn('id', $post_ids)->where('status', 2)->orderBy('date_add', 'desc')->get();
      } else {
        return DB::table('posts')->whereIn('id', $post_ids)->where('status', 2)->orderBy('date_add', 'desc')->limit(10)->get();
      }
    }

    public static function getGraphicsPosts($arr_date = array(), $posts = false){
      $post_ids = array();
      foreach($posts as $post){
        $post_ids[] = $post->id;
      }
      $post_ids = join(',',$post_ids);

      $stories = DB::select('SELECT p.id, DATE_FORMAT(s.date_add, :dt) as date_add, s.comments, s.likes, s.views, p.coverage
        FROM posts p, posts_stories ps, stories s
        WHERE p.id IN ('.$post_ids.') AND ps.posts_id = p.id AND s.date_add > :curdate AND s.id = ps.stories_id',
        ['dt' => '%Y-%m-%d', 'curdate' => Carbon::now()->subDays(count((array)$arr_date))]
      );

      $arr_data = ['comments','likes','views','coverage'];
      $date = [];
      $points = [];

      foreach($arr_date as $key => $value){
        $date[] = $value['date'];

        $count = ['comments' => 0, 'likes' => 0, 'views' => 0, 'coverage' => 0];
        foreach($stories as $story){
          if($story->date_add == $value['date']){
            $count['comments'] += (int)$story->comments;
            $count['likes'] += (int)$story->likes;
            $count['views'] += (int)$story->views;
            $count['coverage'] += (int)$story->coverage;
          }
        }
        foreach($arr_data as $k => $v){
          $points[$v][] = $count[$v];
        }
      }

      $datasets = [];
      foreach($points as $key => $value){
        switch($key){
          case 'comments':
            $label = 'Комментарии';
            $color = 'red';
            break;
          case 'likes':
            $label = 'Лайки';
            $color = 'blue';
            break;
          case 'views':
            $label = 'Просмотры';
            $color = 'orange';
            break;
          case 'coverage':
            $label = 'Охват';
            $color = 'green';
            break;
          default : break;
        }

        $datasets[] = [
          'label' => $label,
          'backgroundColor' => $color,
          'borderColor' => $color,
          'data' => $value,
          'fill' => false,
        ];
      }

      return $datasets;
    }

    private static function preprint($data){
      echo '<pre>';
      print_r($data);
      echo '</pre>';
    }

    public static function getGraphicsPost($arr_date, $stories){
      $points = array();
      $date = array();
      krsort($arr_date);

      foreach($arr_date as $value){
        $date[] = $value['date'];
      }


      foreach($stories as $key => $story){
        $date_add = new Carbon($story->date_add);

        if($date_add->format('Y-m-d') == $date[$key]){
          if(!empty($story->views)){
            $points['view'][$key] = (int)$story->views;
          }

          $points['comments'][] = (int)$story->comments;
          $points['likes'][] = (int)$story->likes;
          $points['coverage'][] = (int)$story->coverage;
        } else {
          if(!empty($story->views)){
            $points['view'][$key] = 0;
          }

          $points['comments'][] = 0;
          $points['likes'][] = 0;
          $points['coverage'][] = 0;
        }
      }

      $datasets = [
        array(
          'label' => 'Охват',
          'backgroundColor' => 'blue',
          'borderColor' => 'blue',
          'data' => array_reverse($points['coverage']),
          'fill' => false,
        ),
        array(
          'label' => 'Лайки',
          'backgroundColor' => 'orange',
          'borderColor' => 'orange',
          'data' => array_reverse($points['likes']),
          'fill' => false,
        ),
        array(
          'label' => 'Комментарии',
          'backgroundColor' => 'green',
          'borderColor' => 'green',
          'data' => array_reverse($points['comments']),
          'fill' => false,
        ),
      ];

      if(!empty($points['view'])){
        $datasets[] = array(
          'label' => 'Просмотры',
          'backgroundColor' => 'red',
          'borderColor' => 'red',
          'data' => array_reverse($points['view']),
          'fill' => false,
        );
      }

      return $datasets;
    }
}
