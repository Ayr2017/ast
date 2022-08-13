<div class="col-lg-6">
<div class="mb-3">
    <label for="name" class="form-label fw-bolder">Имя</label>
    <input type="text" class="form-control" id="name" name="name">
    <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
</div>

<div class="mb-3">
    <label for="surname" class="form-label fw-bolder">Фамилия</label>
    <input type="text" class="form-control" id="surname" name="surname">
    <div id="surnameHelp" class="form-text">We'll never share your email with anyone else.</div>
</div>

<div class="mb-3">
    <label for="phone" class="form-label fw-bolder">Телефон</label>
    <input type="text" class="form-control" id="phone" name="phone">
    <div id="phoneHelp" class="form-text">We'll never share your email with anyone else.</div>
</div>

<div class="mb-3">
    <label for="job_title" class="form-label fw-bolder">Должность</label>
    <input type="text" class="form-control" id="job_title" name="job_title">
    <div id="jobTitleHelp" class="form-text">We'll never share your email with anyone else.</div>
</div>

<div class="mb-3">
    <label for="email" class="form-label fw-bold">Email</label>
    <input type="email" class="form-control" id="email"  name="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
</div>

{{--<div class="mb-3">--}}
{{--    <label for="exampleInputPassword1" class="form-label">Password</label>--}}
{{--    <input type="password" class="form-control" id="exampleInputPassword1">--}}
{{--</div>--}}

<div class="mb-3">
    <label for="email" class="form-label fw-bolder">Роли</label>
    @foreach($roles as $role)
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="roles" name="roles[]" value="{{$role->name}}" {{$user->hasRole($role->name) ? 'checked' : ''}}>
        <label class="form-check-label" for="exampleCheck1">{{$role->name}}</label>
    </div>
        @endforeach

</div>

<button type="submit" class="btn btn-primary">Обновить</button>
</div>
