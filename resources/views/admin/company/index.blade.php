@extends('admin.layouts.app_admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Главная</a></li>
          <li class="active">Компании</li>
        </ol>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Список компаний &nbsp;
              <a class="btn btn-primary btn-xs" href="{{ route('admin.company.create') }}" target="_self"><i class="glyphicon glyphicon-plus"></i> Добавить</a></h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Название</th>
                      <th>Хэштег</th>
                      <th>Дата добавления</th>
                      <th>Дата обновления</th>
                      <th>Статус</th>
                      <th>Действие</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($companyes as $company)
                      <tr>
                        <td>{{$company->name}}</td>
                        <td>{{$company->hashtag}}</td>
                        <td>{{$company->created_at}}</td>
                        <td>{{$company->updated_at}}</td>
                        <td>{{$company->status}}</td>
                        <td>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{ route('admin.company.destroy', $company) }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}

                            <a class="btn btn-default btn_statistics" href="" target="_self" title="Статистика"><i class="glyphicon glyphicon-stats"></i></a>
                            <a class="btn btn-primary" href="{{ route('admin.company.edit', $company) }}" target="_self" title="Редактировать"><i class="glyphicon glyphicon-edit"></i></a>

                            <button type="submit" class="btn btn-danger" title="Удалить"><i class="glyphicon glyphicon-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="text-center"><h3>Тут пусто</h3></td>
                      </tr>
                    @endforelse
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
