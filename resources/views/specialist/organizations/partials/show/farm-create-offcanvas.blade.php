<button class="btn btn-outline-primary" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
    <i class="fa-solid fa-file-signature"></i>
    Добавить ферму
</button>

<div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" id="offcanvasBottom"
     aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Добавить новую ферму к {{$organization->name}}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="container">
        <div class="offcanvas-body small">
            <form action="{{route('specialist.farms.store')}}" method="POST">
                @csrf
                <input type="hidden" name="organization_id" value="{{$organization->id}}">
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ферма 2">
                </div>
                <livewire:specialist.farm.create.select-region-and-district/>
                <div class="mb-3">
                    <label for="address" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Казань, Фермское шоссе, д4">
                </div>
                <button type="submit" class="btn btn-outline-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>
