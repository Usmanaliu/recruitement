<?= $this->extend('templates/panel/base');?>

<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Create New Job Post</h3>
        </div>
        <div class="card-body">
            <?= form_open() ?>
            
            <!-- Success Message -->
            <?php if (session('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Error Messages -->
            <?php if (session('errors')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5>Please fix the following errors:</h5>
                    <ul>
                        <?php foreach (session('errors') as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Job Details Section -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="text-primary">Job Details</h4>
                    <hr>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Job Title <span class="text-danger">*</span></label>
                        <input type="text" name="job_title" class="form-control <?= isset(session('errors')['job_title']) ? 'is-invalid' : '' ?>" value="<?= old('job_title') ?>" required>
                        <?php if (isset(session('errors')['job_title'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.job_title') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Job Type <span class="text-danger">*</span></label>
                        <select name="job_type" class="form-control <?= isset(session('errors')['job_type']) ? 'is-invalid' : '' ?>" required>
                            <option value="">Select Type</option>
                            <option value="Executive" <?= old('job_type') == 'Executive' ? 'selected' : '' ?>>Executive</option>
                            <option value="Ministerial" <?= old('job_type') == 'Ministerial' ? 'selected' : '' ?>>Ministerial</option>
                            <option value="Minial" <?= old('job_type') == 'Minial' ? 'selected' : '' ?>>Minial</option>
                        </select>
                        <?php if (isset(session('errors')['job_type'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.job_type') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Job Scale <span class="text-danger">*</span></label>
                        <input type="text" name="job_scale" class="form-control <?= isset(session('errors')['job_scale']) ? 'is-invalid' : '' ?>" value="<?= old('job_scale') ?>" required>
                        <?php if (isset(session('errors')['job_scale'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.job_scale') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>District <span class="text-danger">*</span></label>
                        <input type="text" name="job_district" class="form-control <?= isset(session('errors')['job_district']) ? 'is-invalid' : '' ?>" value="<?= old('job_district') ?>" required>
                        <?php if (isset(session('errors')['job_district'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.job_district') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Requirements Summary <span class="text-danger">*</span></label>
                        <input type="text" name="requirements" class="form-control <?= isset(session('errors')['requirements']) ? 'is-invalid' : '' ?>" value="<?= old('requirements') ?>" required>
                        <?php if (isset(session('errors')['requirements'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.requirements') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Start Date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" class="form-control <?= isset(session('errors')['start_date']) ? 'is-invalid' : '' ?>" value="<?= old('start_date') ?>" required>
                        <?php if (isset(session('errors')['start_date'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.start_date') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Closing Date <span class="text-danger">*</span></label>
                        <input type="date" name="closing_date" class="form-control <?= isset(session('errors')['closing_date']) ? 'is-invalid' : '' ?>" value="<?= old('closing_date') ?>" required>
                        <?php if (isset(session('errors')['closing_date'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.closing_date') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Requirements Section -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="text-primary">Job Requirements</h4>
                    <hr>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Education Requirements</label>
                        <input type="text" name="education" class="form-control <?= isset(session('errors')['education']) ? 'is-invalid' : '' ?>" value="<?= old('education') ?>">
                        <?php if (isset(session('errors')['education'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.education') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Minimum Age</label>
                        <input type="number" name="age_min" class="form-control <?= isset(session('errors')['age_min']) ? 'is-invalid' : '' ?>" value="<?= old('age_min') ?>">
                        <?php if (isset(session('errors')['age_min'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.age_min') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Maximum Age</label>
                        <input type="number" name="age_max" class="form-control <?= isset(session('errors')['age_max']) ? 'is-invalid' : '' ?>" value="<?= old('age_max') ?>">
                        <?php if (isset(session('errors')['age_max'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.age_max') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Male Height Requirement</label>
                        <input type="text" name="height_male" class="form-control <?= isset(session('errors')['height_male']) ? 'is-invalid' : '' ?>" value="<?= old('height_male') ?>" placeholder="e.g., 5'8''">
                        <?php if (isset(session('errors')['height_male'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.height_male') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Female Height Requirement</label>
                        <input type="text" name="height_female" class="form-control <?= isset(session('errors')['height_female']) ? 'is-invalid' : '' ?>" value="<?= old('height_female') ?>" placeholder="e.g., 5'4''">
                        <?php if (isset(session('errors')['height_female'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.height_female') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Chest Measurement</label>
                        <input type="text" name="chest" class="form-control <?= isset(session('errors')['chest']) ? 'is-invalid' : '' ?>" value="<?= old('chest') ?>">
                        <?php if (isset(session('errors')['chest'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.chest') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Expanded Chest Measurement</label>
                        <input type="text" name="chest_expended" class="form-control <?= isset(session('errors')['chest_expended']) ? 'is-invalid' : '' ?>" value="<?= old('chest_expended') ?>">
                        <?php if (isset(session('errors')['chest_expended'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.chest_expended') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Male Running Requirement</label>
                        <input type="text" name="running_male" class="form-control <?= isset(session('errors')['running_male']) ? 'is-invalid' : '' ?>" value="<?= old('running_male') ?>">
                        <?php if (isset(session('errors')['running_male'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.running_male') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Female Running Requirement</label>
                        <input type="text" name="running_female" class="form-control <?= isset(session('errors')['running_female']) ? 'is-invalid' : '' ?>" value="<?= old('running_female') ?>">
                        <?php if (isset(session('errors')['running_female'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.running_female') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Male Running Duration</label>
                        <input type="text" name="running_duration_male" class="form-control <?= isset(session('errors')['running_duration_male']) ? 'is-invalid' : '' ?>" value="<?= old('running_duration_male') ?>" placeholder="e.g., 10 mins">
                        <?php if (isset(session('errors')['running_duration_male'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.running_duration_male') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Female Running Duration</label>
                        <input type="text" name="running_duration_female" class="form-control <?= isset(session('errors')['running_duration_female']) ? 'is-invalid' : '' ?>" value="<?= old('running_duration_female') ?>" placeholder="e.g., 8 mins">
                        <?php if (isset(session('errors')['running_duration_female'])) : ?>
                            <div class="invalid-feedback"><?= session('errors.running_duration_female') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">Create Job Post</button>
            </div>
            
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>