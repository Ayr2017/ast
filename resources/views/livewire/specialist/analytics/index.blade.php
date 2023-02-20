<div>
    <div class="row">
        <fieldset>
            <div class="col">
                <div class="row g-3 align-items-center">
                    {{-- Оргранизация--}}
                    <div class="col">
                        <label for="exampleDataList" class="form-label">Организация</label>
                        <input
                            class="form-control {{$organisationId ? 'border border-success' : 'border border-danger'}}"
                            list="organisationsDatalistOptions" id="organisation" name="organisation"
                            wire:model="selectedOrganisation"
                            placeholder="Начните вводить название организации" autocomplete="off">
                        <datalist id="organisationsDatalistOptions">
                            @foreach($organisations as $organisation)
                                <option value="{{$organisation->name}}" wire:key="{{$organisation->id}}"
                                        id="{{$organisation->id}}">
                            @endforeach
                        </datalist>
                    </div>

                    {{-- Ферма--}}
                    <div class="col">
                        <label for="exampleDataList" class="form-label">Ферма</label>
                        <input class="form-control {{$farmId ? 'border border-success' : 'border border-danger'}}"
                               list="datalistOptions" id="farm" name="farm" wire:model="selectedFarm"
                               placeholder="Начните вводить название фермы" autocomplete="off">
                        <datalist id="datalistOptions">
                            @foreach($farms as $farm)
                                <option value="{{$farm->name}}" wire:key="{{$farm->id}}" id="{{$farm->id}}">
                            @endforeach
                        </datalist>
                    </div>

                    {{-- Форма--}}
                    <div class="col">
                        <label for="exampleDataList" class="form-label">Формы</label>
                        <select class="form-select" aria-label="Default select example" name="form_id" id="form_id"
                                wire:model="formId">
                            <option value="0">Выберите форму</option>
                            @foreach($forms as $form)
                                <option value="{{$form->id}}" wire:key="{{$form->id}}"
                                        id="{{$form->id}}">{{$form->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- DateFrom--}}
                    <div class="col">
                        <div class="">
                            <label for="dateFrom" class="form-label">Дата от</label>
                            <input type="date" class="form-control" id="dateFrom" name="dateFrom" placeholder=""
                                   value="{{ '2023-01-01'}}" wire:model="dateFrom">
                        </div>
                    </div>

                    {{-- DateTo--}}
                    <div class="col">
                        <div class="">
                            <label for="dateTo" class="form-label">Дата от</label>
                            <input type="date" class="form-control" id="dateTo" name="dateTo" placeholder=""
                                   value="{{ now()->format("Y-m-d")}}" max="{{now()->format("Y-m-d")}}"
                                   wire:model="dateTo">
                        </div>
                    </div>
                    {{-- Find--}}
                    <div class="col">
                        <div class="mt-4 pt-1">
                            <button type="button" class="btn btn-outline-secondary"
                                    wire:click="findReports" {{$buttonDisabled ? 'disabled' : ''}}>Найти
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="row my-2">
        <fieldset wire:loading.attr="disabled">
            <div class="row">
                <div class="col-4">
                    <div class="row g-3 align-items-center">
                        <div>
                            <div class="my-1">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-outline-dark"
                                            wire:click="unselectAllFields">Убрать выделение
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-dark"
                                            wire:click="selectAllFields">
                                        Выделить всё
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row g-3 align-items-center">
                        <div style="overflow-x: auto; white-space: nowrap;">
                            <div class="btn-group my-1" role="group" aria-label="templates">
                                <button type="button" class="btn btn-sm btn-outline-dark" wire:click="useAllFields">Все
                                    поля
                                </button>
                                @foreach($formFieldTemplates as $template)
                                    <button type="button"
                                            class="btn btn-sm btn-outline-dark"
                                            wire:click="useFormFieldTemplate({{$template->id}})">{{$template->name}}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="row">
        <fieldset wire:loading.attr="disabled">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-stripped">
                        <thead class="thead">
                        <tr>
                            <th>№</th>
                            <th>Выбор</th>
                            @foreach($this->formFields as $formField)
                                <th>
                                    <p class="mb-1">
                                        <input type="checkbox" wire:model="selectedFormFields" id="{{$formField->id}}"
                                               value="{{$formField->id}}">
                                        {{$formField->name}}
                                    </p>
                                    <span class="text-muted" style="font-weight: lighter">
                                        {{$formField->category->name}}
                                    </span>
                                </th>
                            @endforeach
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td>{{$report->id}}</td>
                                <td>
                                    <input type="checkbox" wire:model="selectedReports" id="{{$report->id}}"
                                           value="{{$report->id}}">
                                </td>
                                @php
                                    $data = $report->data;
                                @endphp
                                @foreach($this->formFields as $formField)
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

                <div class="row my-2">
                    <fieldset wire:loading.attr="disabled">
                        <div class="row">
                            <div class="col">
                                <div class="row g-3 align-items-center">
                                    <div style="overflow-x: auto; white-space: nowrap;">
                                        <div class="btn-group my-1" role="group" aria-label="templates">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                    wire:click="compareReports" {{count($reports) > 0 ? '' : 'disabled'}}>Сравнить
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                    wire:click="clearSelectedReports">Сбросить
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#saveTemplateModal">Сохранить
                                                шаблон полей
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                    wire:click="downloadExcel">Скачать Excell
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                    wire:click="downloadPdf">Скачать PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="row">
                    <div class="col" style="height: 32rem;" id="svgWrapper">

                        @if($this->getLCM())
                            <livewire:livewire-line-chart
                                key="{{$this->lineChartModel->reactiveKey() ?? 123}}"
                                :line-chart-model="$this->lineChartModel"
                            />
                        @endif
                    </div>
                </div>


            </div>
        </fieldset>
        <!-- Modal -->
        <div class="modal fade" id="saveTemplateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Сохранение шаблона</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="templateName" class="form-label">Название</label>
                            <input type="text" class="form-control" id="templateName" wire:model="templateName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" wire:click="saveFieldsTemplate">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('close', e => {
            el = document.getElementById('saveTemplateModal')
            var modal = bootstrap.Modal.getInstance(el)
            modal.hide()
        })

    </script>
</div>


