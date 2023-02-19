<div class="table-responsive">
    <table class="table table-stripped">
        <thead class="thead">
        <tr>
            <th>№</th>
            @foreach($formFields as $formField)
                <th> {{$formField->name}} <br> {{$formField->category->name}}
                </th>
            @endforeach
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>
                <td>{{$loop->iteration}}</td>
                @php
                    $data = $report->data;
                @endphp
                @foreach($formFields as $formField)
                    @if($formField->class === 'computed')
                        <td>
                            {{App\Services\Specialist\FormFieldService::compute($formField, $report)}}
                        </td>

                    @else
                        <td>
                            {{$data['field_'.$formField->id] ?? '-'}}
                        </td>
                    @endif
                @endforeach
                <td>{{$report->date}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
