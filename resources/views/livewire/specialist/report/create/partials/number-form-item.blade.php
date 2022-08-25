<div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{$formField->name}} ({{$formField->unit}})</label>
        <input type="number"
               class="form-control" id="field_{{$formField->id}}"
               name="data[field_{{$formField->id}}]"
               {{$formField->required ? 'required' : ''}}
               min="{{$formField->min}}"
               max="{{$formField->max}}"
               step="{{$formField->step}}"
               placeholder="{{$formField->placeholder}}">
    </div>
    @if($formField->hint)
        <div id="field_{{$formField->id}}Help" class="form-text">{{$formField->hint}}</div>
    @endif
</div>
