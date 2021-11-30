@extends('templates.main')

@section('content')

    <script>
        history.pushState("", document.title, window.location.pathname);
    </script>

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
                {{ $comments->count() }} комментариев
            </div>
            @if ($profile)

                <div class="card-body d-flex">
                    <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                        <img style="width: 100%; heigth: 100%; object-fit: cover" src="{{ $profile->avatar }}" alt="">
                    </div>
                    <form action="{{ route('createComment') }}" method="POST" style="flex: auto" id="comment-form">
                        @csrf
                        <input type="hidden" name="mission_id" value="{{ $mission_id }}">
                        <input type="hidden" name="profile_id" value="{{ $profile->id }}">
                        <div class="mb-3">
                            <label for="text" class="mb-2">
                                <b class="text-primary">{{ $profile->name }}</b>
                            </label>
                            <textarea rows="6" class="form-control" placeholder="Ваш комментарий" name="text"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary d-block ms-auto">Отправить</button>
                    </form>
                </div>

            @endif
        </div>

        <h2 class="h3">Комментарии:</h2>

        <div class="comments-list">

            @forelse ($comments as $comment)

                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                            <img style="width: 100%; heigth: 100%; object-fit: cover"
                                src="{{ $comment->profile->avatar }}" alt="">
                        </div>
                        <div>
                            <b class="text-primary">{{ $comment->profile->name }}
                                ({{ $comment->profile->soc_type }})</b>
                            <div style="white-space: pre-line">{{ $comment->text }}</div>
                        </div>
                    </div>
                </div>

            @empty

                <div>Комментариев пока нет. Будь первым!</div>

            @endforelse
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script>
        const __backendData =
            {!! json_encode([
    'mission_id' => $mission_id,
    'profile_id' => $profile !== null ? $profile->id : null,
    'profile_name' => $profile !== null ? $profile->name : null,
    'profile_avatar' => $profile !== null ? $profile->avatar : null,
    'profile_soc_type' => $profile !== null ? $profile->soc_type : null,
    'post_url' => route('apiCommentCreate'),
]) !!};
        const $submitButton = $('#comment-form button[type="submit"]');

        $('#comment-form').on('submit', function(e) {
            e.preventDefault();

            $submitButton.text('Отправка...');
            $submitButton.attr('disabled', true);

            const text = this.text.value;
            __backendData.text = text;

            $.ajax(__backendData.post_url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json'
                    },
                    data: {
                        text: text,
                        mission_id: __backendData.mission_id,
                        profile_id: __backendData.profile_id,
                    }
                })
                .done(function() {
                    $('.comments-list').prepend(`
                        <div class="card mb-3">
                            <div class="card-body d-flex">
                                <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                    <img style="width: 100%; heigth: 100%; object-fit: cover" src="${__backendData.profile_avatar}"
                                        alt="">
                                </div>
                                <div>
                                    <b class="text-primary">${__backendData.profile_name}
                                        (${__backendData.profile_soc_type})</b>
                                    <div style="white-space: pre-line">${__backendData.text}</div>
                                </div>
                            </div>
                        </div>
                    `);
                })
                .fail(function() {
                    alert("Ошибка сервера");
                })
                .always(function() {
                    $('#comment-form').closest('.card-body').remove();
                });

        });
    </script>

@endsection
