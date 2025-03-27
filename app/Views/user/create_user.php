<?= $this->extend('templates/panel/base'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <?php $msg = session('success');
    if ($msg): ?>

        <div class="alert alert-success">
            <?= $msg ?>
        </div>
    <?php endif; ?>
    <div class="form-container bg-white">
        <h2 class="form-title text-center">Add New User</h2>

        <?= form_open() ?>
        <?= csrf_field() ?>

        <!-- User Name -->
        <div class="row mb-3">
            <label for="user_name" class="col-sm-3 col-form-label">Full Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control <?= session('errors.user_name') ? 'is-invalid' : '' ?>"
                    name="user_name" id="user_name" value="<?= old('user_name') ?>" required>
                <div class="invalid-feedback">
                    <?= session('errors.user_name') ?>
                </div>
            </div>
        </div>

        <!-- CNIC -->
        <div class="row mb-3">
            <label for="cnic" class="col-sm-3 col-form-label">CNIC</label>
            <div class="col-sm-9">
                <input type="text" class="form-control <?= session('errors.cnic') ? 'is-invalid' : '' ?>"
                    name="cnic" id="cnic" placeholder="XXXXXXXXXXXXX" value="<?= old('cnic') ?>" required>
                <div class="invalid-feedback">
                    <?= session('errors.cnic') ?>
                </div>
            </div>
        </div>

        <!-- Email -->
        <div class="row mb-3">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                    name="email" id="email" value="<?= old('email') ?>" required>
                <div class="invalid-feedback">
                    <?= session('errors.email') ?>
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="row mb-3">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                    name="password" id="password" required>
                <div class="invalid-feedback">
                    <?= session('errors.password') ?>
                </div>
            </div>
        </div>

        <!-- Phone -->
        <div class="row mb-3">
            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-9">
                <input type="text" class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>"
                    name="phone" id="phone" value="<?= old('phone') ?>" required>
                <div class="invalid-feedback">
                    <?= session('errors.phone') ?>
                </div>
            </div>
        </div>

        <!-- Role -->
        <div class="row mb-3">
            <label for="role" class="col-sm-3 col-form-label">Role</label>
            <div class="col-sm-9">
                <select class="form-select <?= session('errors.role') ? 'is-invalid' : '' ?>"
                    name="role" id="role" required>
                    <option value="user" <?= old('role') == 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.role') ?>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="row mb-4">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select class="form-select <?= session('errors.status') ? 'is-invalid' : '' ?>"
                    name="status" id="status" required>
                    <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.status') ?>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg btn-ldr px-5">Add User</button>
        </div>

        <?= form_close() ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#cnic').inputmask('9999999999999'); // CNIC format with hyphens
    });
</script>

<?= $this->endSection() ?>