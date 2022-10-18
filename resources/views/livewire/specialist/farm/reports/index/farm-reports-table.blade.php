<div>
    <div class="row alert alert-secondary">
        <div class="col-3">
            <div class="">
                <label for="exampleInputEmail1" class="form-label">Форма</label>
                <select class="form-select" aria-label="Default select example" wire:model="formId">
                    @foreach($this->forms as $form)
                        <option value="{{$form->id}}">{{$form->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-3">

            <div class="">
                <label for="dateFrom" class="form-label">Дата от</label>
                <input type="date" class="form-control" id="dateFrom" wire:model="dateFrom"
                       aria-describedby="dateFromHelp">
                <div id="dateHelp" class="form-text">Дата от</div>
            </div>
        </div>
        <div class="col-3">
            <div class="">
                <label for="dateTo" class="form-label">Дата до</label>
                <input type="date" class="form-control" id="dateTo" wire:model="dateTo" aria-describedby="dateToHelp">
                <div id="dateHelp" class="form-text">Дата до</div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex flex-column align-content-stretch">
                <label for="dateTo" class="form-label">_</label>
                <button class="btn btn-outline-dark " wire:click="showReports">Показать</button>
            </div>
        </div>
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
                    <th>-</th>
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
                                @if($formField->type != 'checkbox' )
                                    @if(!is_array($report?->data["field_$formField?->id"]))
                                        {{$report->data["field_$formField->id"] ?? '-'}}
                                    @else
                                        {{implode(',', $report->data["field_$formField->id"] ?? '-')}}
                                    @endif
                                @else
                                    {{implode(',', $report->data["field_$formField->id"] ?? '-')}}
                                @endif
                            </td>
                        @endforeach
                        <td>{{$report?->date}}</td>
                        <td>{{$report?->creator->fullName}}</td>

                        <td>{{$report?->created_at}}</td>
                        <td>
                            -
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

            @if($selectedReports?->count())
                <button class="btn btn-outline-primary" wire:click="recoverSelectedReports">К полному списку</button>
            @endif
        </div>
    @else
        <h5 class="h5">Нет данных для этой формы</h5>
    @endif
    <div class="row">
        <div class="col" style="height: 32rem;">
            <livewire:livewire-column-chart
                key="{{ $columnChartModel->reactiveKey() }}"
                :column-chart-model="$columnChartModel"
            />
            <livewire:livewire-line-chart
                key="{{ $lineChartModel->reactiveKey() }}"
                :line-chart-model="$lineChartModel"
            />
        </div>
    </div>

</div>
