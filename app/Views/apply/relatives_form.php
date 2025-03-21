<?= $this->extend('templates/base') ?>

<?= $this->section('content') ?>
<div class="container">
    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php foreach (session('errors') as $error) : ?>
                <?= $error ?>
                
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php $errors = session('errors'); ?>
    <h2 class="mt-4 mb-4 text-center">Police Relative Information</h2>

    <?= form_open('relative_save', ['id' => 'relative-form', 'onsubmit' => "document.getElementById('submit-btn').disabled=true;", 'method' => 'post']) ?>
    <?= csrf_field() ?>

    <!-- Relative in Police Field -->
     <input type="hidden" name="application_id" value="<?= $application_id ?>">
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Do you have any relative in Police? *</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="relative_Police"
                    id="relativeYes" value="1" <?= old('relative_Police') == 1 ? 'checked' : '' ?> required>
                <label class="form-check-label" for="relativeYes">Yes</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="relative_Police"
                    id="relativeNo" value="0" <?= old('relative_Police') == 0 ? 'checked' : '' ?>>
                <label class="form-check-label" for="relativeNo">No</label>
            </div>
            <?php if (isset($errors['relative_Police'])) : ?>
                <div class="text-danger"><?= $errors['relative_Police'] ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Conditional Fields (Initially Hidden) -->
    <div id="relativeDetails" style="display: <?= old('relative_Police') == 1 ? 'block' : 'none' ?>;">
        <div class="row g-3">
        <!-- Relative Name -->
        <div class="col-md-6">
                <label class="form-label"> Relative Name *</label>
                <input type="text" class="form-control <?= isset($errors['relative_name']) ? 'is-invalid' : '' ?>"
                    name="relative_name" value="<?= old('relative_name') ?>">
                <?php if (isset($errors['relative_name'])) : ?>
                    <div class="invalid-feedback"><?= $errors['relative_name'] ?></div>
                <?php endif; ?>
            </div>    
        <!-- Relationship -->
            <div class="col-md-6">
                <label class="form-label">Relationship *</label>
                <select class="form-select <?= isset($errors['relation_relative']) ? 'is-invalid' : '' ?>"
                    name="relation_relative">
                    <option value="">Select Relationship</option>
                    <option value="Father" <?= old('relation_relative') == 'Father' ? 'selected' : '' ?>>Father</option>
                    <option value="Grand Father" <?= old('relation_relative') == 'Grand Father' ? 'selected' : '' ?>>Grand Father</option>
                </select>
                <?php if (isset($errors['relation_relative'])) : ?>
                    <div class="invalid-feedback"><?= $errors['relation_relative'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Rank -->
            <div class="col-md-6">
                <label class="form-label">Rank *</label>
                <input type="text" class="form-control <?= isset($errors['relative_rank']) ? 'is-invalid' : '' ?>"
                    name="relative_rank" value="<?= old('relative_rank') ?>">
                <?php if (isset($errors['relative_rank'])) : ?>
                    <div class="invalid-feedback"><?= $errors['relative_rank'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Belt Number -->
            <div class="col-md-6">
                <label class="form-label">Belt Number *</label>
                <input type="text" class="form-control <?= isset($errors['relative_belt_number']) ? 'is-invalid' : '' ?>"
                    name="relative_belt_number" value="<?= old('relative_belt_number') ?>">
                <?php if (isset($errors['relative_belt_number'])) : ?>
                    <div class="invalid-feedback"><?= $errors['relative_belt_number'] ?></div>
                <?php endif; ?>
            </div>
            
        <!-- job Status -->
        <div class="col-md-6">
                <label class="form-label">Job Status *</label>
                <select class="form-select <?= isset($errors['relative_job_status']) ? 'is-invalid' : '' ?>"
                    name="relative_job_status">
                    <option value="">Select Relationship</option>
                    <option value="Serving" <?= old('relative_job_status') == 'Seriving' ? 'selected' : '' ?>>Serving</option>
                    <option value="Retired" <?= old('relative_job_status') == 'Retired' ? 'selected' : '' ?>>Retired</option>
                </select>
                <?php if (isset($errors['relative_job_status'])) : ?>
                    <div class="invalid-feedback"><?= $errors['relative_job_status'] ?></div>
                <?php endif; ?>
            </div>

            <!-- District -->
            <div class="col-md-6">
                <label class="form-label">District *</label>
                <select class="form-select select2 <?= isset($errors['relative_district']) ? 'is-invalid' : '' ?>"
                    name="relative_district" id="districtSelect">
                    <option value="">Search or select district</option>
                    <?php
                    // List of Punjab districts
                    $districts = [
                        'Attock',
                        'Bahawalnagar',
                        'Bahawalpur',
                        'Bhakkar',
                        'Chakwal',
                        'Chiniot',
                        'Dera Ghazi Khan',
                        'Faisalabad',
                        'Gujranwala',
                        'Gujrat',
                        'Hafizabad',
                        'Jhang',
                        'Jhelum',
                        'Kasur',
                        'Khanewal',
                        'Khushab',
                        'Lahore',
                        'Layyah',
                        'Lodhran',
                        'Mandi Bahauddin',
                        'Mianwali',
                        'Multan',
                        'Muzaffargarh',
                        'Narowal',
                        'Nankana Sahib',
                        'Okara',
                        'Pakpattan',
                        'Rahim Yar Khan',
                        'Rajanpur',
                        'Rawalpindi',
                        'Sahiwal',
                        'Sargodha',
                        'Sheikhupura',
                        'Sialkot',
                        'Toba Tek Singh',
                        'Vehari'
                    ];

                    foreach ($districts as $district) : ?>
                        <option value="<?= $district ?>" <?= old('relative_district') == $district ? 'selected' : '' ?>>
                            <?= $district ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['relative_district'])) : ?>
                    <div class="invalid-feedback"><?= $errors['relative_district'] ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" id="submit-btn" class="btn btn-primary d-block mx-auto">Submit</button>
    </div>
    <?= form_close() ?>
</div>

<script>
    // Show/hide conditional fields based on radio selection
    const relativeYes = document.getElementById('relativeYes');
    const relativeNo = document.getElementById('relativeNo');
    const detailsSection = document.getElementById('relativeDetails');

    function toggleDetails() {
        detailsSection.style.display = relativeYes.checked ? 'block' : 'none';
        // Toggle required attributes
        const requiredFields = detailsSection.querySelectorAll('input, select');
        requiredFields.forEach(field => {
            field.required = relativeYes.checked;
        });
    }

    relativeYes.addEventListener('change', toggleDetails);
    relativeNo.addEventListener('change', toggleDetails);

    // Initial check when page loads
    toggleDetails();

    document.getElementById('relative-form').addEventListener('submit', function(e) {
        const btn = this.querySelector('#submit-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Adding...';
    });
</script>

<?= $this->endSection() ?>