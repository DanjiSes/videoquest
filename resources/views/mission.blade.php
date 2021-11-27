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
                        <p>{!! $b->data->text !!}</p>
                    @break
                    @case('list')
                        @if ($b->data->style === 'ordered')
                            <ol>
                                @foreach ($b->data->items as $li)
                                    <li>{!! $li !!}</li>
                                @endforeach
                            </ol>
                        @elseif ($b->data->style === 'unordered')
                            <ul>
                                @foreach ($b->data->items as $li)
                                    <li>{!! $li !!}</li>
                                @endforeach
                            </ul>
                        @endif
                    @break
                    @case('embed')
                        <div class="ratio ratio-16x9 mb-3">
                            <iframe src="{{ $b->data->embed }}" allowfullscreen></iframe>
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
                <form action="{{ route('createComment') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="soc_type" value="{{ $soc_type }}">
                        <input type="hidden" name="soc_uid" value="{{ $soc_uid }}">
                        <input type="hidden" name="mission_id" value="{{ $mission_id }}">
                        <textarea rows="6" class="form-control" placeholder="Ваш комментарий" name="text"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary d-block ms-auto">Отправить</button>
                </form>
            </div>
        </div>

        <h2 class="h3">Комментарии:</h2>

        @forelse ($comments as $comment)

            <div class="card mb-3">
                <div class="card-body d-flex">
                    <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                        <img style="width: 100%; heigth: 100%; object-fit: cover" src="{{ $comment->profile->avatar }}"
                            alt="">
                    </div>
                    <div>
                        <b class="text-primary">{{ $comment->profile->name }} ({{ $comment->profile->soc_type }})</b>
                        <div style="white-space: pre-line">{{ $comment->text }}</div>
                    </div>
                </div>
            </div>

        @empty

            <div>Комментариев пока нет. Будь первым!</div>

        @endforelse

    </div>

@endsection
