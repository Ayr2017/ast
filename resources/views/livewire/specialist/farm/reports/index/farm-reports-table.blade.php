<div>

    <div class="my-3">
        <select class="form-select" aria-label="Default select example" wire:model="formId">
            @foreach($this->forms as $form)
                <option value="{{$form->id}}">{{$form->name}}</option>
            @endforeach
        </select>
    </div>

    @if(!$reports?->isEmpty())
        <div class="table-responsive mt-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Выбор</th>
                    @foreach($formFields as $formField)
                        <th class="text-dark">
                            <span class="text-primary">{{$formField->category->name}}</span>
                            {{$formField->name}}
                        </th>
                    @endforeach
                    <th>Дата</th>
                    <th>Податель</th>

                    <th>Создано</th>
                    <th>Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <input type="checkbox" wire:model="checkedReports" value="{{$report->id}}">
                        </td>
                        @foreach($formFields as $formField)
                            <td>
                                @if($formField->type != 'checkbox')
                                    {{$report->data["field_$formField->id"]}}
                                @else
                                    {{implode(',', $report->data["field_$formField->id"])}}
                                @endif
                            </td>
                        @endforeach
                        <td>{{$report?->date}}</td>
                        <td>{{$report?->creator->fullName}}</td>

                        <td>{{$report?->created_at}}</td>
                        <td>
                            <div class="d-flex justify-content-evenly">
                                <div class="py-1">
                                    <a href="{{route('specialist.reports.edit',['report' => $report?->id])}}"
                                       class="btn btn-outline-info">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <form action="{{route('specialist.reports.destroy',['report' => $report?->id])}}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="deleted_at"
                                               value="{{$report?->deleted_at ? 0 : 1}}">
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fa {{$report?->deleted_at ? 'fa-trash-restore    ' : 'fa-trash'}}"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-2">
            @if($checkedReports)
                <button class="btn btn-outline-primary" wire:click="compareReports">Сравнить</button>
            @endif

            @if($selectedReports?->count())
                <button class="btn btn-outline-primary" wire:click="resetSelectedReports">Сбросить</button>
            @endif
        </div>
    @else
        <h5 class="h5">Нет данных для этой формы</h5>
    @endif

</div>
