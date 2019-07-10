@extends('partners.layouts.app_partners')

@section('content')
<div class="container post">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="{{ url('/partners') }}">Главная</a></li>
        <li><a href="{{ url('/partners/posts') }}">Посты</a></li>
        <li class="active">#1</li>
      </ol>
      <div class="panel panel-default">
        <div class="panel-heading"><h3>Статистика просмотров</h3></div>
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
                <th>#</th>
                <th>Дата</th>
                <th>Просмотры</th>
                <th>Лайки</th>
                <th>Комментарии</th>
              </tr>
            </thead>

            <tbody>
              @foreach($post_table as $data)
                <tr>
                  <td>{{ $data['desc_id'] }}</td>
                  <td>{{ $data['static_date'] }}</td>
                  <td>{{ $data['view'] }}</td>
                  <td>{{ $data['likes'] }}</td>
                  <td>{{ $data['comments'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel panel-default clients_info">
        <div class="panel-heading"><h3>Информация о клиенте</h3></div>
        <div class="panel-body">
            <div class="row">
              <div class="col-sm-3">Имя:</div>
              <div class="col-sm-4"><b>Владислав</b></div>
            </div>
            <div class="row">
              <div class="col-sm-3">Ссылка на профиль:</div>
              <div class="col-sm-4"><a class="icons_social" data-socials-ccode="vk" href="https://vk.com/es.vlad" target="_blank"><b>vk.com/es.vlad</b></a></div>
            </div>
            <div class="row">
              <div class="col-sm-3">Родной город:</div>
              <div class="col-sm-4"><b>Уфа</b></div>
            </div>
            <div class="row">
              <div class="col-sm-3">Пол:</div>
              <div class="col-sm-4"><b>Мужской</b></div>
            </div>
            <div class="row">
              <div class="col-sm-3">Дата рождения:</div>
              <div class="col-sm-4"><b>12/03/1990</b></div>
            </div>
            <div class="row">
              <div class="col-sm-3">Количество подписчиков:</div>
              <div class="col-sm-4"><b>199</b></div>
            </div>
            <div class="row">
              <div class="col-sm-3">Потписчиков он-лайн: <br/><p class="small"><i>(на момент размещения)</i></p></div>
              <div class="col-sm-4"><b>24</b></div>
            </div>
            <div class="row">
              <div class="col-sm-3">Приблизительный охват:</div>
              <div class="col-sm-4"><b>90-130 подписчиков</b></div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var config_char = <?=$config_char;?>;
  console.log(config_char);
</script>
@endsection
