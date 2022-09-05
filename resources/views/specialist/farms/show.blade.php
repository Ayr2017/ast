@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between">
                    <h3 class="h3"><span
                            class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Ферма</span> {{$farm->name}}
                    </h3>
                    <a class="btn btn-link" href="{{route('specialist.reports.create')}}">Подать отчёт</a>
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
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-8">
                <div class="card w-100 my-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-secondary">
                                <tbody>
                                <tr>
                                    <th>Организация</th>
                                    <td>
                                        <a href="{{route('specialist.organizations.show',['organization' =>$farm?->organization_id])}}">{{$farm?->organization?->name}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Регион</th>
                                    <td>
                                        {{$farm?->region?->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Район</th>
                                    <td> {{$farm?->district?->name}} </td>
                                </tr>
                                <tr>
                                    <th>Адрес</th>
                                    <td> {{$farm?->address}} </td>
                                </tr>
                                <tr>
                                    <th>Имя контакта</th>
                                    <td> {{$farm?->contact_name}} </td>
                                </tr>
                                <tr>
                                    <th>Должность контакта</th>
                                    <td> {{$farm?->contact_job_title}} </td>
                                </tr>
                                <tr>
                                    <th>Значение контакта</th>
                                    <td> {{$farm?->contact_value}} </td>
                                </tr>
                                <tr>
                                    <th>Активен</th>
                                    <td> {{$farm?->deleted_at ? 'нет' : "да"}}</td>
                                </tr>
                                <tr>
                                    <th>Всего отчётов</th>
                                    <td>
                                        <a href="{{route('specialist.farms.reports.index',['farm' => $farm])}}">
                                            {{$farm?->reports?->count()}}
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="{{route('specialist.farms.edit',['farm' => $farm])}}" class="btn btn-link">Редактировать</a>
                    <form href="{{route('specialist.farms.destroy',['farm' => $farm])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

