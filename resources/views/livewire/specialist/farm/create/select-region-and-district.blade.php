<div>
    <div class="mb-3">
        <label for="region" class="form-label fw-bolder">Субъект РФ</label>
        <input type="text" class="form-control" id="region"
               value="{{$this->regionSearch ?? old('region')}}"
               required
               wire:model.debounce.100ms="regionSearch"
        >
        <select class="form-select form-select-sm mb-3" aria-label=".form-select-lg example">
            @foreach($this->regions as $region)
            <option selected>{{$region->name}}</option>
            @endforeach
        </select>
        <input type="hidden" name="region_id" value={{$this->region->id}}>
        <div id="regions_list" style="z-index:10; position: absolute;)" class=" absolute z-10 w-full {{$this->regionVisibility ? '' : 'd-none'}}">
            <ul class="absolute z-10 w-full bg-opacity-50 rounded-t-none shadow-sm list-group">
                @foreach($this->regions as $region)
                    <button class="list-group-item list-group-item-action rounded-t-none" wire:click="selectRegion({{$region->id}})">{{$region->name}}</button>
                @endforeach
            </ul>
        </div>

        <div id="regionHelp"  class="form-text">{{$this->regionSearch}}</div>
    </div>

    <div class="mb-3">
        <label for="district" class="form-label fw-bolder">Район</label>
        <input type="text" class="form-control" id="district"
               value="{{$this->districtName ?? old('district')}}" required
               wire:model.debounce.100ms="districtSearch"
        >
        <input type="hidden" name="district_id" value={{$this->district->id}}>
        <div id="districts_list" style="z-index:10; position: absolute;)" class=" absolute z-10 w-full {{$this->districtVisibility ? '' : 'd-none'}}">
            <ul class="absolute z-10 w-full bg-opacity-50 rounded-t-none shadow-sm list-group">
                @foreach($this->districts as $district)
                    <button class="list-group-item list-group-item-action rounded-t-none" wire:click="selectDistrict({{$district->id}})">{{$district->name}}</button>
                @endforeach
            </ul>
        </div>

        <div id="districtHelp" class="form-text">{{$this->districtSearch}}</div>
    </div>

    <script>
        const region = document.querySelector('#region');
        const regionsList = document.querySelector('#regions_list');

        const district = document.querySelector('#district');
        const districtsList = document.querySelector('#districts_list');

        region.addEventListener('focus', function(e){
            regionsList.classList.remove("d-none");
            regionsList.classList.add("d-block");
        });

        district.addEventListener('focus', function(e){
            districtsList.classList.remove("d-none");
            districtsList.classList.add("d-block");
        });
    </script>

</div>
