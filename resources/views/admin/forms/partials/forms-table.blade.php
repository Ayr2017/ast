<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Создатель</th>
            <th>Категория</th>
            <th>Описание</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($forms as $form)
            <tr>
                <td>{{$form->id}}</td>
                <td>
                    <a href="{{route('admin.forms.show',['form' => $form->id])}}">
                        {{$form->name}}
                    </a>
                </td>
                <td>{{$form->creator?->name ?? '-'}}</td>
                <td>{{$form->category->name}}</td>
                <td>{{$form->description}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <div class="py-1">
                            <a href="{{route('admin.forms.edit',['form' => $form->id])}}"
                               class="btn btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="py-1">
                            <form action="{{route('admin.forms.destroy',['form' => $form->id])}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa {{$form->deleted_at ? 'fa-trash-restore    ' : 'fa-trash'}}"></i>
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
