@extends('partners.layouts.app_partners')

@section('content')
  <div class="container points edit">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/partners') }}">Главная</a></li>
          <li><a href="{{ url('/partners/points') }}">Точки</a></li>
          <li class="active">Редактирование точки</li>
        </ol>
        <div class="panel panel-default points_edit">
          <div class="panel-heading"><h3>Редактирование точки</h3></div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/partners/points/1') }}">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT" />

              <div class="form-group">
                <label for="address" class="col-md-4 control-label">Адрес</label>
                <div class="col-md-6">
                  <input id="address" type="text" class="form-control" name="address" value="Уфа, ул. Гагарина, дом 32" required>
                </div>
              </div>

              <div class="form-group">
                <label for="time_work" class="col-md-4 control-label">Время работы</label>
                <div class="col-md-6">
                  <input id="time_work" type="text" class="form-control" name="time_work" value="Пн-Вс: с 10:00 до 22:30" required>
                </div>
              </div>

              <div class="form-group">
                <label for="phone" class="col-md-4 control-label">Телефон</label>
                <div class="col-md-6">
                  <input id="phone" type="text" class="form-control" name="phone" value="+7-999-888-77-66" required>
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-4 control-label">E-mail</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="partners@izzyme.ru" required>
                </div>
              </div>

              <div class="form-group">
                <label for="coords" class="col-md-4 control-label">Координаты</label>
                <div class="col-md-6">
                  <input id="coords" type="text" class="form-control" name="coords" value="">
                </div>
              </div>

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
