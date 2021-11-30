@extends('admin.templates.main')

@section('content')

    <h1>Создать миссию</h1>

    <form action="{{ route('createMission') }}" method="POST" id="content-form">
        @csrf

        <div class="mb-3">
            <label>Название:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Контент:</label>
            <div class="form-control" style="height: auto !important;">
                <div id="editorjs"></div>
            </div>
            <input type="text" name="content" value="" hidden>
        </div>

        <hr>

        <label class="form-label">Отправлять запрос при добавлении коммента:</label>

        <div class="mb-3 input-group">
            <select name="report_method" class="form-control" style="max-width: 100px">
                <option value="POST">POST</option>
                <option value="GET">GET</option>
            </select>
            <input type="url" name="report_url" class="form-control" placeholder="Введите URL адрес">
        </div>

        <div class="mb-3">
            <label class="form-label">Тело запроса (JSON)</label>
            <p><small class="text-muted">%uid% - идентификатор пользователя</small></p>
            <p><small class="text-muted">%soc% - идентификатор соц сети (vk, inst)</small></p>
            <p><small class="text-muted">%name% - имя пользователя</small></p>
            <textarea name="report_body" rows="10" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Заголовки (JSON)</label>
            <textarea name="report_headers" rows="10" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary d-block ml-auto">Добавить</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@canburaks/text-align-editorjs@latest"></script>

    <script>
        const editor = new EditorJS({
            holder: 'editorjs',
            tools: {
                header: Header,
                list: List,
                textAlign: TextAlign,
                class: Embed,
            },
            data: {},
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
