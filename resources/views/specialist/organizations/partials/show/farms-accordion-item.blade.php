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
{{--                <div class="p-2 mb-2 bg-info bg-opacity-10">--}}
{{--                    @if($contact->name || $contact->surname || $contact->patronymic)--}}
{{--                        <h5 class="card-title"><span--}}
{{--                                class="card-subtitle text-muted">Имя: </span> {{$contact->name}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->job_title)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Должность: </span> {{$contact->job_title}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->email)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Email: </span> {{$contact->email}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->phone)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Основной: </span> {{$contact->phone}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->mobile)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Мобильный: </span> {{$contact->mobile}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}
{{--                    @if($contact->work_number)--}}
{{--                        <h5 class="card-title"><span class="card-subtitle text-muted">Рабочий: </span> {{$contact->work_number}}--}}
{{--                        </h5>--}}
{{--                    @endif--}}

{{--                    <a href="{{route('general.contacts.edit', ['contact' => $contact])}}">Изменить</a>--}}
{{--                    @include('general.contacts.partials.destroy-modal')--}}
{{--                </div>--}}
            @endforeach
            @include('specialist.organizations.partials.show.farm-create-offcanvas')
        </div>
    </div>
</div>
