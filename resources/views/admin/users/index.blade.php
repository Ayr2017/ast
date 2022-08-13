@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <h3 class="h3">Пользователи</h3>
{{--        @dump(request()->get('select'))--}}
    </div>
    <div class="row">
        <div class="col">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.users.index',['select' => null])}}"   type="button" class="btn btn-outline-secondary {{request()->get('select') == null ? 'active' : ''}}">Все</a>
                <a href="{{route('admin.users.index',['select' =>'withoutTrashed'])}}"  type="button" class="btn btn-outline-secondary {{request()->get('select') == 'withoutTrashed' ? 'active' : ''}}">Активные</a>
                <a href="{{route('admin.users.index',['select' => 'trashed']) }}"  type="button" class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Должность</th>
                        <th>Управление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->job_title}}</td>
                            <td>0</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
