@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span
                    class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Отчёт</span> {{$report->id}} {{$report->date}}
            </h3>
        </div>
        <div class="row">
            <p>
                <a class="btn btn-link" href="{{route('specialist.reports.index')}}">Ко всем отчётам</a>
            </p>
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
                            <h6 class="card-subtitle mb-2 text-muted">Огранизация (регион / район)</h6>
                            <h5 class="card-title">
                                <a href="{{route('specialist.organizations.show',['organization' => $report->organization])}}">
                                    {{$report->organization->name}}
                                    <span class="text-muted">({{$report->organization->region->name}}, {{$report->organization->district->name}})</span>
                                </a>
                            </h5>
                        </div>
                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Ферма (регион / район)</h6>
                            <h5 class="card-title">{{$report->farm->name}}
                                <span class="text-muted">({{$report->farm->region->name}}, {{$report->farm->district->name}}) </span>
                            </h5>
                        </div>

{{--                        <div class="p-2 mb-2 bg-info bg-opacity-10">--}}
{{--                            <h6 class="card-subtitle mb-2 text-muted">Создано / Обновлено</h6>--}}
{{--                            <h5 class="card-title">{{$report->created_at}} / {{$report->updated_at}}--}}
{{--                                / {{$report->creator->fullName}}</h5>--}}
{{--                        </div>--}}

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Дата</h6>
                            <h5 class="card-title">{{$report->date}}</h5>
                        </div>

                        <p class="card-text text-muted">
                            Создано: {{$report->created_at}} / {{$report->updated_at}} - {{$report->creator->fullName}}
                        </p>

                        <div class="p-2 mb-2 bg-info bg-opacity-10">
                            <h6 class="card-subtitle mb-2 text-muted">Данные</h6>
                            @include('specialist.reports.partials.report-data-table')
                        </div>

                        <div class="d-flex">
                            <div>

                            <a href="{{route('specialist.reports.edit',['report' => $report])}}"
                               class="btn btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                                Редактировать
                            </a>
                            </div>
                            <form action="{{route('specialist.reports.destroy',['report' => $report->id])}}"
                                  method="POST" class="mx-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    @if(!$report->deleted_at)
                                        <i class="fa fa-trash"></i> Удалить
                                    @else
                                        <i class="fa fa-trash-restore"></i> Восстановить
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
