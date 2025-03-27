<?= $this->extend('templates/base'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4 text-primary">Login Panel</h2>

                    <!-- Flash Message for Wrong Credentials -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger text-center">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open(); ?>
                    <?= csrf_field(); ?>

                    <?php 
                    /** @var \CodeIgniter\Validation\Validation|null $validation */
                    $validation = session()->getFlashdata('validation'); 
                    ?>

                    <!-- CNIC -->
                    <div class="mb-3">
                        <label for="cnic" class="form-label">CNIC</label>
                        <input type="text" class="form-control <?= isset($validation) && $validation->hasError('cnic') ? 'is-invalid' : '' ?>" 
                               name="cnic" id="cnic" placeholder="Enter 13-digit CNIC" 
                               value="<?= old('cnic') ?>" required maxlength="13" pattern="\d{13}">
                        <div class="invalid-feedback">
                            <?= isset($validation) ? $validation->getError('cnic') : '' ?>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" 
                               name="email" id="email" value="<?= old('email') ?>" required>
                        <div class="invalid-feedback">
                            <?= isset($validation) ? $validation->getError('email') : '' ?>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>" 
                               name="password" id="password" required>
                        <div class="invalid-feedback">
                            <?= isset($validation) ? $validation->getError('password') : '' ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill">Login</button>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
