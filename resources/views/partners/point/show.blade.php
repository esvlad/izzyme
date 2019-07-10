@extends('partners.layouts.app_partners')

@section('content')
  <div class="container points">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/partners') }}">Главная</a></li>
          <li><a href="{{ url('/partners/points') }}">Точка</a></li>
          <li class="active">#1</li>
        </ol>
        <div class="panel panel-default points_show">
          <div class="panel-heading"><h3>Izzime &nbsp; <a class="btn btn-primary btn-xs" href="{{ url('/partners/points/1/edit') }}" target="_self">Редактировать</a></h3></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-12"><h4>#1</h4></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Адрес:</div>
                  <div class="col-sm-4"><b>Уфа, ул. Гагарина, дом 32</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Время работы:</div>
                  <div class="col-sm-4"><b>Пн-Вс: 10:00 - 22:00</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Телефон:</div>
                  <div class="col-sm-4"><b>+7-999-888-77-66</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">E-mail:</div>
                  <div class="col-sm-4"><b>partners@izzyme.ru</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-12">Гео отметка:</div>
                  <div class="col-sm-12"></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Добавлено:</div>
                  <div class="col-sm-4"><b>07/07/2019 12:30</b></div>
                </div>
                <div class="row">
                  <div class="col-sm-5">Последний раз обновлялось:</div>
                  <div class="col-sm-4"><b>10/07/2019 15:27</b></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
