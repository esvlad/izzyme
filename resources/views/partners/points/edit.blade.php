@extends('partners.layouts.app_partners')

@section('content')
  <div class="container points edit">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/partners') }}">Главная</a></li>
          <li><a href="{{ url('/partners/points') }}">Точки</a></li>
          <li class="active">Редактирование</li>
        </ol>
        <div class="panel panel-default points_edit">
          <div class="panel-heading"><h3>Редактирование точки - {{$point->address}}</h3></div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('partners.points.update', $point) }}">
              {{ method_field('PUT') }}
              {{ csrf_field() }}

              @include('admin.forms.points')

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
