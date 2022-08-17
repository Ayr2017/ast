@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50">Организация</span> {{$organization->name}}</h3>
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
            <div class="col-sm-6 col-lg-12">
                <div class="card w-100 my-1" >
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

                        <p class="card-text">
                            Создано: {{$organization->created_at}} - {{$organization->creator?->name}}
                        </p>

                        <a href="#" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-pen"></i>
                            Редактировать
                        </a>
                    </div>
                </div>

                <div class="card w-100 my-1" >
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Контакты
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse hide" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach($organization->contacts as $contact)
                                            <div class="p-2 mb-2 bg-info bg-opacity-10">
                                                <h5 class="card-title"><span class="card-subtitle text-muted" >Имя: </span> {{$contact->name}}</h5>
                                                <h5 class="card-title"><span class="card-subtitle text-muted" >Должность: </span> {{$contact->job_title}}</h5>
                                                <h5 class="card-title"><span class="card-subtitle text-muted" >{{$contact->type}} : </span> {{$contact->value}}</h5>
                                                <a href="{{route('user.contacts.edit', ['contact' => $contact])}}">Изменить</a>
                                            </div>
                                        @endforeach
                                            <button  class="btn btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                                                <i class="fa-solid fa-file-signature"></i>
                                                Добавить контакт
                                            </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
@include('specialist.organizations.partials.contacts-create-offcanvas')

    </div>
@endsection
