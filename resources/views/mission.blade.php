@extends('templates.main')

@section('content')

    <div class="container py-5">
        <div class="mb-4">
            @foreach ($content->blocks as $b)
                @switch($b->type)
                    @case('header')
                        <h{{ $b->data->level }}>{{ $b->data->text }}</h{{ $b->data->level }}>
                    @break
                    @case('paragraph')
                        <p>{{ $b->data->text }}</p>
                    @break
                    @case('list')
                        @if ($b->data->style === 'ordered')
                            <ol>
                                @foreach ($b->data->items as $li)
                                    <li>{{ $li }}</li>
                                @endforeach
                            </ol>
                        @elseif ($b->data->style === 'unordered')
                            <ul>
                                @foreach ($b->data->items as $li)
                                    <li>{{ $li }}</li>
                                @endforeach
                            </ul>
                        @endif
                    @break
                    @case('embed')
                        <div class="ratio ratio-16x9 mb-3">
                            <iframe src="{{ $b->data->embed }}"></iframe>
                        </div>
                    @break
                @endswitch
            @endforeach
        </div>

        <div class="card mb-4">
            <div class="card-header">
                314 комментариев
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="mb-3">
                        <textarea rows="6" class="form-control" placeholder="Ваш комментарий"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary d-block ms-auto">Отправить</button>
                </form>
            </div>
        </div>

        <h2 class="h3">Комментарии:</h2>

        <div class="card mb-3">
            <div class="card-body d-flex">
                <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                    <img style="width: 100%; heigth: 100%; object-fit: cover"
                        src="https://sun1-90.userapi.com/impf/c852032/v852032793/1be6/fb0O6fM_VPE.jpg?size=50x0&quality=96&crop=51,180,721,721&sign=08b35ba572173dd4bef466f2e23d236b&c_uniq_tag=vnUYVRGtRO6xglxApMTs9Sv3bP3dsBFmAAuIuesw7JU&ava=1"
                        alt="">
                </div>
                <div>
                    <b class="text-primary">Семен Захратенко</b>
                    <div style="white-space: pre-line">1. Маркетолог
                        2. 10 лет
                        3. Малый бизнес
                        4. 1000 000
                        5. 10</div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body d-flex">
                <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                    <img style="width: 100%; heigth: 100%; object-fit: cover"
                        src="https://sun1-90.userapi.com/impf/c852032/v852032793/1be6/fb0O6fM_VPE.jpg?size=50x0&quality=96&crop=51,180,721,721&sign=08b35ba572173dd4bef466f2e23d236b&c_uniq_tag=vnUYVRGtRO6xglxApMTs9Sv3bP3dsBFmAAuIuesw7JU&ava=1"
                        alt="">
                </div>
                <div>
                    <b class="text-primary">Семен Захратенко</b>
                    <div style="white-space: pre-line">1. Маркетолог
                        2. 10 лет
                        3. Малый бизнес
                        4. 1000 000
                        5. 10</div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body d-flex">
                <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                    <img style="width: 100%; heigth: 100%; object-fit: cover"
                        src="https://sun1-90.userapi.com/impf/c852032/v852032793/1be6/fb0O6fM_VPE.jpg?size=50x0&quality=96&crop=51,180,721,721&sign=08b35ba572173dd4bef466f2e23d236b&c_uniq_tag=vnUYVRGtRO6xglxApMTs9Sv3bP3dsBFmAAuIuesw7JU&ava=1"
                        alt="">
                </div>
                <div>
                    <b class="text-primary">Семен Захратенко</b>
                    <div style="white-space: pre-line">1. Маркетолог
                        2. 10 лет
                        3. Малый бизнес
                        4. 1000 000
                        5. 10</div>
                </div>
            </div>
        </div>
    </div>

@endsection
