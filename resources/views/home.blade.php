@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('auth.Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('auth.You are logged in!') }}
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{route('admin.users.index')}}">Все пользователи</a>
                        @elseif(auth()->user()->hasRole('specialist'))
                            <a href="{{route('specialist.organizations.index')}}">Все организации</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
