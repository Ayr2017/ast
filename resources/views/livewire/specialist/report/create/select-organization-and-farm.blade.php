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
        <input class="form-control" list="farms" id="farmsDataList"  name="farmsDataList" placeholder="Type to search..." wire:model="farmSearch">
        <datalist id="farms">
            @foreach($farms as $farm)
            <option value="{{$farm?->name}}">
            @endforeach
        </datalist>
        <input type="hidden" name="farm_id" value="{{$farmId}}">
    </div>

</div>
