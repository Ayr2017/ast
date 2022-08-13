@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Редактирование пользователя Id {{$user->id}}</h3>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="POST">
                @csrf
                    @method('PATCH')
                    @include('admin.users.partials.create-edit-form')
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
            </div>
        </div>


    </div>
@endsection
