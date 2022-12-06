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
    <div class="dflex">
        @foreach($templates as $template)
            <button class="btn btn-outline-dark btn-sm my-1" wire:click="acceptFieldsCollection({{$template->id}})">{{$template->name}}</button>
        @endforeach
    </div>
    {{$formFields->count()}}
    {{count($checkedFields)}}
    <div wire:loading.delay.long>
        Идёт загрузка контента. Пожалуйста, подождите ...
    </div>

    @if(!$reports?->isEmpty())
        <div class="table-responsive mt-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Выбор</th>
                    @foreach($formFields as $formField)
                        <th class="text-dark align-top">
                            <div class="d-flex flex-column align-items-start">
                                <input wire:model="checkedFields" type="checkbox" id="formfield_checkbox[{{$formField->id}}]" value="{{$formField->id}}">
                                <span class="text-primary">{{$formField->category->name}}</span>
                                <p>{{$formField->name}}</p>
                            </div>
                        </th>
                    @endforeach
                    @foreach($computedFormFields as $computedFormField)
                        <th class="text-dark align-top">
                            <div class="d-flex flex-column align-items-start">
                                <input wire:model="checkedComputedFields" type="checkbox" id="computed_formfield_checkbox[{{$computedFormField->id}}]" value="{{$computedFormField->id}}">
                                <span class="text-primary">{{$computedFormField->category->name}}</span>
                                <p>{{$computedFormField->name}}</p>
                            </div>
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
                            <td style="background-color: {{$this->colors[$formField->field_category_id]}}">
                                @isset($report?->data["field_$formField?->id"])
                                    @if($formField->type != 'checkbox' && !is_array($report->data["field_$formField->id"]))
                                        {{$report->data["field_$formField->id"] ?? '-'}}
                                    @elseif($formField->type == 'checkbox' && is_array($report->data["field_$formField->id"]))
                                        {{implode(',', $report->data["field_$formField->id"] ?? '-')}}
                                    @else
                                        __exp
                                    @endif
                                @endisset
                            </td>
                        @endforeach
                        @foreach($computedFormFields as $computedFormField)
                            <td style="background-color: {{$this->colors[$computedFormField->field_category_id]}}">
                                {{\App\Services\ComputedFieldsService::execute($computedFormField, $formFields, $report)}}
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
        <div wire:loading.delay.long>
            Идёт загрузка контента. Пожалуйста, подождите ...
        </div>
        <div class="my-2">
            @if($checkedReports)
                <button class="btn btn-outline-primary" wire:click="compareReports">Сравнить</button>
            @endif

            @if($selectedReports?->count())
                <button class="btn btn-outline-primary" wire:click="resetSelectedReports">Сбросить</button>
                <button class="btn btn-outline-primary" wire:click="resetSelectedReportsWithoutFields">Сбросить только отчёты</button>
            @endif

            @if($selectedReports?->count())
                <button class="btn btn-outline-primary" wire:click="recoverSelectedReports">К полному списку</button>
            @endif
                @include('livewire.specialist.farm.reports.index.partials.create-modal')

        </div>
    @else
        <h5 class="h5">Нет данных для этой формы</h5>
    @endif
    <div class="row">
        <div class="col" style="height: 32rem;">
{{--            <livewire:livewire-column-chart--}}
{{--                key="{{ $columnChartModel->reactiveKey() }}"--}}
{{--                :column-chart-model="$columnChartModel"--}}
{{--            />--}}
            <livewire:livewire-line-chart
                key="{{ $lineChartModel->reactiveKey() }}"
                :line-chart-model="$lineChartModel"
            />
        </div>
    </div>

</div>
