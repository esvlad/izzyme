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
                  <div class="col-sm-4"><b>02/05/2019</b></div>
                </div>
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Всего клиентов:</div>
                  <div class="col-sm-4"><b>217</b></div>
                </div>
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Всего публикаций:</div>
                  <div class="col-sm-4"><b>250</b></div>
                </div>
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Всего просмотров:</div>
                  <div class="col-sm-4"><b>10661</b></div>
                </div>
                <div class="row statistics_clients_row">
                  <div class="col-sm-5">Общий охват:</div>
                  <div class="col-sm-4"><b>18870</b></div>
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
                      <td>1974</td>
                      <td>1259</td>
                      <td>7408</td>
                      <td>10661</td>
                    </tr>
                    <tr>
                      <td><b>Охват</b></td>
                      <td>5865</td>
                      <td>3384</td>
                      <td>9621</td>
                      <td>18870</td>
                    </tr>
                    <tr>
                      <td><b>Публикации</b></td>
                      <td>69</td>
                      <td>37</td>
                      <td>144</td>
                      <td>250</td>
                    </tr>
                    <tr>
                      <td><b>Клиентов</b></td>
                      <td>65</td>
                      <td>37</td>
                      <td>115</td>
                      <td>217</td>
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
    var config_char_age = <?=$config_char_age;?>;
    var config_char_sex = <?=$config_char_sex;?>;
    var config_char_city = <?=$config_char_city;?>;
  </script>
@endsection
