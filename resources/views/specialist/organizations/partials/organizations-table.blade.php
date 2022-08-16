<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>ИНН</th>
            <th>Регион</th>
            <th>Район</th>
            <th>Адрес</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($organizations as $organization)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="{{route('specialist.organizations.show',['organization' => $organization->id])}}">{{$organization?->name}}</a>
                </td>
                <td>{{$organization?->inn}}</td>
                <td>{{$organization?->region?->name}}</td>
                <td>{{$organization?->district->name}}</td>
                <td>{{$organization?->address}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <div class="py-1">
                            <a href="{{route('specialist.organizations.edit',['organization' => $organization?->id])}}"
                               class="btn btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="py-1">
                            <form action="{{route('specialist.organizations.update',['organization' => $organization?->id])}}"
                                  method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="deleted_at"
                                       value="{{$organization?->deleted_at ? 0 : 1}}">
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa {{$organization?->deleted_at ? 'fa-trash-restore    ' : 'fa-trash'}}"></i>
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
