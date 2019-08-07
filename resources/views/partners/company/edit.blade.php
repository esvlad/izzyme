@extends('partners.layouts.app_partners')

@section('content')
  <div class="container company edit">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/partners') }}">Главная</a></li>
          <li><a href="{{ url('/partners/company') }}">Компания</a></li>
          <li class="active">Редактирование компании</li>
        </ol>
        <div class="panel panel-default company_edit">
          <div class="panel-heading"><h3>Редактирование компании - {{$company->name}}</h3></div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('partners.company.update', $company) }}">
              <input type="hidden" name="_method" value="PUT" />
              <input type="hidden" name="users_mail" value="{{$user_mail}}" />
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
