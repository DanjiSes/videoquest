@extends('admin.templates.main')

@section('content')

    <a href="{{ route('createMissionForm') }}" class="btn btn-primary">Создать миссию</a>

    <div class="card mt-3">
        <div class="card-body">
            <h4 class="card-title">Все миссии</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> #id </th>
                            <th> Название </th>
                            <th> Кол-во комментариев </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($missions as $mission)

                            <tr>
                                <td style="width: 50px;"> {{ $mission->id }} </td>
                                <td>
                                    <a href="{{ route('viewMission', $mission->id) }}" target="_blank"
                                        rel="noopener noreferrer">
                                        {{ $mission->name }}
                                    </a>
                                </td>
                                <td style="width: 50px;"> {{ $mission->comments()->count() }} </td>
                                <td class="text-right">
                                    <div class="btn btn-sm btn-outline-danger">Удалить</div>
                                    <a class="btn btn-sm btn-outline-success"
                                        href="{{ route('editMissionForm', $mission->id) }}">Изменить</a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
