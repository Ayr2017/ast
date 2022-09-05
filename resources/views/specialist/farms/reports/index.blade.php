@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
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
            <h3 class="h3">Отчёты фермы {{$farm->name}}</h3>
        </div>
        <div class="row">
            <div class="col-3 my-1 ">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" type="button"
                       class="btn btn-outline-primary">
                        <nobr>
                            <i class="fa fa-solid fa-plus"></i>
                            <span class="">Сгенерировать отчёт</span>
                        </nobr>
                    </a>
                </div>
            </div>
            <div class="col my-1 ms-auto">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('specialist.farms.reports.index',['farm'=>$farm, 'select' => 'withTrashed'])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'withTrashed' ? 'active' : ''}}">Все</a>
                    <a href="{{route('specialist.farms.reports.index',['farm'=>$farm,'select' =>null])}}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == '' ? 'active' : ''}}">Активные</a>
                    <a href="{{route('specialist.farms.reports.index',['farm'=>$farm,'select' => 'trashed']) }}" type="button"
                       class="btn btn-outline-secondary {{request()->get('select') == 'trashed' ? 'active' : ''}}">Деактивированные</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <livewire:specialist.farm.reports.index.farm-reports-table :farm="$farm" />
{{--                {!! $reports->appends(request()->query())->links() !!}--}}
            </div>
        </div>



    </div>
@endsection
