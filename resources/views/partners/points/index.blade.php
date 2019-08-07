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
            <h3>{{$company[0]->name}} -
              <small>точки предоставления услуг</small>
               &nbsp; <a class="btn btn-primary btn-xs" href="{{ route('partners.points.create') }}" target="_self"><i class="glyphicon glyphicon-plus"></i> Добавить</a>
             </h3>
           </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Адрес</th>
                      <th>Дата добавления</th>
                      <th>Дата обновления</th>
                      <th>Статус</th>
                      <th>Действие</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($points as $point)
                      <tr>
                        <td>{{$point->address}}</td>
                        <td>{{$point->created_at}}</td>
                        <td>{{$point->updated_at}}</td>
                        @if($point->status == 1)
                          <td>Активна</td>
                        @else
                          <td>Не активна</td>
                        @endif
                        <td>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{ route('partners.points.destroy', $point) }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}

                            <a class="btn btn-primary" href="{{ route('partners.points.edit', $point) }}" target="_self" title="Редактировать"><i class="glyphicon glyphicon-edit"></i></a>

                            <button type="submit" class="btn btn-danger" title="Удалить"><i class="glyphicon glyphicon-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="text-center"><h3>Нет ни одной точки</h3></td>
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
