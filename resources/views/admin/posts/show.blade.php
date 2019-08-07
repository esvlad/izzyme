@extends('admin.layouts.app_admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Главная</a></li>
          <li><a href="{{ route('admin.posts.index') }}">Посты</a></li>
          <li class="active"> <a class="icons_social" data-socials-code="{{ $social_code }}" href="{{$post->link}}" target="_blank">{{$post->link}}</a></li>
        </ol>
        <div class="panel panel-default">
          <div class="panel-heading"><h3>Статистика просмотров / охват</h3></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <div id="graphics">
                  <canvas id="poststatistics"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading"><h3>Детализация по дням</h3></div>
          <div class="panel-body">
            <table class="table table-striped" style="width: 60%;">
              <thead>
                <tr>
                  <th>Дата</th>
                  <th>Просмотры</th>
                  <th>Охват</th>
                  <th>Лайки</th>
                  <th>Комментарии</th>
                </tr>
              </thead>
              <tbody>
                @forelse($stories as $story)
                  <tr>
                    <td>{{ date_format(date_create($story->date_add), 'd/m/Y H:i') }}</td>
                    <td>{{ $story->views }}</td>
                    <td>{{ $story->coverage }}</td>
                    <td>{{ $story->likes }}</td>
                    <td>{{ $story->comments }}</td>
                  </tr>
                @empty
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="panel panel-default clients_info">
          <div class="panel-heading"><h3>Информация о клиенте</h3></div>
          <div class="panel-body">
              @if(isset($profile->profiles[0]->first_name) || isset($profile->profiles[0]->last_name))
                <div class="row">
                  <div class="col-sm-3">Имя:</div>
                  <div class="col-sm-4"><b>{{$profile->profiles[0]->first_name .' '. $profile->profiles[0]->last_name}}</b></div>
                </div>
              @endif
              @if(isset($profile->profiles[0]->screen_name) || isset($profile->profiles[0]->id))
                @php
                  if($social_code == 'vk'){
                    $profile_link = 'vk.com/';
                  } else {
                    $profile_link = 'instagram.com/';
                  }
                  $profile_link .= $profile->profiles[0]->screen_name ?? 'id'.$profile->profiles[0]->id;
                @endphp
                <div class="row">
                  <div class="col-sm-3">Ссылка на профиль:</div>
                  <div class="col-sm-4"><a class="icons_social" data-socials-code="{{ $social_code }}" href="https://{{$profile_link}}" target="_blank"><b>{{$profile_link}}</b></a></div>
                </div>
              @endif
              @if(isset($profile->profiles[0]->city))
                <div class="row">
                  <div class="col-sm-3">Родной город:</div>
                  <div class="col-sm-4"><b>{{$profile->profiles[0]->city->title}}</b></div>
                </div>
              @endif
              @if(isset($profile->profiles[0]->sex))
                <div class="row">
                  <div class="col-sm-3">Пол:</div>
                  <div class="col-sm-4"><b>{{ ($profile->profiles[0]->sex == 1) ? 'Женский' : 'Мужской' }}</b></div>
                </div>
              @endif
              @if(isset($profile->profiles[0]->bdate))
                <div class="row">
                  <div class="col-sm-3">Дата рождения:</div>
                  <div class="col-sm-4"><b>{{date_format(date_create($profile->profiles[0]->bdate), 'd/m/Y')}}</b></div>
                </div>
              @endif
              @if(isset($profile->profiles[0]->counters))
                @php
                  $followers = $profile->profiles[0]->counters->followers;

                  if($social_code == 'vk' && isset($profile->profiles[0]->counters->friends)){
                    $followers += $profile->profiles[0]->counters->friends;
                  }
                @endphp
                <div class="row">
                  <div class="col-sm-3">Количество подписчиков:</div>
                  <div class="col-sm-4"><b>{{ $followers }}</b></div>
                </div>
                @if(isset($profile->profiles[0]->counters->online_friends))
                  <div class="row">
                    <div class="col-sm-3">Потписчиков он-лайн: <br/><p class="small"><i>(на момент размещения)</i></p></div>
                    <div class="col-sm-4"><b>{{$profile->profiles[0]->counters->online_friends}}</b></div>
                  </div>
                @endif
                  @php
                    function round_count($int){
                      return round($int / 10) * 10;
                    }

                    if($social_code == 'vk'){
                      $coverage = round($followers / 4);
                      $coverage_min = round_count($coverage - 15);
                      $coverage_max = round_count($coverage + 15);
                    } else {
                      $coverage = round($followers / 2.5);
                      $coverage_min = round_count($coverage - 20);
                      $coverage_max = round_count($coverage + 20);
                    }

                     if($followers < 40){
                       $coverage = round($followers / 2);
                     } else {
                       $coverage = $coverage_min .'-'. $coverage_max;
                     }
                  @endphp
                  <div class="row">
                    <div class="col-sm-3">Приблизительный охват:</div>
                    <div class="col-sm-4"><b>{{ $coverage }} подписчиков</b></div>
                  </div>
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var config_char = <?=$config_char;?>;
    var graphics_path = '<?=$graphics_path;?>';

    console.log(config_char);
  </script>
@endsection
