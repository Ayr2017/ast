@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Организация</span> {{$organization->name}}</h3>
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
                            <h6 class="card-subtitle mb-2 text-muted">Регион</h6>
                            <h5 class="card-title">{{$organization?->region?->name}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Район</h6>
                            <h5 class="card-title">{{$organization?->district?->name}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Адрес</h6>
                            <h5 class="card-title">{{$organization?->inn}}</h5>
                        </div>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">ИНН</h6>
                            <h5 class="card-title">{{$organization?->address}}</h5>
                        </div>

                        <p class="card-text text-muted">
                            Создано: {{$organization->created_at}} - {{$organization->creator?->name}}
                        </p>

                        <a href="{{route('specialist.organizations.edit',['organization' => $organization])}}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-pen"></i>
                            Редактировать
                        </a>
                    </div>
                </div>

                <div class="card w-100 my-1">
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @include('specialist.organizations.partials.show.contacts-accordion-item')
                            @include('specialist.organizations.partials.show.farms-accordion-item')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
