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

                @if (session()->get('msg'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('msg')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <h3 class="h3">Шаблоны полей</h3>
        </div>
        <div class="row">

        </div>
        <div class="row">
            <div class="col">
                @include('specialist.field-templates.partials.field-templates-table')
            </div>
        </div>


    </div>
@endsection
