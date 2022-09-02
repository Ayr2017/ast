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
                <td>
                    @if($field->type == 'checkbox')
                        {{implode(',',($report->data)["field_".$field->id] ?? []) }}

                    @else
                        {{($report->data)["field_".$field->id] ?? ''}}</td>
                @endif
                </td>
                <td>{{$field->unit}}</td>
            </tr>
        @endforeach
        <tr>
            <td>Файлы</td>
            <td></td>
            <td>
                @foreach($report->getMedia('reports') as $item)
                    <p>
                    <a href="{{$item->getFullUrl()}}">
                        <i class="fa fa-eye" aria-hidden="true"></i> {{$item->name}}
                    </a>
                    <br>
                    <a download href="{{$item->getFullUrl()}}">
                        <i class="fa fa-download" aria-hidden="true"></i>
                        {{$item->name}}
                    </a>
                    </p>
                @endforeach
            </td>
        </tr>
        </tbody>
    </table>
</div>
