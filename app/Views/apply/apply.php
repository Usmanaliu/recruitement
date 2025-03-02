<?= $this->extend('templates/base'); ?>


<?= $this->section('content'); ?>
<div class="container">
<div class="heading text-center">
    <h1>Apply for <?= $job['job_title'] ?>  BS- <?= $job['job_scale'] ?></h1>
        <?= $cnic ?>
</div>

</div>


<?= $this->endSection(); ?>