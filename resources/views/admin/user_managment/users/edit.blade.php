@extends('admin.layouts.app_admin')

@section('content')
  <div class="container points edit">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Главная</a></li>
          <li><a href="{{ route('admin.user_managment.user.index') }}">Пользователи</a></li>
          <li class="active">Редактирование</li>
        </ol>
        <div class="panel panel-default points_edit">
          <div class="panel-heading"><h3>Редактирование пользователя</h3></div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.user_managment.user.update', $user) }}">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT" />

              @include('admin.forms.user')

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
