@extends('layouts.specialist')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3">Новый отчёт</h3>
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

                <form action="{{route('specialist.reports.create')}}" method="GET">
                    @csrf
                    <div class="col-lg-6">
                        <livewire:specialist.report.create.select-organization-and-farm/>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
