<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($units as $unit)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                        {{$unit->name}}
                    <a href="{{route('admin.units.show',['unit' => $unit->id])}}">
                    </a>
                </td>
                <td>
                        {{$unit->description}}
                </td>
                <td>
                    <div class="d-flex justify-content-start">
{{--                        <div class="py-1">--}}
{{--                            <a href="{{route('admin.units.edit',['unit' => $unit->id])}}"--}}
{{--                               class="btn btn-outline-info">--}}
{{--                                <i class="fa fa-pen"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <div class="p-1">
                            <form action="{{route('admin.units.destroy',['unit' => $unit->id])}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Удалить
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