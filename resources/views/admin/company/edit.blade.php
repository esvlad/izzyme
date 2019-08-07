@extends('admin.layouts.app_admin')

@section('content')
  <div class="container points create">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Главная</a></li>
          <li><a href="{{ route('admin.company.index') }}">Компании</a></li>
          <li class="active">Редактирование</li>
        </ol>
        <div class="panel panel-default points_create">
          <div class="panel-heading"><h3>Редактирование компании - {{$company->name}}</h3></div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.company.update', $company) }}">
              {{ method_field('PUT') }}
              {{ csrf_field() }}

              @include('admin.forms.company')

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
