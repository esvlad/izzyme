@extends('partners.layouts.app_partners')

@section('content')
  <div class="container statistics">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/partners') }}">Главная</a></li>
          <li class="active">Статистика</li>
        </ol>
        <div class="panel panel-default">
          <div class="panel-heading"><h3>Общая статистика по социальным сетям</h3></div>
          <div class="panel-body">
            <div class="row graphicks">
              <div class="col-sm-12">
                <p>Статистика по:</p>
                <div>
                  <button type="button" class="btn btn-primary btn-xs active" data-type="views">просмотрам</button>
                  <button type="button" class="btn btn-primary btn-xs" data-type="coverage">охвату</button>
                  <button type="button" class="btn btn-primary btn-xs" data-type="count">количеству постов</button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div id="graphics">
                  <canvas id="statisticssocialsline"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default statistics_clients">
          <div class="panel-heading"><h3>Общая статистика по клиентам</h3></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Дата добавления компании:</div>
                  <div class="col-sm-4"><b>{{$clients->company_add}}</b></div>
                </div>
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Всего клиентов:</div>
                  <div class="col-sm-4"><b>{{$clients->profiles}}</b></div>
                </div>
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Всего публикаций:</div>
                  <div class="col-sm-4"><b>{{$clients->posts->count}}</b></div>
                </div>
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Всего просмотров:</div>
                  <div class="col-sm-4"><b>{{$clients->posts->views}}</b></div>
                </div>
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Общий охват:</div>
                  <div class="col-sm-4"><b>{{$clients->posts->coverages}}</b></div>
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>ВКонтакте</th>
                      <th>Facebook</th>
                      <th>Instagram</th>
                      <th>Всего</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>Просмотры</b></td>
                      <td>{{$statistics_all->view->vk or "-"}}</td>
                      <td>{{$statistics_all->view->fb or "-"}}</td>
                      <td>{{$statistics_all->view->in or "-"}}</td>
                      <td>{{$statistics_all->view->all or "-"}}</td>
                    </tr>
                    <tr>
                      <td><b>Охват</b></td>
                      <td>{{$statistics_all->coverage->vk or "-"}}</td>
                      <td>{{$statistics_all->coverage->fb or "-"}}</td>
                      <td>{{$statistics_all->coverage->in or "-"}}</td>
                      <td>{{$statistics_all->coverage->all or "-"}}</td>
                    </tr>
                    <tr>
                      <td><b>Публикации</b></td>
                      <td>{{$statistics_all->publication->vk or "-"}}</td>
                      <td>{{$statistics_all->publication->fb or "-"}}</td>
                      <td>{{$statistics_all->publication->in or "-"}}</td>
                      <td>{{$statistics_all->publication->all or "-"}}</td>
                    </tr>
                    <tr>
                      <td><b>Клиентов</b></td>
                      <td>{{$statistics_all->clients->vk or "-"}}</td>
                      <td>{{$statistics_all->clients->fb or "-"}}</td>
                      <td>{{$statistics_all->clients->in or "-"}}</td>
                      <td>{{$statistics_all->clients->all or "-"}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default statistics_clients_other">
          <div class="panel-heading"><h3>Общая статистика по клиентам</h3></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="text-center">Возраст</h4>
                <div id="graphics">
                  <canvas id="statisticsAge"></canvas>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <h4 class="text-center">Пол</h4>
                <div id="graphics">
                  <canvas id="statisticsSex"></canvas>
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <h4 class="text-center">Город</h4>
                <div id="graphics">
                  <canvas id="statisticsCity"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var graphics_path = 'statistics';
    var config_char_age = <?=$config_char_age;?>;
    var config_char_sex = <?=$config_char_sex;?>;
    var config_char_city = <?=$config_char_city;?>;
  </script>
@endsection
