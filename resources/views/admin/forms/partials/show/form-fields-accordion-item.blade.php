<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Поля формы
        </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Название</th>
                    <th>Е.и.</th>
                    <th>Тип</th>
                    <th>Категория</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($form->fields as $field)
                    <tr class="">
                        <td>{{$field->id}}</td>
                        <td>{{$field->name}}</td>
                        <td>{{$field->unit}}</td>
                        <td>{{$field->type}}</td>
                        <td>{{$field->category->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>

            @include('admin.forms.partials.show.form-fields-create-offcanvas')
            </div>
        </div>
    </div>
</div>
