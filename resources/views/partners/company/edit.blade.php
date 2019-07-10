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
          <div class="panel-heading"><h3>Редактирование компании</h3></div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/partners/company/edit') }}">
              {{ csrf_field() }}

              <input type="hidden" name="_method" value="PUT" />

              <div class="form-group">
                <label for="hashtag" class="col-md-4 control-label">Хештег</label>
                <div class="col-md-6">
                  <input id="hashtag" type="text" class="form-control" name="hashtag" value="#izzyme" required disabled>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-md-4 control-label">Название</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="Izzyme" required>
                </div>
              </div>

              <div class="form-group">
                <label for="fullname" class="col-md-4 control-label">Юридическое название</label>
                <div class="col-md-6">
                  <input id="fullname" type="text" class="form-control" name="fullname" value="ИП Арсланов А.Э." required>
                </div>
              </div>

              <div class="form-group">
                <label for="address" class="col-md-4 control-label">Фактический адрес</label>
                <div class="col-md-6">
                  <input id="address" type="text" class="form-control" name="address" value="Уфа, ул. Набережной реки Уфы, дом 37" required>
                </div>
              </div>

              <div class="form-group">
                <label for="ur_address" class="col-md-4 control-label">Юридический адрес</label>
                <div class="col-md-6">
                  <input id="ur_address" type="text" class="form-control" name="ur_address" value="Уфа, ул. Гагарина, дом 32" required>
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
                <label for="site" class="col-md-4 control-label">Сайт</label>
                <div class="col-md-6">
                  <input id="site" type="text" class="form-control" name="site" value="izzyme.ru" required>
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
