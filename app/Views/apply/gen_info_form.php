<?= $this->extend('templates/base') ?>
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
                <input type="hidden" name="application_id" value="<?= $application['application_id'] ?? '' ?>">

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="district">District</label>
                        <select class="form-control" id="district" name="district" required>
                            <option value="">Select District</option>
                            <?php
                            $districts = ['Attock', 'Bahawalnagar', 'Bahawalpur', 'Bhakkar', 'Chakwal', 'Chiniot', 'Dera Ghazi Khan', 'Faisalabad', 'Gujranwala', 'Gujrat', 'Hafizabad', 'Jhang', 'Jhelum', 'Kasur', 'Khanewal', 'Khushab', 'Lahore', 'Layyah', 'Lodhran', 'Mandi Bahauddin', 'Mianwali', 'Multan', 'Muzaffargarh', 'Narowal', 'Nankana Sahib', 'Okara', 'Pakpattan', 'Rahim Yar Khan', 'Rajanpur', 'Rawalpindi', 'Sahiwal', 'Sargodha', 'Sheikhupura', 'Sialkot', 'Toba Tek Singh', 'Vehari'];
                            foreach ($districts as $district) : ?>
                                <option value="<?= $district ?>" <?= ($application['district_domicile'] ?? old('district')) == $district ? 'selected' : '' ?>>
                                    <?= $district ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="cand_name_eng">Candidate Name (English)</label>
                        <input type="text" class="form-control" id="cand_name_eng" name="cand_name_eng" value="<?= $application['cand_name_eng'] ?? old('cand_name_eng') ?>" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="cand_name_urdu">Candidate Name (Urdu)</label>
                        <input type="text" class="form-control rtl-direction" id="cand_name_urdu" name="cand_name_urdu" value="<?= $application['cand_name_urdu'] ?? old('cand_name_urdu') ?>" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="gender">Select Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <?php $genders = ['Male', 'Female', 'Other'];
                            foreach ($genders as $gender) : ?>
                                <option value="<?= $gender ?>" <?= ($application['gender'] ?? old('gender')) == $gender ? 'selected' : '' ?>>
                                    <?= $gender ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="father_name_eng">Father's Name (English)</label>
                        <input type="text" class="form-control" id="father_name_eng" name="father_name_eng" value="<?= $application['father_name_eng'] ?? old('father_name_eng') ?>" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="father_name_urdu">Father's Name (Urdu)</label>
                        <input type="text" class="form-control rtl-direction" id="father_name_urdu" name="father_name_urdu" value="<?= $application['father_name_urdu'] ?? old('father_name_urdu') ?>" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="father_occupation">Father's Occupation</label>
                        <input type="text" class="form-control" id="father_occupation" name="father_occupation" value="<?= $application['father_occupation'] ?? old('father_occupation') ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="religion">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="<?= $application['religion'] ?? old('religion') ?>" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="cast">Cast</label>
                        <input type="text" class="form-control" id="religion" name="cast" value="<?= $application['cast'] ?? old('cast') ?>" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= $application['dob'] ?? old('dob') ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $application['email'] ?? old('email') ?>" required>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?= $application['phone'] ?? old('phone') ?>" required>
                    </div>
                </div>

                <div class="form-group text-center">
                    <a class="btn btn-outline-secondary" href="<?= base_url('/application-page?application_id='.$application['application_id']) ?>">Cancel</a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span id="buttonText">Save</span>
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
        btn.disabled = true;
        spinner.classList.remove('d-none');
    }
</script>

<?= $this->endSection() ?>
