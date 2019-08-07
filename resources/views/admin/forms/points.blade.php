@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif

@if(!empty($companyes))
  <div class="form-group">
    <label for="" class="col-md-4 control-label">Компания</label>
    <div class="col-md-6">
      <input list="company_id" name="company_id" class="data_list" value="@if(old('company_id')){{old('company_id')}}@else{{$point_company_id or ""}}@endif">
      <datalist id="company_id">
        @foreach($companyes as $company)
          <option value="{{$company->id}}">{{$company->name}}</option>
        @endforeach
      </datalist>
    </div>
  </div>
@endif

@if(!empty($company_id))
  <input type="hidden" name="company_id" value="{{$company_id[0]->id}}">
@endif

<div class="form-group">
  <label for="" class="col-md-4 control-label">Адресс</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="address" value="@if(old('address')){{old('address')}}@else{{$point->address or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Комментарий к адресу <p><small><i>(Уточнение, например в здании на 2 этаже, слева от лестницы)</i></small></p></label>
  <div class="col-md-6">
    <textarea id="address_comment" name="address_comment" rows="4">@if(old('address_comment')){{old('address_comment')}}@else{{$point->address_comment or ""}}@endif</textarea>
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Время работы</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="time_work" value="@if(old('time_work')){{old('time_work')}}@else{{$point->time_work or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Телефон</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="phone" value="@if(old('phone')){{old('phone')}}@else{{$point->phone or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">E-mail</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="email" value="@if(old('email')){{old('email')}}@else{{$point->email or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Гео метка</label>
  <div class="col-md-6">
    <input id="geo" type="text" class="form-control" name="geo" value="@if(old('geo')){{old('geo')}}@else{{$point->geo or ""}}@endif">
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-4">
      <p class="geo_map_caption">Кликните на карте, где находится ваша точка</p>
      <div id="yamap"></div>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Статус</label>
  <div class="col-md-6">
    <select name="status" class="form-control">
      @if(empty($point->status) || $point->status == 1)
        <option value="1" selected>Активна</option>
        <option value="0">Не активена</option>
      @else
        <option value="1">Активна</option>
        <option value="0" selected>Не активена</option>
      @endif
    </select>
  </div>
</div>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script>
  ClassicEditor
    .create( document.querySelector( '#address_comment' ), {
      toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    ymaps.ready(function () {
      var myPlacemark;
      var myMap = new ymaps.Map("yamap", {
        center: [54.732063, 55.944037],
        zoom: 14
      },{
        searchControlProvider: 'yandex#search'
      });

      // Слушаем клик на карте.
        myMap.events.add('click', function (e) {
            var coords = e.get('coords');

            // Если метка уже создана – просто передвигаем ее.
            if (myPlacemark) {
                myPlacemark.geometry.setCoordinates(coords);
            }
            // Если нет – создаем.
            else {
                myPlacemark = createPlacemark(coords);
                myMap.geoObjects.add(myPlacemark);
                // Слушаем событие окончания перетаскивания на метке.
                myPlacemark.events.add('dragend', function () {
                    getAddress(myPlacemark.geometry.getCoordinates());
                });
            }
            getAddress(coords);

            $('#geo').val(coords);
        });

        // Создание метки.
        function createPlacemark(coords) {
            return new ymaps.Placemark(coords, {
                iconCaption: 'поиск...'
            }, {
                preset: 'islands#violetDotIconWithCaption',
                draggable: true
            });
        }

        // Определяем адрес по координатам (обратное геокодирование).
        function getAddress(coords) {
            myPlacemark.properties.set('iconCaption', 'поиск...');
            ymaps.geocode(coords).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);

                myPlacemark.properties
                    .set({
                        iconCaption: firstGeoObject.properties.get('name'),
                        balloonContent: firstGeoObject.properties.get('text')
                    });
            });
        }
    });
</script>
