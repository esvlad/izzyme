<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    public function getGraphicsBasicLine($labels, $datasets){
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
}
