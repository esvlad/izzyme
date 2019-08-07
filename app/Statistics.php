<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonImmutable;

class Statistics extends Model
{
    public static function getGraphicsBasicLine($labels, $datasets){
      $graphic = array(
        'type' => 'line',
        'data' => array(
          'labels' => $labels,
          'datasets' => $datasets,
        ),
        'options' => array(
          'maintainAspectRatio' => false,
          'responsive' => true,
          'title' => array(
            'display' => false,
          ),
          'tooltips' => array(
            'mode' => 'index',
            'intersect' => false,
          ),
          'hover' => array(
            'mode' => 'nearest',
            'intersect' => true
          ),
          'scales' => array(
            'xAxes' => [array(
              'display' => true,
              'scaleLabel' => array(
                'display' => true,
                'labelString' => 'Дата'
              )
            )],
            'yAxes' => [array(
              'display' => true,
              'scaleLabel' => array(
                'display' => true,
                'labelString' => 'Просмотры'
              )
            )]
          )
        )
      );

      return $graphic;
    }

    public static function getProfiles($company_id = false){
      if(!$company_id){
        return DB::select('SELECT p.id, c.id as city_id, c.name as city_name, p.birthday, p.sex
          FROM profiles p, cities_profiles cp, cities c
          WHERE p.id IN (SELECT p.id FROM profiles p) AND cp.profiles_id = p.id AND c.id = cp.cities_id');
      } else {
        return DB::select('SELECT p.id, c.id as city_id, c.name as city_name, p.birthday, p.sex
          FROM companies_posts cmp, posts_profiles pp, profiles p, cities_profiles cp, cities c
          WHERE cmp.companies_id = ? AND pp.posts_id = cmp.posts_id AND p.id = pp.profiles_id AND cp.profiles_id = p.id AND c.id = cp.cities_id', [$company_id]);
      }
    }

    public static function getProcentCount($summ, $data){
      $d = (int)$summ / 100;
      $result = array();

      foreach($data[0] as $key => $value){
        if($value == 0){
          $result[$key] = 0;
        } else {
          $r = (float)$value / $d;
          $result[$key] = round($r, 2);
        }
      }

      return $result;
    }

    public static function getStatisticsPostsViewCoverage($company_id = false, $type_date = 'month'){

      if($type_date == 'days'){
        $curdate = Carbon::now()->subDays(8);
        $dt = '%Y-%m-%d';
      } elseif($type_date == 'weeks'){
        $curdate = Carbon::now()->subWeeks(8);
        $dt = '%Y-%m-%d';
      } else {
        $curdate = Carbon::now()->subMonths(8);
        $dt = '%Y-%m';
      }

      if(!$company_id) {
        $posts = DB::select('SELECT p.id, DATE_FORMAT(st.date_add, :dt) as date_add, s.code as social_code, st.views as view, st.coverage
          FROM posts p, posts_socials ps, socials s, posts_stories pst, stories st
          WHERE ps.posts_id = p.id AND s.id = ps.socials_id AND pst.posts_id = p.id
          AND st.id = pst.stories_id AND st.date_add > :curdate', ['dt' => $dt,'curdate' => $curdate]);
      } else {
        $posts = DB::select('SELECT p.id, DATE_FORMAT(st.date_add, :dt) as date_add, s.code as social_code, st.views as view, st.coverage
          FROM posts p, posts_socials ps, socials s, posts_stories pst, stories st
          WHERE p.id IN (SELECT cp.posts_id FROM companies_posts cp WHERE cp.companies_id = :cid)
          AND ps.posts_id = p.id AND s.id = ps.socials_id AND pst.posts_id = p.id
          AND st.id = pst.stories_id AND st.date_add > :curdate', ['dt' => $dt, 'curdate' => $curdate, 'cid' => $company_id]);
      }

      $dates = self::getNowEndDate($type_date);

      $result = array();
      foreach($dates as $value){
        if($type_date == 'weeks'){
          $date = $value;
        } else {
          $date = $value['date'];
        }

        $result['count']['all'][] = self::getStatisticsData($posts, $date, 'count');
        $result['count']['vk'][] = self::getStatisticsData($posts, $date, 'count', 'vk');
        $result['count']['in'][] = self::getStatisticsData($posts, $date, 'count', 'in');

        $result['view']['all'][] = self::getStatisticsData($posts, $date, 'view');
        $result['view']['vk'][] = self::getStatisticsData($posts, $date, 'view', 'vk');

        $result['coverage']['all'][] = self::getStatisticsData($posts, $date, 'coverage');
        $result['coverage']['vk'][] = self::getStatisticsData($posts, $date, 'coverage', 'vk');
        $result['coverage']['in'][] = self::getStatisticsData($posts, $date, 'coverage', 'in');
      }

      return $result;
    }

    public static function getStatisticsData($posts = array(), $date, $type, $code = false){
      $count = 0;
      $coverage = [];
      $count_post = [];

      foreach($posts as $post){
        if(empty($date['period']) && $post->date_add == $date){ //empty($date['period']) &&
          switch($type){
            case 'count':
              if(!$code){
                $count_post['all'][$post->id] = 1;
              } else {
                if($post->social_code == $code){
                  $count_post[$code][$post->id] = 1;
                }
              }
              break;
            case 'view':
              if(!$code){
                $count += (int)$post->view;
              } else {
                if($post->social_code == $code){
                  $count += (int)$post->view;
                }
              }
              break;
            case 'coverage':
              if(!$code){
                $coverage['all'][$post->id] = (int)$post->coverage;
              } else {
                if($post->social_code == $code){
                  $coverage[$code][$post->id] = (int)$post->coverage;
                }
              }
              break;
            default : break;
          }
        } elseif(!empty($date['start']) && !empty($date['end'])){
          $date_add = new Carbon($post->date_add);
          if($date_add->between($date['start'], $date['end'])) {
            switch($type){
              case 'count':
                if(!$code){
                  $count_post['all'][$post->id] = 1;
                } else {
                  if($post->social_code == $code){
                    $count_post[$code][$post->id] = 1;
                  }
                }
                break;
              case 'view':
                if(!$code){
                  $count += (int)$post->view;
                } else {
                  if($post->social_code == $code){
                    $count += (int)$post->view;
                  }
                }
                break;
              case 'coverage':
                if(!$code){
                  $coverage['all'][$post->id] = (int)$post->coverage;
                } else {
                  if($post->social_code == $code){
                    $coverage[$code][$post->id] = (int)$post->coverage;
                  }
                }
                break;
              default : break;
            }
          }
        }
      }

      if($type == 'count'){
        foreach($count_post as $key => $value){
          foreach($value as $k => $v){
            $count += (int)$count_post[$key][$k];
          }
        }
      }

      if($type == 'coverage'){
        foreach($coverage as $key => $value){
          foreach($value as $k => $v){
            $count += (int)$coverage[$key][$k];
          }
        }
      }

      return $count;
    }

    public static function getNowEndDate($type_date){
      $date_arr = array();
      $get_end_date = self::getDateEnd();

      $get_date = $get_end_date[0]->date_add;

      switch($type_date){
        case 'month':
          $period = new CarbonPeriod($get_date, date('Y-m-d'));

          foreach($period as $date){
            if(empty($month) || $month != $date->format('Y-m')){
              $month = $date->format('Y-m');

              $date_arr[] = [
                'period' => $date->format('m.y'),
                'month_name' => self::getMonthNameRu($date->format('n')),
                'date' => $month,
              ];
            }
          }
          break;
        case 'days':
          $period = new CarbonPeriod($get_date, date('Y-m-d'));

          foreach($period as $date){
            $date_arr[] = [
              'period' => $date->format('d.n'),
              'date' => $date->format('Y-m-d'),
            ];
          }
          break;
        default :
          $period = new CarbonPeriod($get_date, date('Y-m-d'));

          foreach($period as $date){
            $w = CarbonImmutable::parse($date->format('Y-m-d'));

            if((empty($week_start) && empty($week_end)) || ($week_start != $w->startOfWeek()->format('Y-m-d') && $week_end != $w->endOfWeek()->format('Y-m-d'))){
              $week_start = $w->startOfWeek()->format('Y-m-d');
              $week_end = $w->endOfWeek()->format('Y-m-d');

              $date_arr[] = [
                'period' => $w->startOfWeek()->format('d.n') .'-'.$w->endOfWeek()->format('d.n'),
                'start' => $week_start,
                'end' => $week_end,
              ];
            }
          }
          break;
      }

      return $date_arr;
    }

    public static function getDateEnd(){
      $dt = '%Y-%m-%d';

      return DB::select('SELECT DATE_FORMAT(s.date_add, :dt) as date_add FROM stories s
      WHERE s.date_add > :carbon ORDER BY s.date_add ASC LIMIT 0,1', ['dt' => $dt, 'carbon' => Carbon::now()->subMonths(8)]);
    }

    public static function getClientsStatistics($company_id = false){
      $result = new \stdClass();
      $dt = '%Y-%m-%d';

      $arr = new \stdClass();
      if(!$company_id){
        $arr->company_add = false;
        $arr->posts = DB::select('SELECT count(*) as count, sum(p.view) as views, sum(p.coverage) as coverages FROM posts p WHERE p.status = 2');
        $arr->profiles_count = DB::table('profiles')->select('count(*) as count')->value('count');
      } else {
        $arr->company_add = DB::select('SELECT DATE_FORMAT(c.created_at, :dt) as date_add FROM companies c WHERE c.id = :cid', ['dt'=>$dt, 'cid'=>$company_id]);
        $arr->posts = DB::select('SELECT count(*) as count, sum(p.view) as views, sum(p.coverage) as coverages FROM posts p
        WHERE p.id IN (SELECT cp.posts_id FROM companies_posts cp WHERE cp.companies_id = ?) AND p.status = 2', [$company_id]);
        $arr->profiles = DB::select('SELECT count(*) as count FROM posts p, posts_profiles pp, profiles pr
        WHERE p.id IN (SELECT cp.posts_id FROM companies_posts cp WHERE cp.companies_id = ?)
        AND p.status = 2 AND pp.posts_id = p.id AND pr.id = pp.profiles_id', [$company_id]);
      }

      foreach($arr as $key => $value){
        foreach($value as $val){
          switch($key){
            case 'company_add' :
              $result->{$key} = $val->date_add;
              break;
            case 'posts' :
              $result->{$key} = new \stdClass();
              foreach($val as $k => $v){
                $result->{$key}->{$k} = $v;
              }
              break;
            case 'profiles' :
              $result->{$key} = $val->count;
              break;
            default : break;
          }
        }
      }

      return $result;
    }

    public static function getStatisticsAll($company_id = false){
      $result = new \stdClass();
      if(!$company_id){
        $data = DB::select('SELECT DISTINCT p.id as post_id, pp.profiles_id as profiles, s.code as social_code, p.view, p.coverage
          FROM posts p, posts_socials ps, socials s, posts_stories pst, stories st, posts_profiles pp, profiles pr
          WHERE p.status = 2 AND ps.posts_id = p.id AND s.id = ps.socials_id AND pst.posts_id = p.id AND st.id = pst.stories_id AND pp.posts_id = p.id AND pr.id = pp.profiles_id');
      } else {
        $data = DB::select('SELECT DISTINCT p.id as post_id, pp.profiles_id as profiles, s.code as social_code, p.view, p.coverage
          FROM posts p, posts_socials ps, socials s, posts_stories pst, stories st, posts_profiles pp, profiles pr
          WHERE p.id IN (SELECT cp.posts_id FROM companies_posts cp WHERE cp.companies_id = :cid) AND p.status = 2 AND ps.posts_id = p.id AND s.id = ps.socials_id
          AND pst.posts_id = p.id AND st.id = pst.stories_id AND pp.posts_id = p.id AND pr.id = pp.profiles_id', ['cid'=>$company_id]);
      }

      $clients = array();
      foreach($data as $value){
        $result->view[$value->social_code][] = $value->view;
        $result->coverage[$value->social_code][] = $value->coverage;
        $result->publication[$value->social_code][] = $value->post_id;
        $result->clients[$value->social_code][] = $value->profiles;
      }

      foreach($result as $key => $value){
        $result->{$key} = new \stdClass();
        foreach($value as $k => $v){
          switch($key){
            case 'clients' :
            case 'publication' :
              $summ = count(array_unique($v));
              break;
            default :
              $summ = array_sum($v);
              break;
          }
          $result->{$key}->{$k} = $summ;
          if(empty($result->{$key}->all)){
            $result->{$key}->all = $summ;
          } else {
            $result->{$key}->all += $summ;
          }
        }
      }

      return $result;
    }

    public static function setClientsId($clients_arr, $clients_id){
      if(!in_array($clients_id, $clients_arr)){
        return $clients_id;
      } else return false;
    }

    /**
     * Increases or decreases the brightness of a color by a percentage of the current brightness.
     *
     * @param   string  $hexCode        Supported formats: '#FFF', '#FFFFFF', 'FFF', 'FFFFFF'
     * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
     *
     * @return  string
     */
    public static function adjustBrightness($hexCode, $adjustPercent) {
        $hexCode = ltrim($hexCode, '#');

        if (strlen($hexCode) == 3) {
            $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
        }

        $hexCode = array_map('hexdec', str_split($hexCode, 2));

        foreach ($hexCode as & $color) {
            $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
            $adjustAmount = ceil($adjustableLimit * $adjustPercent);

            $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
        }

        return '#' . implode($hexCode);
    }

    public static function getMonthNameRu($month){
      $array_month = [
        1 => 'Январь',
        2 => 'Февраль',
        3 => 'Март',
        4 => 'Апрель',
        5 => 'Май',
        6 => 'Июнь',
        7 => 'Июль',
        8 => 'Август',
        9 => 'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
      ];

      return $array_month[$month];
    }
}
