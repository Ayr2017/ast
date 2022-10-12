<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
            Поля формы
        </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
         data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Название</th>
                    <th>Е.и.</th>
                    <th>Тип</th>
                    <th>Категория</th>
                    <th></th>
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
                        <td>
                            <div class="d-flex">
                                <div>
                                    <a href="{{route('admin.form-fields.edit',['form_field' => $field])}}"
                                       class="btn btn-outline-primary">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </div>

                                <form action="{{route('admin.form-fields.destroy',['form_field' => $field])}}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div>
                                        <button type="submit" class="btn btn-outline-danger mx-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p>Поля отсутствуют</p>

                        @endforelse
                </tbody>
            </table>
            </div>
            <div>

                @include('admin.forms.partials.show.form-fields-create-offcanvas')
            </div>
        </div>
    </div>
</div>
