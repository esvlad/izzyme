@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="form-group">
  <label for="" class="col-md-4 control-label">Роль</label>
  <div class="col-md-6">
    @if($auth_role != 'superamin')
      <select name="roles.users" class="form-control" disabled>
        <option value="3" selected>Партнёр</option>
      </select>
    @else
    <select name="roles_users" class="form-control">
      @forelse($roles as $role)
        @if($role->slug != 'superamin')
          @if(!empty($user_role) && $user_role == $role->slug)
            <option value="{{$role->id}}" selected>{{$role->name}}</option>
          @else
            <option value="{{$role->id}}">{{$role->name}}</option>
          @endif
        @endif
      @empty
      @endforelse
    </select>
    @endif
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Логин</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="name" value="@if(old('name')){{old('name')}}@else{{$user->name or ""}}@endif" required>
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">E-mail</label>
  <div class="col-md-6">
    <input type="email" class="form-control" name="email" value="@if(old('email')){{old('email')}}@else{{$user->email or ""}}@endif" required>
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Пароль</label>
  <div class="col-md-6">
    <input type="password" class="form-control" name="password">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Подтверждение пароля</label>
  <div class="col-md-6">
    <input type="password" class="form-control" name="password_confirmation">
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Статус</label>
  <div class="col-md-6">
    <select name="status" class="form-control">
      @if(!empty($user->status) && $user->status == 1)
        <option value="1" selected>Активен</option>
        <option value="0">Не активен</option>
      @else
        <option value="1">Активен</option>
        <option value="0" selected>Не активен</option>
      @endif
    </select>
  </div>
</div>
