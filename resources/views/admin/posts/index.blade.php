@extends('admin.layouts.app_admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Главная</a></li>
          <li class="active">Посты</li>
        </ol>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Список постов</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Дата добавления</th>
                      <th>Дата удаления</th>
                      <th>Компания</th>
                      <th>Ссылка</th>
                      <th>Просмотры</th>
                      <th>Охват</th>
                      <th class="text-right">Действие</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($posts as $post)
                      <tr>
                        <td>{{$post->date_add}}</td>
                        <td>{{$post->date_end}}</td>
                        <td>{{$post->company()}}</td>
                        <td><a class="icons_social" data-socials-code="{{$post->socialsCode()}}" href="{{$post->link}}" target="_blank">{{$post->link}}</a></td>
                        <td>{{$post->view}}</td>
                        <td>{{$post->coverage}}</td>
                        <td>
                          <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-default btn_statistics" title="Статистика">
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
    </div>
  </div>
@endsection
