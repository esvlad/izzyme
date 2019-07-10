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
          <div class="panel-heading"><h3>Izzime &nbsp; <a class="btn btn-primary btn-xs" href="{{ url('/partners/company/edit') }}" target="_self">Редактировать инфо о компании</a></h3></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-5 col-xs-12">
                <div class="row">
                  <div class="col-sm-12"><h4>Профиль</h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Логин:</div>
                  <div class="col-sm-6"><b>es.vlad</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">E-mail:</div>
                  <div class="col-sm-6"><b>swd-w11@yandex.ru</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Роль:</div>
                  <div class="col-sm-6"><b>Суперадминистратор</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Добавлен:</div>
                  <div class="col-sm-6"><b>05/07/2019</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Последнее посещение:</div>
                  <div class="col-sm-6"><b>10/07/2019 18:25</b></div>
                </div>
              </div>
              <div class="col-sm-7 col-xs-12">
                <div class="row">
                  <div class="col-sm-12"><h4>Компания</h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Название:</div>
                  <div class="col-sm-7"><b>Izzyme</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Юридическое название:</div>
                  <div class="col-sm-7"><b>ИП Арсланов А.Э.</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Фактический адрес:</div>
                  <div class="col-sm-7"><b>Уфа, ул. Набережной реки Уфы, дом 37</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Юридический адрес:</div>
                  <div class="col-sm-7"><b>Уфа, ул. Гагарина, дом 32</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Телефон:</div>
                  <div class="col-sm-7"><b>+7-999-888-77-66</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">E-mail:</div>
                  <div class="col-sm-7"><b>partners@izzyme.ru</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Сайт:</div>
                  <div class="col-sm-7"><b>izzyme.ru</b></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
