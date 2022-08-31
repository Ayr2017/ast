@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            {{ __('auth.Dashboard') }}
                            <span class="text-muted small">{{ __('auth.You are logged in!') }}</span>
                        </div>


                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-column align-content-start">

                        @if(auth()->user()->hasRole('admin'))
                            <a class="btn btn-link" href="{{route('admin.users.index')}}">Все пользователи</a>
                        @elseif(auth()->user()->hasRole('specialist'))
                                <a class="btn btn-light" href="{{route('specialist.organizations.index')}}">Все организации</a>
                                <a class="btn btn-light" href="{{route('specialist.farms.index')}}">Все фермы</a>
                                <a class="btn btn-light" href="{{route('specialist.reports.index')}}">Все отчёты</a>
                        @endif
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
