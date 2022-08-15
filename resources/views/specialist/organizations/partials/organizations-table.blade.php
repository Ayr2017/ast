<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Должность</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($organisations as $organisation)
            <tr>
                <td>{{$organisation?->id}}</td>
                <td>{{$organisation?->name}}</td>
                <td>{{$organisation?->surname}}</td>
                <td>{{$organisation?->phone}}</td>
                <td>{{$organisation?->email}}</td>
                <td>{{$organisation?->job_title}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <div class="py-1">
                            <a href="{{route('admin.users.edit',['user' => $organisation?->id])}}"
                               class="btn btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="py-1">
                            <form action="{{route('admin.users.update',['user' => $organisation?->id])}}"
                                  method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="deleted_at"
                                       value="{{$organisation?->deleted_at ? 0 : 1}}">
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa {{$organisation?->deleted_at ? 'fa-trash-restore    ' : 'fa-trash'}}"></i>
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
