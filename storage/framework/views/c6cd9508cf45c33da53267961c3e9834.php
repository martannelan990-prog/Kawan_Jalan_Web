<?php $__env->startSection('title','Beranda - Kawan Jalan'); ?>
<?php $__env->startSection('content'); ?>
<section class="screen">
<div class="content" style="padding-top:23px">
    <div class="row home-head">
        <img class="logo" src="<?php echo e(asset('assets/kawan/logo.png')); ?>" alt="Kawan Jalan">
        <a href="<?php echo e(route('search')); ?>" class="search-pill home-search-pill">⌕ <span>Cari tempat & aktivitas<br>yang ingin dilakukan</span></a>
        <a class="bell" href="<?php echo e(auth()->check()?route('notifications'):route('login')); ?>">🔔 <b style="color:#ff7b87"><?php echo e($notificationCount ?? 0); ?></b></a>
    </div>

    <div class="divider" style="margin-top:10px"></div>

    <h2 class="section-title">Destinasi Terlaris</h2>
    <div class="scroll-x">
        <?php $__empty_1 = true; $__currentLoopData = $popular->unique('city_id')->values(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php ($city = $d->city); ?>
            <a class="dest-card city-card" href="<?php echo e($city ? route('city.show',$city->slug) : '#'); ?>">
                <img class="photo city-photo" src="<?php echo e(asset($city?->image ?: 'assets/kawan/hero.png')); ?>" alt="<?php echo e($city?->name ?? 'Wisata'); ?>">
                <h3 class="serif"><?php echo e($city?->name ?? 'Wisata'); ?></h3>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="card muted small">Belum ada destinasi populer.</div>
        <?php endif; ?>
    </div>

    <div class="divider"></div>

    <h2 class="section-title">Tempat wisata yang tidak boleh dilewatkan</h2>
    <div class="scroll-x">
        <?php $__empty_1 = true; $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php ($destinationCount = (int) ($c->destinations_count ?? 0)); ?>
            <a class="dest-card city-card" href="<?php echo e(route('city.show',$c->slug)); ?>">
                <img class="photo city-photo" src="<?php echo e(asset($c->image ?: 'assets/kawan/hero.png')); ?>" alt="<?php echo e($c->name); ?>">
                <h3 class="serif"><?php echo e($c->name); ?></h3>
                <div class="tiny muted"><?php echo e($destinationCount > 0 ? $destinationCount . ' kegiatan' : 'Segera Hadir'); ?></div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="card muted small">Belum ada kota wisata.</div>
        <?php endif; ?>
    </div>

    <div class="divider"></div>

    <h2 class="section-title">Jadwal Wisata yang mungkin anda suka</h2>
    <div class="scroll-x">
        <?php $__empty_1 = true; $__currentLoopData = $recommended; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php ($city = $d->city); ?>
            <article class="dest-card big suggestion-card">
                <img class="photo suggestion-photo" src="<?php echo e(asset($d->image ?: ($city?->image ?: 'assets/kawan/hero.png'))); ?>" alt="<?php echo e($d->name); ?>">
                <div class="row" style="margin-top:6px">
                    <span class="tiny muted"><?php echo e($city?->name ?? '-'); ?></span>
                    <?php if(auth()->guard()->check()): ?>
                        <form method="POST" action="<?php echo e(route('favorite.toggle',$d)); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="btn outline sm icon-heart" type="submit">♡</button>
                        </form>
                    <?php endif; ?>
                </div>
                <h3 class="serif" style="font-size:15px;line-height:1.05"><?php echo e($d->name); ?></h3>
                <p class="tiny muted"><?php echo e(Str::limit($d->description,86)); ?></p>
                <a class="btn sm buy-btn" href="<?php echo e(auth()->check()?route('payment.create',$d):route('login')); ?>">Beli Tiket</a>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="card muted small">Belum ada rekomendasi wisata.</div>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SMS 4 PROJECT\HAMPIR BERESS\10 fINAL FIX\Kawan Jalan web\resources\views/home.blade.php ENDPATH**/ ?>