@extends('admin.layouts.app_admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Главная</a></li>
          <li class="active">Пользователи</li>
        </ol>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Пользователи &nbsp;
              <a class="btn btn-primary btn-xs" href="{{ route('admin.user_managment.user.create') }}" target="_self"><i class="glyphicon glyphicon-plus"></i> Добавить</a>
            </h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Логин</th>
                      <th>E-mail</th>
                      <th>Роль</th>
                      <th>Статус</th>
                      <th>Действие</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles()}}</td>
                        @if($user->status == 1)
                          <td>Активен</td>
                        @else
                          <td>Не активен</td>
                        @endif
                        <td>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{ route('admin.user_managment.user.destroy', $user) }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}

                            <a class="btn btn-primary" href="{{ route('admin.user_managment.user.edit', $user) }}" target="_self" title="Редактировать"><i class="glyphicon glyphicon-edit"></i></a>

                            <button type="submit" class="btn btn-danger" title="Удалить"><i class="glyphicon glyphicon-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr></tr>
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
