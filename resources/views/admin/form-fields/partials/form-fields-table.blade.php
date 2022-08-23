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
        @forelse($form_fields as $field)
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

                        <form action="{{route('admin.form-fields.destroy',['form_field' => $field->id])}}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger mx-1">
                                <i class="fa {{$field->deleted_at ? 'fa-trash-restore    ' : 'fa-trash'}}"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>