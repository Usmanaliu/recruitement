<!-- app/Views/education/add.php -->
<?= $this->extend('templates/base') ?> <!-- If you have a layout file -->



<?= $this->section('content') ?>
<div class="container">
    <?php 
        $errors = session('errors');
        if(isset($errors)){
        echo "<div class='alert text-danger'>";
        echo "<ul>";
        foreach($errors as $error){
            echo "<li>".$error."</li>";
        }
        echo "</ul>";
        echo "</div>";
    } ?>
    <h2 class="mt-4 mb-4 text-center">Add Education Details</h2>
    <!-- Add Education Form -->

    <?= form_open('educationFromentry', ['id' => 'education-form', 'onsubmit' => "document.getElementById('submit-btn').disabled=true;", 'method' => 'post']) ?>
    <?= csrf_field() ?>

    <input type="hidden" name="application_id" value="<?= $application_id ?>">

    <div class="row g-3">
        <!-- Education Level -->
        <div class="col-md-6">
            <label class="form-label">Education Level *</label>
            <select class="form-select <?= isset($errors['set_id']) ? 'is-invalid' : '' ?> " name="set_id" required>
                <option value="">Select Level</option>
                <?php foreach ([1 => 'Matric', 2 => 'Intermediate', 3 => 'Bachelor', 4 => 'Masters', 5 => 'PhD'] as $val => $label): ?>
                    <option value="<?= $val ?>" <?= old('set_id') == $val ? 'selected' : '' ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php if (isset($errors['set_id'])) : ?>
                <div class="invalid-feedback">
                    <?= $errors['set_id'] ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Institute Details -->
        <div class="col-md-6">
            <label class="form-label">Institute Name *</label>
            <input type="text" class="form-control <?= isset($errors['institue_name']) ? 'is-invalid' : '' ?> " name="institue_name"
                value="<?= old('institue_name') ?>" required>

            <?php if (isset($errors['institue_name'])) : ?>
                <div class="invalid-feedback">
                    <?= $errors['institue_name'] ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label">Degree Title *</label>
            <input type="text"
                name="degree_title"
                class="form-control <?= isset($errors['degree_title']) ? 'is-invalid' : '' ?>"
                value="<?= old('degree_title') ?>">

            <?php if (isset($errors['degree_title'])) : ?>
                <div class="invalid-feedback">
                    <?= $errors['degree_title'] ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label">Board/University *</label>
            <input type="text" class="form-control <?= isset($errors['board']) ? 'is-invalid' : '' ?>" name="board"
                value="<?= old('board') ?>" required>

            <?php if (isset($errors['board'])) : ?>
                <div class="invalid-feedback">
                    <?= $errors['board'] ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Marks and Date -->
        <div class="col-md-4">
            <label class="form-label">Obtained Marks *</label>
            <input type="number" step="any" class="form-control <?= isset($errors['obt_marks']) ? 'is-invalid' : '' ?>" name="obt_marks"
                id="obt_marks" value="<?= old('obt_marks') ?>" required>

            <?php if (isset($errors['obt_marks'])) : ?>
                <div class="invalid-feedback">
                    <?= $errors['obt_marks'] ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <label class="form-label">Total Marks *</label>
            <input type="number" step="any" class="form-control <?= isset($errors['full_marks']) ? 'is-invalid' : '' ?>" name="full_marks"
                id="full_marks" value="<?= old('full_marks') ?>" required>

            <?php if (isset($errors['full_marks'])) : ?>
                <div class="invalid-feedback">
                    <?= $errors['full_marks'] ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <label class="form-label">Percentage *</label>
            <input type="number" class="form-control <?= isset($errors['percentage']) ? 'is-invalid' : '' ?>" name="percentage"
                id="percentage" value="<?= old('percentage') ?>" readonly>

            <?php if (isset($errors['percentage'])) : ?>
                <div class="invalid-feedback">
                    <?= $errors['percentage'] ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label">Result Date *</label>
            <input type="date" class="form-control <?= isset($errors['result_date']) ? 'is-invalid' : '' ?>" name="result_date"
                value="<?= old('result_date') ?>" required>

            <?php if (isset($errors['result_date'])) : ?>
                <div class="invalid-feedback">
                    <?= $errors['result_date'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-4">
        <div class="ms-auto w-25">

            <a class="btn btn-outline-secondary me-5" href="<?= base_url('/application-page?application_id='.$application_id) ?>">Cancel</a>
            <button type="submit" class="btn btn-primary ms-auto" id="submit-btn">
                <i class="bi bi-plus-circle"></i> Add Education
            </button>
        </div>

    </div>
    <?= form_close() ?>

    <!-- Education Details -->
    <?php if ($educations): ?>
        <h2 class="mt-4 mb-4">Education Details</h2>

        <!-- Education Table -->
        <div class="mb-4">
            <table id="edu_tbl" class="table table-striped">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Degree</th>
                        <th>Degree_title</th>
                        <th>Institute</th>
                        <th>Marks</th>
                        <th>Percentage</th>
                        <th>Result Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sr = 1; ?>
                    <?php foreach ($educations as $edu): ?>
                        <tr>
                            <td><?= $sr ?></td>
                            <td><?= $edu['degree'] ?></td>
                            <td><?= $edu['degree_title'] ?></td>
                            <td><?= $edu['institue_name'] ?></td>
                            <td><?= $edu['obt_marks'] ?>/<?= $edu['full_marks'] ?></td>
                            <td><?= $edu['percentage'] ?>%</td>
                            <td><?= date('d M Y', strtotime($edu['result_date'])) ?></td>
                            <td><a href="<?= site_url('education/delete/' . $edu['edu_id']) . "/" . $application_id ?>" onclick="return confirm('Are you sure you want to delete this entry?');" class="btn btn-danger">Remove</a></td>
                        </tr>
                    <?php $sr = $sr + 1;
                    endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                
                     <a id="btn_next" onclick="disablebtn()" href="<?= base_url('/application-page?application_id='.$application_id) ?>" class="btn btn-primary">Next</a>   
                
            </div>
        </div>
    <?php endif; ?>
</div>


<script>
    // Calculate percentage automatically

    function calculatePercentage() {
        const obt = parseFloat(document.getElementById('obt_marks').value) || 0;
        const total = parseFloat(document.getElementById('full_marks').value) || 0;

        if (total > 0) {
            const percentage = ((obt / total) * 100).toFixed(2);
            document.getElementById('percentage').value = percentage;
        }
    }

    document.getElementById('full_marks').addEventListener('input', calculatePercentage);
    document.getElementById('obt_marks').addEventListener('input', calculatePercentage);

    // Form submission handling


    document.getElementById('education-form').addEventListener('submit', function(e) {
        const btn = this.querySelector('#submit-btn');
        const btnNext = document.getElementById('btn_next');
        btn.disabled = true;
        btnNext.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Adding...';
    });


    function disablebtn() {
    const btnSbmt = document.getElementById('submit-btn');
    const btnNext = document.getElementById('btn_next');

    if (btnSbmt) {
        btnSbmt.disabled = true;
        btnSbmt.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Processing...';
    }

    if (btnNext) {
        btnNext.disabled = true;
        btnNext.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Processing...';
    }
}

</script>
<?= $this->endSection() ?>