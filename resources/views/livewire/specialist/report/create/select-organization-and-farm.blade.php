<div>
    <div class="mb-3">
        <label for="organizationsDataList" class="form-label">Организация</label>
        <input class="form-control" list="organizations" id="organizationsDataList" placeholder="Type to search..." wire:model="organizationSearch">
        <datalist id="organizations">
            @foreach($organizations as $organization)
            <option value="{{$organization?->name}}">
            @endforeach
        </datalist>
        <input type="hidden" name="organization_id" value="{{$organizationId}}">
    </div>

    <div class="mb-3">
        <label for="farmsDataList" class="form-label">Ферма</label>
        <input class="form-control" {{($organizationId && !$noFarms) ? '' : 'disabled'}} list="farms" id="farmsDataList"  name="farmsDataList" placeholder="Type to search..." wire:model="farmSearch">
        <datalist id="farms">
            @foreach($farms as $farm)
            <option value="{{$farm?->name}}">
            @endforeach
        </datalist>
        <input type="hidden" name="farm_id" value="{{$farmId}}">
    </div>

    <div class="mb-3">
        <label for="inn" class="form-label fw-bolder">Форма</label>
        <select class="form-select" id="form_id" name="form_id" wire:model="formId">
            @foreach($forms as $form)
                <option
                    value="{{$form->id}}" {{old('form_id') == $form->id ? 'selected' : ''}}>{{$form->name}}</option>
            @endforeach
                <option
                    value="2" >test</option>
        </select>
        <div id="innHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <button type="submit" class="btn btn-primary {{($farmId) ? '' :'disabled' }}" >Далее</button>

</div>
