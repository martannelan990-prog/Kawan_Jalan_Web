<?php $__env->startSection('title', 'Masuk - Kawan Jalan'); ?>

<?php $__env->startSection('content'); ?>
<section class="screen auth-screen login-screen">
    <div class="auth-hero">
        <img class="logo auth-logo" src="<?php echo e(asset('assets/kawan/logo.png')); ?>" alt="Kawan Jalan">
    </div>

    <div class="auth-panel stack">
        <a class="btn outline social" href="#">
            <span class="social-google">G</span>
            Lanjutkan dengan Google
        </a>

        <a class="btn outline social" href="#">
            <span class="social-facebook">f</span>
            Lanjutkan dengan Facebook
        </a>

        <div class="or">atau</div>

        <form method="POST" action="<?php echo e(route('login.post')); ?>" class="stack auth-form kj-validated-form" novalidate>
            <?php echo csrf_field(); ?>

            <div class="field-wrap">
                <input class="input auth" type="text" name="email" placeholder="Nama Pengguna / Email"
                       data-required="Email wajib diisi gaboleh kosong."
                       data-email="Email wajib menggunakan tanda @."
                       value="<?php echo e(old('email')); ?>">
            </div>

            <div class="password-field field-wrap">
                <button type="button" class="password-toggle" data-password-toggle="#login-password">⌘ Tampilkan Password</button>
                <input id="login-password" class="input auth" type="password" name="password" placeholder="Password"
                       data-required="Password wajib diisi gaboleh kosong.">
            </div>

            <div class="row small auth-links">
                <a href="<?php echo e(route('register')); ?>">Buat akun baru</a>
                <a href="<?php echo e(route('password.request')); ?>">Lupa Password?</a>
            </div>

            <button class="btn outline auth-submit">Masuk</button>
        </form>

        <p class="auth-note">
            Dengan membuat akun, Anda menyetujui <u>Syarat dan Ketentuan</u> serta memahami <u>Kebijakan Privasi</u>.
        </p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SMS 4 PROJECT\HAMPIR BERESS\10 fINAL FIX\Kawan Jalan web\resources\views/auth/login.blade.php ENDPATH**/ ?>