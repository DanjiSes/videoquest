@extends('templates.main')

@section('content')

    <script>
        history.pushState("", document.title, window.location.pathname);
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container py-5">
        <h1>{{ $mission->name }}</h1>

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
            <div class="card-header" id="comments-count">
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

                @switch($comment->profile->soc_type)
                    @case('vk')
                        <div class="card mb-3">
                            <div class="card-body d-flex">
                                <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                    <img style="width: 100%; heigth: 100%; object-fit: cover"
                                        src="{{ $comment->profile->avatar }}" alt="">
                                </div>
                                <div>
                                    <a href="https://vk.com/{{ $comment->profile->soc_uid }}" target="_blank"
                                        style="text-decoration: none">
                                        <b class="text-primary">
                                            <span class="me-2">{{ $comment->profile->name }}</span>
                                            <i class="fa-brands fa-vk"></i>
                                        </b>
                                    </a>
                                    <div style="white-space: pre-line">{{ $comment->text }}</div>
                                </div>
                            </div>
                        </div>
                    @break
                    @case('inst')
                        <div class="card mb-3">
                            <div class="card-body d-flex">
                                <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                    <img style="width: 100%; heigth: 100%; object-fit: cover"
                                        src="{{ $comment->profile->avatar }}" alt="">
                                </div>
                                <div>
                                    <a href="https://instagram.com/{{ $comment->profile->soc_uid }}" target="_blank"
                                        style="text-decoration: none">
                                        <b class="text-primary">
                                            <span class="me-2">{{ $comment->profile->name }}</span>
                                            <i class="fa-brands fa-instagram"></i>
                                        </b>
                                    </a>
                                    <div style="white-space: pre-line">{{ $comment->text }}</div>
                                </div>
                            </div>
                        </div>
                    @break
                @endswitch

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
                        @if ($profile)
                            @switch($profile->soc_type)
                                @case('vk')
                                    <div class="card mb-3">
                                        <div class="card-body d-flex">
                                            <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                                <img style="width: 100%; heigth: 100%; object-fit: cover" src="{{ $profile->avatar }}" alt="">
                                            </div>
                                            <div>
                                                <a href="https://vk.com/{{ $profile->soc_uid }}" target="_blank" style="text-decoration: none">
                                                    <b class="text-primary">
                                                        <span class="me-2">{{ $profile->name }}</span>
                                                        <i class="fa-brands fa-vk"></i>
                                                    </b>
                                                </a>
                                                <div style="white-space: pre-line">${__backendData.text}</div>
                                            </div>
                                        </div>
                                    </div>
                                @break
                                @case('inst')
                                    <div class="card mb-3">
                                        <div class="card-body d-flex">
                                            <div class="rounded-circle overflow-hidden me-3" style="width: 50px; height: 50px;">
                                                <img style="width: 100%; heigth: 100%; object-fit: cover" src="{{ $profile->avatar }}" alt="">
                                            </div>
                                            <div>
                                                <a href="https://instagram.com/{{ $profile->soc_uid }}" target="_blank"
                                                    style="text-decoration: none">
                                                    <b class="text-primary">
                                                        <span class="me-2">{{ $profile->name }}</span>
                                                        <i class="fa-brands fa-instagram"></i>
                                                    </b>
                                                </a>
                                                <div style="white-space: pre-line">${__backendData.text}</div>
                                            </div>
                                        </div>
                                    </div>
                                @break
                            @endswitch
                        @endif
                    `);

                    const commentsPrevCount = Number.parseInt($('#comments-count').text());
                    $('#comments-count').text(`${commentsPrevCount + 1} комментариев`);
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
