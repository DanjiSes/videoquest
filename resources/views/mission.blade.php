@extends('templates.main')

@section('content')

    <div class="container py-5">
        <div class="mb-4">
            <div class="ratio ratio-16x9 mb-3">
                <iframe src="https://www.youtube.com/embed/oBudL05xvQU" title="YouTube video" allowfullscreen></iframe>
            </div>
            <h4>Если ты согласен с идей в видео - значит мы на одной волне!</h4>
            <p>Выполни задание и получи 200 или 500 популярности!</p>
            <p>
                <u>Текстовая методичка урока:</u> <a href="https://vk.com/@broparty_m-lesson-1" target="_blank"> По ссылке
                </a>
            </p>
            <p><b>Задание:</b></p>
            <p>Определи свою отправную точку в путешествии с БроТусовкой. А уже через несколько месяцев ты оценишь результат
                работы над собой. Важно максимально конкретно ответить на 5 вопросов: </p>
            <ol>
                <li>
                    Чем ты сейчас занимаешься? Что именно продаешь?
                </li>
                <li>
                    Как давно занимаешься этой деятельностью?
                </li>
                <li>
                    Кому продаешь? (Кто твоя целевая аудитория)
                </li>
                <li>
                    Какой средний чек?
                </li>
                <li>
                    Насколько из 10 доволен своим заработком? 10 - max, 1 - min, 0 - дохода пока нет
                </li>
            </ol>
            <hr>
            <p><i>Если у тебя есть вопрос или нужна помощь - я всегда на связи в чате БроТусовки</i></p>
            <hr>
            <p>
                <b>Свой ответ на задание пиши в комментарии ниже:</b><br>
                <small><i>P.S. Не забывай про время на выполнение задания</i></small>
            </p>
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
