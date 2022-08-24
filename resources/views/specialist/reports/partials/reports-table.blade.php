<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Форма</th>
            <th>Ферма</th>
            <th>Организация</th>
            <th>Податель</th>
            <th>Данные</th>
            <th>Дата</th>
            <th>Создано</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="{{route('specialist.forms.show',['form' => $report->form->id])}}">{{$report?->form?->name}}</a>
                </td>
                <td>
                    <a href="{{route('specialist.farms.show',['form' => $report->farm->id])}}">{{$report?->farm?->name}}</a>
                </td>
                <td>
                    <a href="{{route('specialist.organizations.show',['form' => $report->farm->organization->id])}}">{{$report?->farm?->organization?->name}}</a>
                </td>
                <td>{{$report?->creator->fullName}}</td>
                <td>{{$report?->data}}</td>
                <td>{{$report?->date}}</td>
                <td>{{$report?->created_at}}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <div class="py-1">
                            <a href="{{route('specialist.reports.edit',['report' => $report?->id])}}"
                               class="btn btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="py-1">
                            <form action="{{route('specialist.reports.destroy',['report' => $report?->id])}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="deleted_at"
                                       value="{{$report?->deleted_at ? 0 : 1}}">
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa {{$report?->deleted_at ? 'fa-trash-restore    ' : 'fa-trash'}}"></i>
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
