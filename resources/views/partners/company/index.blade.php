@extends('partners.layouts.app_partners')

@section('content')
  <div class="container company">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/partners') }}">Главная</a></li>
          <li class="active">Компания</li>
        </ol>
        <div class="panel panel-default company_view">
          <div class="panel-heading"><h3>Izzime &nbsp; <a class="btn btn-primary btn-xs" href="{{ route('partners.company.edit', $company->id) }}" target="_self"><i class="glyphicon glyphicon-edit"></i> Редактировать</a></h3></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-7 col-xs-12 company_info">
                <div class="row">
                  <div class="col-sm-12"><h4>Компания</h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Название:</div>
                  <div class="col-sm-7"><b>{{$company->name}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Юридическое название:</div>
                  <div class="col-sm-7"><b>{{$company->fullname}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Фактический адрес:</div>
                  <div class="col-sm-7"><b>{{$company->address}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Юридический адрес:</div>
                  <div class="col-sm-7"><b>{{$company->ur_address}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Телефон:</div>
                  <div class="col-sm-7"><b>{{$company->phone}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">E-mail:</div>
                  <div class="col-sm-7"><b>{{$company->email}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Сайт:</div>
                  <div class="col-sm-7"><b>{{$company->site}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Условия предоставления скидки:</div>
                  <div class="col-sm-7"><b>{{$company->caption}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Добавлена:</div>
                  <div class="col-sm-7"><b>{{ date_format(date_create($company->created_at), 'd/m/Y') }}</b></div>
                </div>
              </div>
              <div class="col-sm-5 col-xs-12 profile_info">
                <div class="row">
                  <div class="col-sm-12"><h4>Профиль</h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Логин:</div>
                  <div class="col-sm-6"><b>{{$profile->name}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">E-mail:</div>
                  <div class="col-sm-6"><b>{{$profile->email}}</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Добавлен:</div>
                  <div class="col-sm-6"><b>{{ date_format(date_create($profile->created_at), 'd/m/Y') }}</b></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
