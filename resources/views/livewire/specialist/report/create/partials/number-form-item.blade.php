<div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{$formField->name}}</label>
        <input type="number" class="form-control" id="field_{{$formField->name}}" name="data[field_{{$formField->id}}]" {{$formField->required ? 'required' : ''}}>
    </div>
</div>
