<?= $this->extend('templates/base'); ?>

<?= $this->section('content'); ?>
<div class="container">

<?php
$errors = session('error');
?>
<ul>
    <?php if ($errors): ?>
        <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

    <form method="post">
        <!-- Permanent Address Section -->
       
       <input type="hidden" name="application_id" value="<?= $application['application_id'] ?? old('application_id') ?>">
       <div class="row">
        <div class="col text-center">
            <h1>Enter Your Address</h1>
        </div>
       </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Permanent District</label>
                    <select name="permanent_district" class="form-control district-select" data-target="#permanent_ps">
                        <option value="">Select District</option>
                        <?php foreach ($districts as $district): ?>
                            <option value="<?= $district['district_id'] ?>" <?= isset($application['permanent_district']) && $application['permanent_district'] == $district['district_id'] ? 'selected' : (old('permanent_district') == $district['district_id'] ? 'selected' : '') ?>><?= $district['district_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-danger"> <?= session('errors.permanent_district') ?> </small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Permanent Police Station</label>
                    <select name="permanent_add_ps" id="permanent_ps" class="form-control ps-select">
                        <option value="">Select Police Station</option>
                    </select>
                    <small class="text-danger"> <?= session('errors.permanent_add_ps') ?> </small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Permanent Address</label>
                    <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="<?= $application['permanent_address'] ?? old('permanent_address') ?>">
                    <small class="text-danger"> <?= session('errors.permanent_address') ?> </small>
                </div>
            </div>
        </div>
        <!-- Current Address Section -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Current District</label>
                    <select name="current_district" class="form-control district-select" data-target="#current_ps">
                        <option value="">Select District</option>
                        <?php foreach ($districts as $district): ?>
                            <option value="<?= $district['district_id'] ?>" <?= isset($application['current_district']) && $application['current_district'] == $district['district_id'] ? 'selected' : (old('current_district') == $district['district_id'] ? 'selected' : '') ?>><?= $district['district_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-danger"> <?= session('errors.current_district') ?> </small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Current Police Station</label>
                    <select name="current_add_ps" id="current_ps" class="form-control ps-select">
                        <option value="">Select Police Station</option>
                    </select>
                    <small class="text-danger"> <?= session('errors.current_add_ps') ?> </small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="current_address" id="current_address" class="form-control" value="<?= $application['current_address'] ?? old('current_address') ?>">
                    <small class="text-danger"> <?= session('errors.current_address') ?> </small>
                </div>
            </div>
        </div>
        <div class="btn-sub mt-1">
            <div class="ms-auto w-25">
                <a class="btn btn-outline-secondary me-5" href="<?= base_url('/application-page?application_id='.$application['application_id']) ?>">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.ps-select').select2();
    
    // District change handler
    $('.district-select').on('change', function() {
        const target = $(this).data('target');
        const districtId = $(this).val();
        
        if(districtId) {
            $.get("<?= site_url('candidates/getPoliceStations') ?>", {
                district_id: districtId
            }, function(data) {
                $(target).html('<option value="">Select Police Station</option>');
                $.each(data, function(key, value) {
                    $(target).append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
                $(target).select2();
            });
        }
    });
});
</script>
<?= $this->endSection() ?>
