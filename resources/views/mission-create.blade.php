@extends('templates.main')

@section('content')

    <div class="container py-5" style="max-width: 650px;">
        <h1>Создать миссию</h1>

        <form action="{{ route('createMission') }}" id="content-form">
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
            data: {},
        })

        const contentForm = document.querySelector('#content-form');

        contentForm.onsubmit = function(e) {
            e.preventDefault();

            editor.save().then((outputData) => {
                contentForm.content.value = JSON.stringify(outputData);
                contentForm.submit();
            });
        }
    </script>
@endsection
