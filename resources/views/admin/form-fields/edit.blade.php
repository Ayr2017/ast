@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="h3"><span class="text-black-50 d-none d-sm-inline d-lg-inline d-md-inline">Поле </span> {{$form_field->name}}</h3>
        </div>
        <div class="row">
            <p>
                <a class="btn btn-link" href="{{route('admin.form-fields.index')}}">Все поля</a>
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
                <form action="{{route('admin.form-fields.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="form_id" value="{{$form_field->form_id}}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Название</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{old('name') ?? $form_field->name}}" required>
                        <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="field_category_id" class="form-label">Категория поля</label>
                        <select class="form-select mb-3" aria-label=".form-select example" name="field_category_id" id="field_category_id">
                            @foreach($field_categories as $category)
                                <option value="{{$category->id}}" {{(old('field_category_id') ?? $form_field->category->id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <div id="field_category_idHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Тип</label>
                        <select class="form-select mb-3" aria-label=".form-select example" name="type" id="type">
                            <option value="text" {{(old('type') ?? $form_field->type) == "text" ? 'selected' : ''}}>Строка</option>
                            <option value="number" {{(old('type') ?? $form_field->type) == "number" ? 'selected' : ''}}>Число</option>
                            <option value="select" {{(old('type') ?? $form_field->type) == "select" ? 'selected' : ''}}>Выпадающий список</option>
                            <option value="checkbox" {{(old('type') ?? $form_field->type) == "checkbox" ? 'selected' : ''}}>Чекбокс</option>
                            <option value="radio" {{(old('type') ?? $form_field->type) == "radio" ? 'selected' : ''}}>Радиокнопка</option>
                        </select>
                        <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>


                    <div class="mb-3">
                        <label for="select_fields" class="form-label">Элементы для выбора</label>
                        <input type="text" class="form-control" id="select_fields" name="select_fields" aria-describedby="select_fieldsHelp" value="{{old('select_fields') ?? $form_field->joinedSelectFields}}">
                        <div id="select_fieldsHelp" class="form-text">Только для типов Выпадающий список, Чекбокс и Радиокнопка. Введите значения через запятую.</div>
                    </div>

                    <div class="mb-3">
                        <label for="unit" class="form-label">Единица измерения</label>
                        <select class="form-select mb-3" aria-label=".form-select example" name="unit" id="unit">
                            @foreach($field_units as $unit)
                                <option value="{{$unit}}" {{(old('unit')  ?? $form_field->unit)== $unit ? 'selected' : ''}}>{{$unit}}</option>
                            @endforeach
                        </select>
                        <div id="unitHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>


                    <div class="mb-3">
                        <label for="operator_a" class="form-label">Оператор A</label>
                        <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_a" id="operator_a">
                            <option value="sum" {{(old('operator_a') ?? $form_field->operator_a) == "sum" ? 'selected' : ''}}>Сумма</option>
                            <option value="avg" {{(old('operator_a') ?? $form_field->operator_a) == "avg" ? 'selected' : ''}}>Среднее</option>
                            <option value="join" {{(old('operator_a') ?? $form_field->operator_a) == "join" ? 'selected' : ''}}>Склейка</option>
                            <option value="count" {{(old('operator_a') ?? $form_field->operator_a) == "count" ? 'selected' : ''}}>Количество</option>
                        </select>
                        <div id="operator_aHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="operator_b" class="form-label">Оператор B</label>
                        <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_b" id="operator_b">
                            <option value="sum" {{(old('operator_b')?? $form_field->operator_b) == "sum" ? 'selected' : ''}}>Сумма</option>
                            <option value="avg" {{(old('operator_b')?? $form_field->operator_b) == "avg" ? 'selected' : ''}}>Среднее</option>
                            <option value="join" {{(old('operator_b')?? $form_field->operator_b) == "join" ? 'selected' : ''}}>Склейка</option>
                            <option value="count" {{(old('operator_b')?? $form_field->operator_b) == "count" ? 'selected' : ''}}>Количество</option>
                        </select>
                        <div id="operator_bHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="operator_c" class="form-label">Оператор C</label>
                        <select class="form-select mb-3" aria-label=".form-select-lg example" name="operator_c" id="operator_c">
                            <option value="sum" {{(old('operator_b')?? $form_field->operator_c) == "sum" ? 'selected' : ''}}>Сумма</option>
                            <option value="avg" {{(old('operator_b')?? $form_field->operator_c) == "avg" ? 'selected' : ''}}>Среднее</option>
                            <option value="join" {{(old('operator_b')?? $form_field->operator_c) == "join" ? 'selected' : ''}}>Склейка</option>
                            <option value="count" {{(old('operator_b')?? $form_field->operator_c) == "count" ? 'selected' : ''}}>Количество</option>
                        </select>
                        <div id="operator_cHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>

            </div>
        </div>
    </div>
@endsection