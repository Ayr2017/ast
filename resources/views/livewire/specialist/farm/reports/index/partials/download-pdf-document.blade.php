<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.cdnfonts.com/css/dejavu-sans" rel="stylesheet">

    <title>Document</title>
    <style>
        body{
            font-size: 10px;
        }
        .table{
            width:100%;
            border-collapse: collapse;
        }

        .vertical-table {
            border-collapse: collapse;
        }
        .vertical-table td, .vertical-table  th {
            border: 1px solid black;
        }
        .vertical-table td {
            width:100px
        }

      * {
          /*font-family: Helvetica, sans-serif;*/
          font-family: 'DejaVu Sans', sans-serif;
      }
      .apexcharts-legend-marker {
          border:1px solid red;
          height:10px;
          width:10px;
      }
    </style>
</head>
<body>
<table class="table table-dark" style="border-bottom:2px solid black;">
    <tbody>
    <tr class="">
        <td>АгроСтар-Трейд+</td>
        <td style="width:100%"></td>
        <td style="white-space: nowrap">Консультант-технолог: {{auth()->user()->surname}} {{auth()->user()->name}}</td>
    </tr>
    <tr class="">
        <td style="white-space: nowrap">тел: +78432788654</td>
        <td style="width:100%"></td>
        <td>тел: {{auth()->user()->phone}}</td>
    </tr>
    <tr class="">
        <td style="padding-bottom: 10px;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/ast-pdf.png'))) }}" width="100px" height="100px"/>
        </td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
<p style="width:100%">
    {{$farm?->region?->name}} - {{$farm?->organization?->name}} -{{$farm?->name}} <span style="position: absolute; right:0">{{date("Y-m-d")}}</span>
</p>
<hr>
<div style="position: relative;page-break-after: always;">
    @include('livewire.specialist.farm.reports.index.partials.pdf-excel-vertical')
</div>
<div style="position: relative;">
    <img src="{{$url}}"  style="width:100%; object-fit: contain" />
    @foreach($formFields as $field)
        <p>{{$field->name}}</p>
{{--        <p style="color:{{\App\Models\FieldCategory::CATEGORY_COLORS[$field->field_category_id]}}">{{$field->name}}</p>--}}
    @endforeach
</div>


</body>
</html>

{{--<img src="data:image/svg+xml;base64,'.base64_encode({{$svg}}).'"  width="100" height="100" />--}}
