<!-- filepath: /c:/Users/dmonitring/Desktop/codeigniter4/recruitement/app/Views/apply/vacancies.php -->
<?= $this->extend('templates/base'); ?>

<?= $this->section('content'); ?>
<div class="container">

<?php
$errors = session('error');
?>
<ul>
    
    <li><?= $errors ?></li>
</ul>


    <form method="post"  ?>
        <!-- Permanent Address Section -->
       
       <input type="hidden" name="application_id" value="<?= $application_id ?>">
       <div class="row">
        <div class="col text-center">
            <h1>Enter Your Adress</h1>
        </div>
       </div>
        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <label>Permanent District</label>
                    <select name="permanent_district" class="form-control district-select" data-target="#permanent_ps">
                        <option value="">Select District</option>
                        <?php foreach ($districts as $district): ?>

                            <option value="<?= $district['district_id'] ?>"><?= $district['district_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Permanent Police Station</label>
                    <select name="permanent_add_ps" id="permanent_ps" class="form-control ps-select">
                        <option value="">Select Police Station</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Permanent Address</label>
                    <input type="text" name="permanent_address" id="permanent_address" class="form-control">
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
                            <option value="<?= $district['district_id'] ?>"><?= $district['district_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Current Police Station</label>
                    <select name="current_add_ps" id="current_ps" class="form-control ps-select">
                        <option value="">Select Police Station</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="current_address" id="current_address" class="form-control">
                </div>
            </div>
        </div>

        <div class="btn-sub mt-1 text center">

            <button type="submit" class="btn btn-primary">Update Information</button>
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