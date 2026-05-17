<?php $__env->startSection('title', 'Daftar - Kawan Jalan'); ?>

<?php $__env->startSection('content'); ?>
<section class="screen auth-screen register-screen">
    <div class="register-brand">
        <div class="brand-title">Get Started With<br>KAWAN JALAN</div>
    </div>

    <div class="content stack register-content">
        <a class="back" href="<?php echo e(route('login')); ?>">Kembali ke Masuk</a>

        <h1 class="serif center register-title">DAFTAR</h1>

        <form class="stack auth-form kj-validated-form" method="POST" action="<?php echo e(route('register.post')); ?>" novalidate>
            <?php echo csrf_field(); ?>

            <div class="field-wrap">
                <input class="input auth" name="name" placeholder="Nama Pengguna"
                       data-required="Nama lengkap wajib diisi gaboleh kosong."
                       value="<?php echo e(old('name')); ?>">
            </div>

            <div class="field-wrap">
                <input class="input auth" name="email" type="text" placeholder="Alamat Email"
                       data-required="Email wajib diisi gaboleh kosong."
                       data-email="Email wajib menggunakan tanda @."
                       value="<?php echo e(old('email')); ?>">
            </div>

            <div class="field-wrap">
                <input class="input auth" name="phone" type="text" inputmode="numeric" placeholder="Nomor Telepon 08xxxxxxxxxx"
                       data-required="Nomor telepon wajib diisi gaboleh kosong."
                       data-phone="Nomor telepon wajib diawali 08."
                       value="<?php echo e(old('phone')); ?>">
            </div>

            <div class="password-field field-wrap">
                <button type="button" class="password-toggle" data-password-toggle="#register-password">⌘ Tampilkan Password</button>
                <input id="register-password" class="input auth" name="password" type="password" placeholder="Password minimal 8 karakter"
                       data-required="Password wajib diisi gaboleh kosong."
                       data-password-min="Password wajib minimal 8 karakter angka atau huruf.">
            </div>

            <div class="password-field field-wrap">
                <button type="button" class="password-toggle" data-password-toggle="#register-password-confirmation">⌘ Tampilkan Password</button>
                <input id="register-password-confirmation" class="input auth" name="password_confirmation" type="password" placeholder="Ulangi Password"
                       data-required="Ulangi password wajib diisi gaboleh kosong."
                       data-match="#register-password"
                       data-match-message="Ulangi password harus sama dengan password.">
            </div>

            <label class="terms-row small field-wrap">
                <span>
                    Lanjutkan untuk masuk atau daftar dan setujui
                    <u>Syarat dan Ketentuan</u>. Baca juga <u>Kebijakan Privasi</u>.
                </span>
                <input type="checkbox"
                       data-required="Syarat dan ketentuan wajib disetujui.">
            </label>

            <button class="btn outline auth-submit register-submit">Daftar</button>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SMS 4 PROJECT\HAMPIR BERESS\10 fINAL FIX\Kawan Jalan web\resources\views/auth/register.blade.php ENDPATH**/ ?>