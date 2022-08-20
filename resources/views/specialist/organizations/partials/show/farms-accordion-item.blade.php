<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFarms" aria-expanded="true"
                aria-controls="collapseFarms">
            Фермы
        </button>
    </h2>
    <div id="collapseFarms" class="accordion-collapse collapse hide"
         aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            @foreach($organization->farms as $farm)
                <div class="p-2 mb-2 bg-info bg-opacity-10">
                    @if($farm->name)
                        <h5 class="card-title"><span
                                class="card-subtitle text-muted">Название: </span> {{$farm->name}}
                        </h5>
                    @endif
                    @if($farm->region)
                        <h5 class="card-title"><span class="card-subtitle text-muted">Регион: </span> {{$farm->region->name}}
                        </h5>
                    @endif
                    @if($farm->district)
                        <h5 class="card-title"><span class="card-subtitle text-muted">Район: </span> {{$farm->district->name}}
                        </h5>
                    @endif
                    @if($farm->address)
                        <h5 class="card-title"><span class="card-subtitle text-muted">Район: </span> {{$farm->address}}
                        </h5>
                    @endif

                    <a href="{{route('specialist.farms.edit', ['farm' => $farm])}}">Изменить</a>
                    @include('specialist.farms.partials.destroy-modal')
                </div>
            @endforeach
            @include('specialist.organizations.partials.show.farm-create-offcanvas')
        </div>
    </div>
</div>
