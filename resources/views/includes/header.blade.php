<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <div class="navbar-header navbar-brand"><span style="cursor: pointer;"
                                                      onclick="window.location = '/'">Искры костра</span>
        </div>
        @if (is_null($user = \Illuminate\Support\Facades\Auth::user()))
            <div class="nav"></div>
            <div class="form-inline" id="signin_form">
                <input type="text" class="form-control uninvalid" placeholder="Маг. имя" required name="nickname">
                <input type="password" class="form-control uninvalid" placeholder="Пароль" required name="password">
                <input type="button" value="Войти" class="btn btn-dark btn-submit">
            </div>
            <script type="text/javascript">
                $('#signin_form .btn-submit').on('click', function () {
                    if ($('#signin_form :invalid').length == 0) {
                        let data = new FormData();
                        data.append('name', $('#signin_form input[name=nickname]').val().trim());
                        data.append('password', sha256($('#signin_form input[name=password]').val().trim()));
                        data.append('remember_me', '1');
                        ajax({
                            url: '/api/login',
                            method: 'post',
                            data: data,
                            success: function (data) {
                                if (data.status == 'success') {
                                    localStorage.setItem('jacesites.request_unseen_events', 'true');
                                    window.location.reload();
                                } else if (data.message != null) {
                                    show_message('Ошибка', data.message);
                                } else {
                                    show_message('Ошибка', 'Неизвестная ошибка');
                                }
                            },
                            error: function () {
                                show_message('Ошибка', 'Неизвестная ошибка');
                            }
                        });
                    }
                });
            </script>
        @else
            <div class="nav">
                <div style="color: #007bff; font-weight: 700; border-radius: 1.5em; background-color: white;"><a
                        href="/dream/new/" class="nav-item nav-link">Новый сон</a></div>
                <div style="color: #007bff; font-weight: 700; border-radius: 1.5em; background-color: white; margin-left: 1em;">
                    <a href="/dreammap/{{ $user->name }}" class="nav-item nav-link">Моя карта</a></div>
            </div>
            <div class="nav-item">
                Здравствуйте,
                <a href="{{ route('profile') }}" style="color: rgba(255, 255, 255, 0.9)">
                    {{ $user->name }}&nbsp;
                    <img src="{{ $user->getAvatarUrl() }}" style="max-height: 2rem; max-width: 2rem;">
                </a>!
                <button class="btn btn-secondary" onclick="window.location.href = '{{ route('logout') }}'">Выйти
                </button>
            </div>
        @endif
    </div>
</nav>

@if(!isset($withoutQuotes))
    <div class="nav bg-white quote">
        <div><p>“</p>
            <p>{{ \App\Models\Quotes::getNext() }}</p>
            <p>„</p></div>
    </div>
@endif
