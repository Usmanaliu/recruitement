<?= $this->extend('templates/base'); ?>

<?= $this->section('content'); ?>
<?php $error = session('error'); ?>
<div class="container py-5">
    <div class="screen-download d-flex justify-content-center">
        <div class="panel shadow-lg p-4 bg-white rounded" style="max-width: 500px; width: 100%;">
            <h3 class="text-center mb-4 text-primary">Search Application</h3>
            <div class="form-download">
                <form method="post" class="row g-3">
                    <div class="col-12">
                        <label for="searchCnic" class="form-label fw-bold">CNIC:</label>
                        <input type="text" class="form-control" name="cnic" id="searchCnic" placeholder="Enter your CNIC here" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-4">Search</button>
                    </div>
                    <?php if ($error): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            No Record Found
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <?php if ($application): ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Applicant Details</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td><strong>Application Number:</strong></td>
                                    <td><?= $application['application_id'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Applicant Name:</strong></td>
                                    <td><?= $application['cand_name_eng'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Father's Name:</strong></td>
                                    <td><?= $application['father_name_eng'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                        <a class="btn btn-success px-4" href="<?= site_url('dowloadApplication/' . $application['application_id']) ?>">Download Form</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
