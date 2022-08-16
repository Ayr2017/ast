@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Организации</h3>
        </div>
        <div class="d-flex">
            <div class="col-2 my-1 ">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('specialist.organizations.create')}}" type="button"
                       class="btn btn-outline-primary">
                        <i class="fa fa-solid fa-plus"></i>
                        Создать
                    </a>
                </div>
            </div>
            <div class="col my-1 ms-auto">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('admin.users.index',['select' => null])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == null ? 'active' : ''}}">Все</a>
                    <a href="{{route('admin.users.index',['select' =>'withoutTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'withoutTrashed' ? 'active' : ''}}">Активные</a>
                    <a href="{{route('admin.users.index',['select' => 'trashed']) }}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
                </div>
            </div>
            <div class="col my-1 ms-auto">
                <div class="form-group">
                    <input type="text" id="serch_inn" class="form-control" placeholder="Поиск по ИНН">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                @include('specialist.organizations.partials.organizations-table')
            </div>
        </div>


    </div>
@endsection
