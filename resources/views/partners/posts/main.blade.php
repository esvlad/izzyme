@extends('partners.layouts.app_partners')

@section('content')
  <div class="container posts">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li>Главная</li>
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
          <div class="panel-heading"><h3>Последние 10 постов</h3></div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Дата добавления</th>
                  <th>Дата удаления</th>
                  <th>Ссылка</th>
                  <th>Просмотры</th>
                  <th>Охват</th>
                  <th class="text-right">Действие</th>
                </tr>
              </thead>
              <tbody>
                @forelse($posts as $post)
                  <tr>
                    <td>{{$post->date_add}}</td>
                    <td>{{$post->date_end}}</td>
                    <td><a class="icons_social" data-socials-code="" href="{{$post->link}}" target="_blank">{{$post->link}}</a></td>
                    <td>{{$post->view}}</td>
                    <td>{{$post->coverage}}</td>
                    <td>
                      <a href="{{ route('partners.posts.show', $post->id) }}" class="btn btn-default btn_statistics" title="Статистика">
                        <i class="glyphicon glyphicon-stats"></i>
                      </a>
                    </td>
                  </tr>
                @empty
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var graphics_path = 'main';
    var config_char = <?=$config_char;?>;
    console.log(config_char);
  </script>
@endsection
