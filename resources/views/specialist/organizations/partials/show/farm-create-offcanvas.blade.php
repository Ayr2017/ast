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
{{--            @include('user.contacts.partials.create-contact-form')--}}
        </div>
    </div>
</div>
