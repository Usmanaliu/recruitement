<!-- app/Views/candidate_form.php -->
<?= $this->extend('templates/base') ?> <!-- If you have a layout file -->
<?= $this->section('content') ?>

<div class="container mt-5">
<?php $errors = session('errors'); ?>
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session('success') ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">
            <?php foreach (session('errors') as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Candidate Registration Form</h3>
        </div>
        <div class="card-body">
            <form method="post" action="<?= site_url('candidate-genInfo-save') ?>" id="candidateForm" onsubmit="disableButton()">
                <?= csrf_field() ?>
                <input type="hidden" name="application_id" value="<?= $application_id ?>">
                <div class="row">
                    <!-- District -->
                    <div class="col-md-6 form-group">
                        <label for="district">District</label>
                        <select class="form-control" id="district" name="district" required>
                            <option value="">Select District</option>
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
                        <option value="<?= $district ?>" <?= old('district') == $district ? 'selected' : '' ?>>
                            <?= $district ?>
                        </option>
                    <?php endforeach; ?>
                </select><!-- Add district options here -->
                        </select>
                        <?php if(isset($errors['district'])): ?>
                            <div class="text-danger"><?= $errors['district'] ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Candidate Names -->
                    <div class="col-md-6 form-group">
                        <label for="cand_name_urdu">Candidate Name (Urdu)</label>
                        <input type="text" class="form-control rtl-direction" id="cand_name_urdu" name="cand_name_urdu" value="<?= old('cand_name_urdu') ?>" required>
                        <?php if(isset($errors['cand_name_urdu'])): ?>
                            <div class="text-danger"><?= $errors['cand_name_urdu'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="cand_name_eng">Candidate Name (English)</label>
                        <input type="text" class="form-control" id="cand_name_eng" name="cand_name_eng" value="<?= old('cand_name_eng') ?>" required>
                        <?php if(isset($errors['cand_name_eng'])): ?>
                            <div class="text-danger"><?= $errors['cand_name_eng'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Father's Information -->
                    <div class="col-md-6 form-group">
                        <label for="father_name_urdu">Father's Name (Urdu)</label>
                        <input type="text" class="form-control rtl-direction" id="father_name_urdu" name="father_name_urdu" value="<?= old('father_name_urdu') ?>" required>
                        <?php if(isset($errors['father_name_urdu'])): ?>
                            <div class="text-danger"><?= $errors['father_name_urdu'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="father_name_eng">Father's Name (English)</label>
                        <input type="text" class="form-control" id="father_name_eng" name="father_name_eng" value="<?= old('father_name_eng') ?>" required>
                        <?php if(isset($errors['father_name_eng'])): ?>
                            <div class="text-danger"><?= $errors['father_name_eng'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="father_occupation">Father's Occupation</label>
                        <input type="text" class="form-control" id="father_occupation" name="father_occupation" value="<?= old('father_occupation') ?>" required>
                        <?php if(isset($errors['father_occupation'])): ?>
                            <div class="text-danger"><?= $errors['father_occupation'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Personal Details -->
                    <div class="col-md-4 form-group">
                        <label for="religion">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="<?= old('religion') ?>" required>
                        <?php if(isset($errors['religion'])): ?>
                            <div class="text-danger"><?= $errors['religion'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="cast">Cast</label>
                        <input type="text" class="form-control" id="cast" name="cast" value="<?= old('cast') ?>" required>
                        <?php if(isset($errors['cast'])): ?>
                            <div class="text-danger"><?= $errors['cast'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= old('dob') ?>" required>
                        <?php if(isset($errors['dob'])): ?>
                            <div class="text-danger"><?= $errors['dob'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Contact Information -->
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="abc@xyz.com" required>
                        <?php if(isset($errors['email'])): ?>
                            <div class="text-danger"><?= $errors['email'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?= old('phone') ?>" placeholder="03xxxxxxxxx" required>
                        <?php if(isset($errors['phone'])): ?>
                            <div class="text-danger"><?= $errors['phone'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required><?= old('address') ?></textarea>
                    <?php if(isset($errors['address'])): ?>
                        <div class="text-danger"><?= $errors['address'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                        <span id="buttonText">Submit</span>
                        <span id="buttonSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function disableButton() {
        const btn = document.getElementById('submitBtn');
        const spinner = document.getElementById('buttonSpinner');
        const btnText = document.getElementById('buttonText');

        btn.disabled = true;
        btnText.textContent = 'Processing...';
        spinner.classList.remove('d-none');
    }
</script>

<?= $this->endSection() ?>