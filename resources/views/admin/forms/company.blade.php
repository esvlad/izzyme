@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif

@if(!empty($users))
  <div class="form-group">
    <label for="" class="col-md-4 control-label">Пользователь</label>
    <div class="col-md-6">
      <input list="users_id" name="users_mail" class="data_list" value="{{$user_mail}}">
      <datalist id="users_id">
        @foreach($users as $user)
          <option value="{{$user->email}}">{{$user->name}}</option>
        @endforeach
      </datalist>
    </div>
  </div>
@endif

<div class="form-group">
  <label for="" class="col-md-4 control-label">Название</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="name" value="@if(old('name')){{old('name')}}@else{{$company->name or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Хештег</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="hashtag" value="@if(old('name')){{old('name')}}@else{{$company->name or ""}}@endif"@if(empty($users)) disabled @endif>
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Полное название</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="fullname" value="@if(old('fullname')){{old('fullname')}}@else{{$company->fullname or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Фактический адрес</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="address" value="@if(old('address')){{old('address')}}@else{{$company->address or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Юридический адрес</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="ur_address" value="@if(old('ur_address')){{old('ur_address')}}@else{{$company->ur_address or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Телефон</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="phone" value="@if(old('phone')){{old('phone')}}@else{{$company->phone or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">E-mail</label>
  <div class="col-md-6">
    <input type="email" class="form-control" name="email" value="@if(old('email')){{old('email')}}@else{{$company->email or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Сайт</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="site" value="@if(old('site')){{old('site')}}@else{{$company->site or ""}}@endif">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Описание предоставления скидки</label>
  <div class="col-md-6">
    <textarea id="company_caption" name="caption" rows="4">@if(old('caption')){{old('caption')}}@else{{$company->caption or ""}}@endif</textarea>
  </div>
</div>
<script>
  ClassicEditor
    .create( document.querySelector( '#company_caption' ), {
      toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
