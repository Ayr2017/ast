<div class="table responsible">
    <table class="table">
        <thead>
        <tr>
            <th>Поле</th>
            <th>Значение</th>
            <th>Единица</th>
        </tr>
        </thead>
        <tbody class="tbody">
        @foreach($formFields as $field)
        <tr>
            <td>{{$field->name}}</td>
            <td>{{($report->data)["field_".$field->id] ?? '~'}}</td>
            <td>{{$field->unit}}</td>
        </tr>
        @endforeach
        <tr>
            <td>Файлы</td>
            <td></td>
            <td>
                @foreach($report->getMedia('reports') as $item)
                    <a download href="{{$item->getFullUrl()}}">{{$item->name}}</a>
                @endforeach
            </td>
        </tr>
        </tbody>
    </table>
</div>
