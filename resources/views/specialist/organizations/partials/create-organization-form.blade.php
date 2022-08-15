    <div class="mb-3">
        <label for="name" class="form-label fw-bolder">Название</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$organization?->name ?? old('name')}}" required>
        <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <livewire:specialist.organizations.create.select-region-and-district />

{{--    <div class="mb-3">--}}
{{--        <label for="region" class="form-label fw-bolder">Субъект РФ</label>--}}
{{--        <input type="text" class="form-control" id="regionInput" name="region" value="{{$organization?->region ?? old('region')}}" required>--}}
{{--        <input type="hidden" name="region_id">--}}
{{--        <div id="regions_list" style="z-index:10; position: absolute;)" class=" absolute z-10 w-full ">--}}
{{--            <ul class="absolute z-10 w-full bg-opacity-50 rounded-t-none shadow-sm list-group">--}}
{{--               <button class="list-group-item list-group-item-action rounded-t-none" style="min-width: 300px;" >asdasd</button>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div id="regionHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
{{--    </div>--}}

{{--    <div class="mb-3">--}}
{{--        <label for="district" class="form-label fw-bolder">Район</label>--}}
{{--        <input type="text" class="form-control" id="districtInput" name="district" value="{{$organization?->district ?? old('district')}}" required>--}}
{{--        <div id="districtHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
{{--    </div>--}}

    <div class="mb-3">
        <label for="inn" class="form-label fw-bolder">ИНН</label>
        <input type="text" class="form-control" id="inn" name="inn" value="{{$organization?->inn ?? old('inn')}}" required>
        <div id="innHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label fw-bolder">Адрес</label>
        <input type="text" class="form-control" id="address" name="address" value="{{$organization?->address ?? old('address')}}" required>
        <div id="addressHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bolder">Активен</label>
        <div class="form-check">
            <input type='hidden' value='1' name='deleted_at'>
            <input type="checkbox" class="form-check-input" id="deleted_at" name="deleted_at" value="0" {{$organization?->deleted_at ? '' : 'checked'}}>
            <label class="form-check-label" for="deleted_at">{{$organization?->deleted_at ? 'Не активен' : 'Активен'}}</label>
        </div>
    </div>

{{--    <script>--}}
{{--        const regionInput = document.querySelector('#regionInput');--}}
{{--        const districtInput = document.querySelector('#districtInput');--}}

{{--        regionInput.addEventListener('input', getRegions);--}}

{{--        function getRegions(e)--}}
{{--        {--}}
{{--            axios.get(`/api/v1/regions?search=${e.target.value}`)--}}
{{--                .then(function (response) {--}}
{{--                    console.log(response);--}}
{{--                })--}}
{{--                .catch(function (error) {--}}
{{--                    console.log(error);--}}
{{--                });--}}
{{--        }--}}


{{--    </script>--}}
