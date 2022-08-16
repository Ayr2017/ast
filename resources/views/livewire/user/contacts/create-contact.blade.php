<div>
    <form>
        <div class="col-lg-6 col-sm-12">
            <input type="hidden" name="model_type" value="{{$contact->model_type}}" wire:model="contact.model_type">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                           value="Игорь Гантелькин" wire:model="contact.name">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Должность</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="job_title" name="job_title"
                           value="Директор" wire:model="contact.job_title">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label">Тип</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" id="type" name="type" wire:model="contact.type">
                        <option value="mobile" selected>Мобильный</option>
                        <option value="phone">Рабочий</option>
                        <option value="email">Email</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="value" class="col-sm-2 col-form-label">Значение</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="value"  name="value" placeholder="+79047160000" wire:model="contact.value">
                </div>
            </div>
            <button class="btn btn-outline-primary" wire:click="save">Сохранить</button>
        </div>

    </form>
</div>
