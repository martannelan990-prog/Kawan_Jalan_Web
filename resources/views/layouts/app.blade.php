<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kawan Jalan')</title>

    <script>
        (function () {
            var savedTheme = localStorage.getItem('kawan-theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    @if (file_exists(public_path('build/manifest.json')) || app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    @if (!file_exists(public_path('build/manifest.json')))
        <style>
            {!! file_exists(resource_path('css/app.css')) ? file_get_contents(resource_path('css/app.css')) : '' !!}
        </style>
    @endif

    @stack('styles')
</head>
<body>
    <div class="app-shell">
        @if(session('success'))
            <div class="alert toast-notify show">{{ session('success') }}</div>
        @endif

        @if(session('danger'))
            <div class="alert error toast-notify show">{{ session('danger') }}</div>
        @endif

        @auth
            @if(auth()->user()->status === 'banned')
                <div class="suspended-banner">Akun anda telah tersuspend, hubungi kontak kami kelompok6@gmail.com</div>
            @endif
        @endauth

        @if($errors->any())
            <div class="alert error toast-notify show">{{ $errors->first() }}</div>
        @endif

        @yield('content')
    </div>

    <script>
        (function () {
            var root = document.documentElement;

            function applyTheme(theme) {
                root.setAttribute('data-theme', theme);
                localStorage.setItem('kawan-theme', theme);

                document.querySelectorAll('[data-theme-option]').forEach(function (button) {
                    button.classList.toggle('active', button.dataset.themeOption === theme);
                });

                document.querySelectorAll('[data-theme-label]').forEach(function (label) {
                    label.textContent = theme === 'dark' ? 'Mode Gelap' : 'Mode Terang';
                });
            }

            applyTheme(localStorage.getItem('kawan-theme') || 'light');

            document.addEventListener('click', function (event) {
                var themeButton = event.target.closest('[data-theme-option]');
                if (themeButton) {
                    applyTheme(themeButton.dataset.themeOption);
                }

                var passwordButton = event.target.closest('[data-password-toggle]');
                if (passwordButton) {
                    var target = document.querySelector(passwordButton.dataset.passwordToggle);
                    if (target) {
                        var visible = target.type === 'text';
                        target.type = visible ? 'password' : 'text';
                        passwordButton.textContent = visible ? '⌘ Tampilkan Password' : '⌘ Sembunyikan Password';
                    }
                }

                var toggle = event.target.closest('[data-toggle]');
                if (toggle) {
                    toggle.classList.toggle('is-off');
                    toggle.classList.toggle('is-on');
                    var text = toggle.closest('.settings-line')?.querySelector('[data-toggle-label]');
                    if (text) text.textContent = toggle.classList.contains('is-off') ? 'Nonaktif' : 'Aktif';
                }
            });
        })();
    </script>

    <script>

(function () {
    function messageFor(input, type) {
        if (type === 'required') return input.dataset.required || 'Kolom ini wajib diisi gaboleh kosong.';
        if (type === 'email') return input.dataset.email || 'Email wajib menggunakan tanda @.';
        if (type === 'phone') return input.dataset.phone || 'Nomor telepon wajib diawali 08.';
        if (type === 'passwordDigits') return input.dataset.passwordDigits || 'Password wajib 8 digit angka.';
        if (type === 'passwordMin') return input.dataset.passwordMin || 'Password wajib minimal 8 karakter angka atau huruf.';
        if (type === 'match') return input.dataset.matchMessage || 'Ulangi password harus sama dengan password.';
        if (type === 'url') return input.dataset.url || 'Link wajib berupa URL yang valid.';
        return 'Data yang Anda masukkan belum sesuai.';
    }

    function clearError(input) {
        input.classList.remove('invalid');
        var wrap = input.closest('.field-wrap') || input.parentElement;
        if (!wrap) return;
        var old = wrap.querySelector('.field-error');
        if (old) old.remove();
    }

    function showError(input, message) {
        input.classList.add('invalid');
        var wrap = input.closest('.field-wrap') || input.parentElement;
        if (!wrap) return;
        var old = wrap.querySelector('.field-error');
        if (old) old.remove();
        var error = document.createElement('div');
        error.className = 'field-error';
        error.textContent = message;
        wrap.appendChild(error);
    }

    function showToast(message) {
        var old = document.querySelector('.toast-notify.dynamic');
        if (old) old.remove();
        var toast = document.createElement('div');
        toast.className = 'toast-notify dynamic';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(function () { toast.classList.add('show'); }, 20);
        setTimeout(function () {
            toast.classList.remove('show');
            setTimeout(function () { toast.remove(); }, 250);
        }, 3500);
    }

    function isEmpty(input) {
        if (input.type === 'checkbox') return !input.checked;
        return !String(input.value || '').trim();
    }

    document.addEventListener('input', function (event) {
        if (event.target.matches('[data-required], [data-email], [data-phone], [data-password-digits], [data-password-min], [data-match], [data-url], [data-url]')) {
            clearError(event.target);
        }
    });

    document.addEventListener('change', function (event) {
        if (event.target.matches('[data-required]')) clearError(event.target);
    });

    document.addEventListener('submit', function (event) {
        var form = event.target.closest('.kj-validated-form');
        if (!form) return;

        var firstInvalid = null;
        var firstMessage = '';

        form.querySelectorAll('[data-required], [data-email], [data-phone], [data-password-digits], [data-password-min], [data-match], [data-url], [data-url]').forEach(function (input) {
            clearError(input);
            var message = '';

            if (input.dataset.required && isEmpty(input)) {
                message = messageFor(input, 'required');
            } else if (input.dataset.email && input.value.trim() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim())) {
                message = messageFor(input, 'email');
            } else if (input.dataset.phone && input.value.trim() && !/^08[0-9]{8,13}$/.test(input.value.trim())) {
                message = messageFor(input, 'phone');
            } else if (input.dataset.url && input.value.trim()) {
                try { new URL(input.value.trim()); } catch (e) { message = messageFor(input, 'url'); }
            } else if (input.dataset.passwordDigits && input.value.trim() && !/^[0-9]{8}$/.test(input.value.trim())) {
                message = messageFor(input, 'passwordDigits');
            } else if (input.dataset.passwordMin && input.value.trim() && !/^[A-Za-z0-9]{8,}$/.test(input.value.trim())) {
                message = messageFor(input, 'passwordMin');
            } else if (input.dataset.match) {
                var target = form.querySelector(input.dataset.match);
                if (target && input.value !== target.value) {
                    message = messageFor(input, 'match');
                }
            }

            if (message) {
                showError(input, message);
                if (!firstInvalid) {
                    firstInvalid = input;
                    firstMessage = message;
                }
            }
        });

        if (firstInvalid) {
            event.preventDefault();
            showToast(firstMessage);
            firstInvalid.focus({ preventScroll: true });
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
})();

    </script>

    @stack('scripts')
</body>
</html>
