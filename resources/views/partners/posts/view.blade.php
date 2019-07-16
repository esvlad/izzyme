@extends('partners.layouts.app_partners')

@section('content')
  <div class="container posts">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li>Главная</li>
        </ol>
        <div class="panel panel-default">
          <div class="panel-heading"><h3>Статистика просмотров</h3></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <canvas id="postsweekmain"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading"><h3>Последние 10 постов</h3></div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Дата добавления</th>
                  <th>Ссылка</th>
                  <th>Просмотры</th>
                  <th>Дата удаления</th>
                  <th class="text-right">Действие</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>6</td>
                  <td>2019/07/10 10:02</td>
                  <td><a class="icons_social" data-socials-code="vk" href="https://vk.com/id549337060?w=wall549337060_9" target="_blank">vk.com/id549337060?w=wall549337060_9</a></td>
                  <td>18</td>
                  <td>-</td>
                  <td><a href="{{url('partners/posts/view/1')}}">Статистика</a></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>2019/07/10 9:47</td>
                  <td><a class="icons_social" data-socials-code="vk" href="https://vk.com/es.vlad?w=wall243578383_1254" target="_blank">vk.com/es.vlad?w=wall243578383_1254</a></td>
                  <td>12</td>
                  <td>-</td>
                  <td><a href="{{url('partners/posts/view/1')}}">Статистика</a></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>2019/07/09 18:46</td>
                  <td><a class="icons_social" data-socials-code="in" href="https://www.instagram.com/p/BW-14wvlFzS/" target="_blank">instagram.com/p/BW-14wvlFzS/</a></td>
                  <td>34</td>
                  <td>-</td>
                  <td><a href="{{url('partners/posts/view/1')}}">Статистика</a></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>2019/07/09 18:22</td>
                  <td><a class="icons_social" data-socials-code="fb" href="https://www.facebook.com/photo.php?fbid=2323298004421997&set=a.394808933937590&type=1&theater" target="_blank">facebook.com/photo.php?fbid=2323298004421997&set=a.394808933937590&type=1&theater</a></td>
                  <td>17</td>
                  <td>2019/07/10 12:00</td>
                  <td><a href="{{url('partners/posts/view/1')}}">Статистика</a></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>2019/07/09 16:23</td>
                  <td><a class="icons_social" data-socials-code="vk" href="https://vk.com/id549337060?w=wall549337060_9" target="_blank">vk.com/id549337060?w=wall549337060_9</a></td>
                  <td>21</td>
                  <td>-</td>
                  <td><a href="{{url('partners/posts/view/1')}}">Статистика</a></td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>2019/07/09 15:40</td>
                  <td><a class="icons_social" data-socials-code="in" href="https://www.instagram.com/p/6SF7sJgNox/" target="_blank">instagram.com/p/6SF7sJgNox/</a></td>
                  <td>29</td>
                  <td>-</td>
                  <td><a href="{{url('partners/posts/view/1')}}">Статистика</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var config_char = <?=$config_char;?>;
  </script>
@endsection
