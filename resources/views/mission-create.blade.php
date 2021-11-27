@extends('templates.main')

@section('content')

    <div class="container py-5" style="max-width: 650px;">
        <h1>Создать миссию</h1>

        <form action="{{ route('createMission') }}" method="POST" id="content-form">
            @csrf

            <div class="mb-3">
                <label>Контент:</label>
                <div class="form-control">
                    <div id="editorjs"></div>
                </div>
                <input type="text" name="content" value="" hidden>
            </div>

            <button type="submit" class="btn btn-primary d-block ms-auto">Добавить</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>

    <script>
        const editor = new EditorJS({
            holder: 'editorjs',
            tools: {
                header: Header,
                list: List,
                embed: {
                    class: Embed,
                    config: {
                        services: {
                            youtube: true,
                        }
                    }
                },
            },
            data: {
                "time": 1638015521538,
                "blocks": [{
                    "id": "9tA-t2sUnZ",
                    "type": "header",
                    "data": {
                        "text": "Hallo world!",
                        "level": 1
                    }
                }, {
                    "id": "0tGWJ8Q1Xv",
                    "type": "header",
                    "data": {
                        "text": "Sub",
                        "level": 2
                    }
                }, {
                    "id": "BPcSDd64qO",
                    "type": "paragraph",
                    "data": {
                        "text": "alskfjalskfjajfljlf;alsfd"
                    }
                }, {
                    "id": "wuTxh7SOTF",
                    "type": "list",
                    "data": {
                        "style": "ordered",
                        "items": ["aljlaskfa", "afas", "df", "af", "asf"]
                    }
                }, {
                    "id": "ZXC41cPC1z",
                    "type": "embed",
                    "data": {
                        "service": "youtube",
                        "source": "https://www.youtube.com/watch?v=n9Y2Eb4BaSg",
                        "embed": "https://www.youtube.com/embed/n9Y2Eb4BaSg",
                        "width": 580,
                        "height": 320,
                        "caption": ""
                    }
                }],
                "version": "2.22.2"
            },
        })

        const contentForm = document.querySelector('#content-form');
        const submitButton = document.querySelector('#content-form button[type="submit"]');

        contentForm.onsubmit = function(e) {
            e.preventDefault();

            submitButton.disabled = true;
            submitButton.textContent = 'Загрузка...'

            editor.save().then((outputData) => {
                contentForm.content.value = JSON.stringify(outputData);
                contentForm.submit();
            });
        }
    </script>
@endsection
