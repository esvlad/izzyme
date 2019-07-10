@extends('partners.layouts.app_partners')

@section('content')
  <div class="container points">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/partners') }}">Главная</a></li>
          <li class="active">Точки</a></li>
        </ol>
        <div class="panel panel-default points_info">
          <div class="panel-heading">
            <h3>Izzime -
              <small>точки предоставления услуг</small>
               &nbsp; <a class="btn btn-primary btn-xs" href="{{ url('/partners/points/create') }}" target="_self">Добавить</a>
              <a class="btn btn-danger btn-xs">Удалить отмеченные</a>
             </h3>
           </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Адрес</th>
                      <th>Статус</th>
                      <th>Действие</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="checkbox" name="point[]" value="1" /></td>
                      <td>Уфа, ул. Гагарина, дом 32</td>
                      <td>Активен</td>
                      <td><a href="{{ url('/partners/points/1/edit') }}" target="_self">Редактировать</a></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="point[]" value="1" /></td>
                      <td>Уфа, ул. Гагарина, дом 15</td>
                      <td>Не активен</td>
                      <td><a href="{{ url('/partners/points/1/edit') }}" target="_self">Редактировать</a></td>
                    </tr>
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
