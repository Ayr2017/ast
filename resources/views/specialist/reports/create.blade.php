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

                <form action="{{route('specialist.reports.store')}}" method="POST">
                    @csrf
                    <div class="col-lg-6">
                        <livewire:specialist.report.create.select-form />
{{--                        @if($farm)--}}
{{--                            <div class="mb-3">--}}
{{--                                <label for="inn" class="form-label fw-bolder">Ферма</label>--}}
{{--                                <input type="text" disabled="true" readonly class="form-control" name="farm_name"--}}
{{--                                       value="{{old('farm_name') ?? $farm->name}}">--}}
{{--                            </div>--}}
{{--                            <input type="hidden" name="farm_id" id="farm_id" value="{{$farm->id}}">--}}
{{--                            <div class="mb-3">--}}
{{--                                <label for="inn" class="form-label fw-bolder">Ферма</label>--}}
{{--                                <input type="text" disabled="true" readonly class="form-control" name="farm_name"--}}
{{--                                       value="{{old('farm_name') ?? $farm->name}}">--}}
{{--                            </div>--}}
{{--                            <input type="hidden" name="farm_id" id="farm_id" value="{{$farm->id}}">--}}
{{--                        @else--}}
{{--                            Не выбрана форма--}}
{{--                        @endif--}}
{{--                        @if($form)--}}
{{--                            <div class="mb-3">--}}
{{--                                <label for="inn" class="form-label fw-bolder">Ферма</label>--}}
{{--                                <input type="text" disabled="true" readonly class="form-control" name="farm_name"--}}
{{--                                       value="{{old('farm_name') ?? $form->name}}">--}}
{{--                            </div>--}}
{{--                            <input type="hidden" name="farm_id" id="farm_id" value="{{$farm->id}}">--}}
{{--                        @else--}}
{{--                            Не выбрана форма--}}
{{--                        @endif--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="inn" class="form-label fw-bolder">Форма</label>--}}
{{--                            <select class="form-select" id="form_id" name="form_id">--}}
{{--                                @foreach($forms as $form)--}}
{{--                                    <option value="{{$form->id}} {{old('form_id') == $form->id ? 'selected' : ''}}">{{$form->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <div id="innHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="inn" class="form-label fw-bolder">Дата</label>--}}
{{--                            <input type="date" class="form-control" id="date" name="date"--}}
{{--                                   value="{{old('date') ?? date("Y-m-d")}}" required>--}}
{{--                            <div id="innHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
{{--                        </div>--}}
{{--                        @include('specialist.reports.partials.create-report-form')--}}
{{--                        <button type="submit" class="btn btn-primary">Создать</button>--}}
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
