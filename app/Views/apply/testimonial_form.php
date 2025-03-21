<?= $this->extend('templates/base') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="mb-4">Testimonials Information</h2>
    
    <?= form_open() ?>
    <?= csrf_field() ?>
    
    <!-- Testimonial 1 Section -->
    <div class="card mb-4">
    <?php 
    $erros = session('errors');
    ?>
        <input type="hidden" name="application_id" value="<?= $application_id ?>">
        <div class="card-header bg-primary text-white">
            Testimonial 1 Details
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="testimonial1_name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= isset($erros['testimonial1_name']) ? 'is-invalid' : '' ?>" 
                        name="testimonial1_name" id="testimonial1_name" 
                        value="<?= old('testimonial1_name') ?>">
                    <?php if(isset($errors['testimonial1_name'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['testimonial1_name'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-6">
                    <label for="testimonial1_father" class="form-label">Father's Name</label>
                    <input type="text" class="form-control <?= isset($erros['testimonial1_father']) ? 'is-invalid' : '' ?>" 
                        name="testimonial1_father" id="testimonial1_father" 
                        value="<?= old('testimonial1_father') ?>">
                        <?php if(isset($errors['testimonial1_father'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['testimonial1_father'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-12">
                    <label for="testimonial1_address" class="form-label">Address</label>
                    <input type="text" class="form-control <?= isset($erros['testimonial1_address']) ? 'is-invalid' : '' ?>" 
                        name="testimonial1_address" id="testimonial1_address" 
                        value="<?= old('testimonial1_address') ?>">
                        <?php if(isset($errors['testimonial1_address'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['testimonial1_address'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-6">
                    <label for="testimonial1_phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control <?= isset($erros['testimonial1_phone']) ? 'is-invalid' : '' ?>" 
                        name="testimonial1_phone" id="testimonial1_phone" 
                        value="<?= old('testimonial1_phone') ?>">
                        <?php if(isset($errors['testimonial1_phone'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['testimonial1_phone'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial 2 Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Testimonial 2 Details
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="testimonial2_name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= isset($erros['testimonial2_name']) ? 'is-invalid' : '' ?>" 
                        name="testimonial2_name" id="testimonial2_name" 
                        value="<?= old('testimonial2_name') ?>">
                        <?php if(isset($errors['testimonial2_name'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['testimonial2_name'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-6">
                    <label for="testimonial2_father" class="form-label">Father's Name</label>
                    <input type="text" class="form-control <?= isset($erros['testimonial2_father']) ? 'is-invalid' : '' ?>" 
                        name="testimonial2_father" id="testimonial2_father" 
                        value="<?= old('testimonial2_father') ?>">
                        <?php if(isset($errors['testimonial2_father'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['testimonial2_father'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-12">
                    <label for="testimonial2_address" class="form-label">Address</label>
                    <input type="text" class="form-control <?= isset($erros['testimonial2_address']) ? 'is-invalid' : '' ?>" 
                        name="testimonial2_address" id="testimonial2_address" 
                        value="<?= old('testimonial2_address') ?>">
                        <?php if(isset($errors['testimonial2_address'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['testimoniale2_address'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-6">
                    <label for="testimonial2_phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control <?= isset($erros['testimonial2_phone']) ? 'is-invalid' : '' ?>" 
                        name="testimonial2_phone" id="testimonial2_phone" 
                        value="<?= old('testimonial2_phone') ?>">
                        <?php if(isset($errors['testimonial2_phone'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['testimonial2_phone'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="buttons">
        <div class="m-auto w-25">
        <a class="btn btn-outline-secondary me-5" href="<?= base_url('/application-page?application_id='.$application_id) ?>">Cancel</a>
        <button type="submit" class="btn btn-success btn-lg">Save</button>
        </div>
    </div>

    <?= form_close() ?>
</div>

<?= $this->endSection() ?>