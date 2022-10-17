<div>
    <form action="{{route('specialist.reports.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="organizationsDataList" class="form-label">Организация</label>
                <input class="form-control" list="organizations" id="organizationsDataList"
                       placeholder="Type to search..." wire:model="organizationSearch">
                <datalist id="organizations">
                    @foreach($organizations as $organization)
                        <option value="{{$organization?->name}}" wire:key="{{$organization->id}}" id="{{$organization->id}}">
                    @endforeach
                </datalist>
                <input type="hidden" name="organization_id" value="{{$organizationId}}">
            </div>

            <div class="mb-3">
                <label for="farmsDataList" class="form-label">Ферма</label>
                <input class="form-control" {{($organizationId && !$noFarms) ? '' : 'disabled'}} list="farms"
                       id="farmsDataList" name="farmsDataList" placeholder="Type to search..." wire:model="farmSearch">
                <datalist id="farms">
                    @foreach($farms as $farm)
                        <option value="{{$farm?->name}}" wire:key="{{$farm->id}}">
                    @endforeach
                </datalist>
                <input type="hidden" name="farm_id" value="{{$farmId}}">
            </div>

            <div class="mb-3">
                <label for="date" class="form-label fw-bolder">Дата</label>
                <input type="date" class="form-control" name="date" id="date" value="{{date("Y-m-d")}}">
                <div id="dateHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="form_id" class="form-label fw-bolder">Форма</label>
                <select class="form-select" id="form_id" name="form_id" wire:model="formId">
                    @foreach($forms as $form)
                        <option
                            value="{{$form->id}}" {{old('form_id') == $form->id ? 'selected' : ''}}>{{$form->name}}</option>
                    @endforeach
                </select>
                <div id="innHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            @foreach($formFieldsGroupedByCategory as $key =>$formFieldsCategory)
                @if($formFieldsCategory->fields->count())
                <h6 class="h6 fw-bold bg-secondary bg-opacity-10 p-2">{{$formFieldsCategory->name}}</h6>
                <div class="alert" style="background-color: {{$colors[$loop->iteration]}}">
                    @foreach($formFieldsCategory->fields as $formField)
                        @switch($formField->type)
                            @case('number')
                                @include('livewire.specialist.report.create.partials.number-form-item')
                                @break
                            @case('text')
                                @include('livewire.specialist.report.create.partials.text-form-item')
                                @break
                            @case('checkbox')
                                @include('livewire.specialist.report.create.partials.checkbox-form-item')
                                @break
                            @case('select')
                                @include('livewire.specialist.report.create.partials.select-form-item')
                                @break
                            @case('radio')
                                @include('livewire.specialist.report.create.partials.radio-form-item')
                                @break
                        @endswitch
                    @endforeach
                </div>
                @endif
            @endforeach

            <div class="mb-3">
                <label for="formFile" class="form-label">Файлы</label>
                <input class="form-control" type="file" id="formFiles" name="files[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>

</div>
