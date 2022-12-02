<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Форма</th>
            <th>Коллекция</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($field_templates as $fieldTemplate)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$fieldTemplate?->name}}
                </td>
                <td>
                        {{$fieldTemplate?->form->name}}
                </td>
                <td>{{$fieldTemplate?->fieldsCollection}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <div class="py-1">
                            <a href="{{route('specialist.field-templates.edit',['field_template' => $fieldTemplate?->id])}}"
                               class="btn btn-outline-info mx-1">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="py-1">
                            <form action="{{route('specialist.field-templates.destroy',['field_template' => $fieldTemplate?->id])}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="deleted_at"
                                       value="{{$fieldTemplate?->deleted_at ? 0 : 1}}">
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa {{$fieldTemplate?->deleted_at ? 'fa-trash-restore    ' : 'fa-trash'}}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
