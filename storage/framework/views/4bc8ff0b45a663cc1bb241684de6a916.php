<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="bodyload" style="margin-top:80px;display:none">
  <div class="rotatingDiv"></div>
</div>

<main>

<!-- ✅ Bootstrap 5 + Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* 🌍 General */
body {
  background: #f8f9fa;
  font-family: "Inter", sans-serif;
}

/* ✈️ Flight Card */
.flight-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  padding: 25px;
  margin-bottom: 20px;
  transition: 0.3s;
}
.flight-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}

/* 🧭 Flight Info */
.flight-info {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
}

.flight-point {
  text-align: center;
}
.flight-point h6 {
  font-weight: 600;
  font-size: 16px;
  margin-bottom: 2px;
}
.flight-point span {
  font-size: 13px;
  color: #6c757d;
}

/* ✈️ Middle Direction */
.flight-direction {
  position: relative;
  text-align: center;
  flex: 1;
  min-width: 100px;
}
.flight-direction::before {
  content: '';
  display: block;
  height: 2px;
  background: #dee2e6;
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  z-index: 1;
}
.flight-direction i {
  position: relative;
  background: #fff;
  color: #0d6efd;
  padding: 0 8px;
  font-size: 18px;
  z-index: 2;
}

/* 💰 Button Section */
.flight-right {
  text-align: end;
}
.select-btn {
  background: #0352d1;
  color: #fff!important;
  border: 0;
  padding: 8px 18px;
  border-radius: 6px;
  font-size: 14px;
  text-decoration: none;
}
.select-btn:hover {
  background: #0b5ed7;
}

/* 📱 Responsive */
@media (max-width: 768px) {
  .flight-info {
    flex-direction: column;
    gap: 12px;
    text-align: center;
  }
  .flight-direction::before {
    width: 60px;
    margin: 0 auto;
  }
  .flight-right {
    text-align: center;
  }
  .select-btn {
    max-width: 100%;
padding: 10px;
  }
}
</style>


  <?php use Illuminate\Support\Facades\DB; ?>

  <?php if(empty($Routes) || count($Routes) === 0): ?>
    <div class="alert alert-light text-center shadow-sm border rounded py-4">
      <i class="fa-solid fa-circle-exclamation text-muted me-2"></i> 
      No flights found for your search.
    </div>
  <?php else: ?>
    <?php $__currentLoopData = $Routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $origin = DB::table('flights_airports')->where('code', is_array($f) ? $f['origin'] : $f->origin)->first();
        $arrival = DB::table('flights_airports')->where('code', is_array($f) ? $f['destination'] : $f->destination)->first();
      ?>

      <div class="flight-card">
        <div class="row align-items-center gy-3">
          <!-- 🛫 Departure -->
          <div class="col-12 col-md-3 text-center text-md-start">
            <div class="flight-point">
              <h6><i class="fa-solid fa-plane-departure text-primary me-1"></i><?php echo e($origin->city ?? ''); ?></h6>
              <span>(<?php echo e(is_array($f) ? $f['origin'] : $f->origin); ?>)</span>
            </div>
          </div>

          <!-- ✈️ Direction -->
          <div class="col-12 col-md-3">
            <div class="flight-direction">
              <i class="fa-solid fa-plane"></i>
            </div>
          </div>

          <!-- 🛬 Arrival -->
          <div class="col-12 col-md-3 text-center text-md-end">
            <div class="flight-point">
              <h6><i class="fa-solid fa-plane-arrival text-success me-1"></i><?php echo e($arrival->city ?? ''); ?></h6>
              <span>(<?php echo e(is_array($f) ? $f['destination'] : $f->destination); ?>)</span>
            </div>
          </div>

          <!-- 🎟️ Button -->
          <div class="col-12 col-md-3 mt-3 text-center">
            <a href="<?php echo e(route('routes.view', is_array($f) ? $f['id'] : $f->id)); ?>" class="select-btn">
              SELECT FLIGHT
            </a>
          </div>
        </div>
      </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>



</main>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\agentbestex\resources\views/welcome.blade.php ENDPATH**/ ?>