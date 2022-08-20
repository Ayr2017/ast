@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Ферма</span> {{$farm->name}}</h3>
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
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
                <div class="card w-100 my-1">
                    <div class="card-body">

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Организация</h6>
                            <h5 class="card-title">{{$farm?->organization?->name}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Регион</h6>
                            <h5 class="card-title">{{$farm?->region?->name}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Район</h6>
                            <h5 class="card-title">{{$farm?->district?->name}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Адрес</h6>
                            <h5 class="card-title">{{$farm?->address}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Имя контакта</h6>
                            <h5 class="card-title">{{$farm?->contact_name}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Должность контакта</h6>
                            <h5 class="card-title">{{$farm?->contact_job_title}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Значение контакта</h6>
                            <h5 class="card-title">{{$farm?->contact_value}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Активен</h6>
                            <h5 class="card-title">{{$farm?->deleted_at ? 'нет' : "да"}}</h5>
                        </div>

                    </div>
                </div>
                <a href="{{route('specialist.farms.edit',['farm' => $farm])}}" class="btn btn-link">Редактировать</a>
            </div>
        </div>
    </div>
@endsection

