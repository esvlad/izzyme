@extends('partners.layouts.app_partners')

@section('content')
  <div class="container points create">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/partners') }}">Главная</a></li>
          <li><a href="{{ url('/partners/points') }}">Точки</a></li>
          <li class="active">Создание</li>
        </ol>
        <div class="panel panel-default points_create">
          <div class="panel-heading"><h3>Добавление новой точки</h3></div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('partners.points.store') }}">
              {{ csrf_field() }}

              @include('admin.forms.points')

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
