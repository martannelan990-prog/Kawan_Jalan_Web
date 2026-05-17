<?php $__env->startSection('title', 'Pengaturan'); ?>

<?php $__env->startSection('content'); ?>
<section class="screen settings-screen">
    <div class="topbar settings-topbar">
        <a class="back" href="<?php echo e(route('home')); ?>">Kembali</a>
        <h1 class="title">Pengaturan</h1>
        <img class="logo-sm page-logo" src="<?php echo e(asset('assets/kawan/logo.png')); ?>" alt="Kawan Jalan">
    </div>

    <div class="content stack settings-content">
        <div class="card settings-card stack">
            <h4>Profil</h4>
            <a class="settings-line" href="<?php echo e(route('profile')); ?>">
                <span class="settings-icon">♟</span>
                <span class="settings-copy">
                    <b>Profil</b>
                    <small class="muted">Informasi profil Anda</small>
                </span>
            </a>
        </div>

        <div class="card settings-card stack">
            <h4>Tampilan</h4>
            <div class="settings-line">
                <span class="settings-icon">☾</span>
                <span class="settings-copy">
                    <b>Tema</b>
                    <small class="muted" data-theme-label>Mode Terang</small>
                </span>
                <div class="theme-switch" aria-label="Pilih tema">
                    <button type="button" data-theme-option="light">Terang</button>
                    <button type="button" data-theme-option="dark">Gelap</button>
                </div>
            </div>
        </div>

        <div class="card settings-card stack">
            <h4>Notifikasi</h4>
            <div class="settings-line">
                <span class="settings-icon">♧</span>
                <span class="settings-copy">
                    <b>Push Notifikasi</b>
                    <small class="muted">Status: <span data-toggle-label>Aktif</span></small>
                </span>
                <button type="button" class="toggle is-on" data-toggle aria-label="Aktifkan atau matikan notifikasi">
                    <span></span>
                </button>
            </div>
        </div>

        <div class="card settings-card stack">
            <h4>Lainnya</h4>

            <a class="settings-line" href="<?php echo e(route('profile.password')); ?>">
                <span class="settings-icon">♡</span>
                <span class="settings-copy">
                    <b>Profil & Keamanan</b>
                    <small class="muted">Kelola data dan riwayat kunjungan</small>
                </span>
            </a>

            <a class="settings-line" href="<?php echo e(route('help', 'faq')); ?>">
                <span class="settings-icon">ⓘ</span>
                <span class="settings-copy">
                    <b>Bantuan & Dukungan</b>
                    <small class="muted">FAQ dan kontak</small>
                </span>
            </a>

            <?php if(auth()->check() && auth()->user()->isAdmin()): ?>
                <a class="btn role-admin admin-button" href="<?php echo e(route('admin.dashboard')); ?>">Panel Admin</a>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn red logout-btn">Keluar Akun</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginal91530f48093dbfe9d7d6cfefc4ce84c1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91530f48093dbfe9d7d6cfefc4ce84c1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bottom-nav','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('bottom-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91530f48093dbfe9d7d6cfefc4ce84c1)): ?>
<?php $attributes = $__attributesOriginal91530f48093dbfe9d7d6cfefc4ce84c1; ?>
<?php unset($__attributesOriginal91530f48093dbfe9d7d6cfefc4ce84c1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91530f48093dbfe9d7d6cfefc4ce84c1)): ?>
<?php $component = $__componentOriginal91530f48093dbfe9d7d6cfefc4ce84c1; ?>
<?php unset($__componentOriginal91530f48093dbfe9d7d6cfefc4ce84c1); ?>
<?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SMS 4 PROJECT\HAMPIR BERESS\10 fINAL FIX\Kawan Jalan web\resources\views/settings/index.blade.php ENDPATH**/ ?>