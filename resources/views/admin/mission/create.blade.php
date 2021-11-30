<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="index.html"><img
                        src="{{ asset('admin/assets/images/logo.svg') }}" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="index.html"><img
                        src="{{ asset('admin/assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item nav-category">
                    <span class="nav-link">Навигация</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="index.html">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Миссии</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img
                            src="{{ asset('admin/assets/images/logo-mini.svg') }}" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>

                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">admin@videoquest.local</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <h1>Создать миссию</h1>

                    <form action="{{ route('createMission') }}" method="POST" id="content-form">
                        @csrf

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
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/misc.js') }}"></script>
    <script src="{{ asset('admin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
</body>

</html>
