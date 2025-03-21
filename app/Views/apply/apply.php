<?= $this->extend('templates/base'); ?>

<?= $this->section('content'); ?>
<div class="container application-container">
    <section class="application-header shadow-sm p-4 mb-5 bg-white rounded">
        <div class="row">
            <!-- Left Column - Job Details -->
            <div class="col-md-8">
                <h1 class="text-primary mb-4"><?= $job['job_title'] ?> (BS-<?= $job['job_scale'] ?>)</h1>
                <div class="job-details">
                    <div class="detail-item mb-3">
                        <h5 class="text-secondary">Applicant Information</h5>
                        <div class="row">
                            <div class="col-4">
                                <p><strong>CNIC:</strong><br> <?= $application['cnic'] ?></p>
                                <p><strong>Name:</strong><br> <?= $application['cand_name_eng'] ?></p>
                            </div>
                            <div class="col-4">
                                <p><strong>Job Title:</strong><br> <?= $job['job_title'] ?></p>
                                <p><strong>Job Scale:</strong><br> <?= $job['job_scale'] ?></p>
                            </div>
                            <div class="col-4">
                                <p><strong>Application Status: <span class="<?= ($application['status'] === 'Rejected') ? 'text-danger' : '' ?>"><br><?= $application['status'] ?></strong></p>
                                <p><strong>Remarks: <span class="<?= ($application['status'] === 'Rejected' ) ? 'text-danger' : '' ?>"><br> <?= $application['remarks'] ?></strong></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Image Upload -->
            <div class="col-md-4">
                <div class="image-upload-section text-center">
                    <div class="profile-pic-container mb-3">
                        <div class="profile-pic-wrapper rounded-circle border position-relative mx-auto">
                            <img id="previewImage" src="<?= $application['picture'] ? base_url('/assets/uploads/' . $application['picture']) : base_url('/assets/placeholder.jpg') ?>" 
                                 class="profile-image rounded-circle img-thumbnail" 
                                 alt="Profile Picture">
                            <div class="upload-overlay rounded-circle">
                                <i class="fas fa-camera text-white"></i>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="applicationId" value="<?= $application['application_id'] ?>">
                    <input type="file" accept="image/*" name="profile_pic" id="profile_pic" class="d-none">
                    <button onclick="document.getElementById('profile_pic').click()" 
                            class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-upload"></i> Upload Photo
                    </button>
                    <div class="text-muted small mt-2">Max 30KB, 300x300px</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Steps -->
    <section class="application-steps mb-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Application Progress</h5>
                    </div>
                    <div class="card-body">
                        <div class="step-list">
                            <!-- General Information -->
                            <div class="step-item d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <h6 class="mb-0">General Information</h6>
                                    <small class="text-muted">Personal details and basic information</small>
                                </div>
                                <a href="<?= base_url('/informationForm/' . $application['application_id']) ?>" 
                                   class="btn <?= $application['district_domicile'] ? 'btn-success' : 'btn-outline-secondary' ?>">
                                    <?= $application['district_domicile'] ? 'Update' : 'Add' ?>
                                </a>
                            </div>

                            <!-- Address Information -->
                            <div class="step-item d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <h6 class="mb-0">Address Information</h6>
                                    <small class="text-muted">Permanent and current address</small>
                                </div>
                                <a href="<?= base_url('/addressForm/' . $application['application_id']) ?>" 
                                   class="btn <?= $application['permanent_district'] ? 'btn-success' : 'btn-outline-secondary' ?>">
                                    <?= $application['permanent_district'] ? 'Update' : 'Add' ?>
                                </a>
                            </div>

                            <!-- Education -->
                            <div class="step-item d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <h6 class="mb-0">Education</h6>
                                    <small class="text-muted">Academic qualifications and degrees</small>
                                </div>
                                <a href="<?= base_url('/educationFrom/' . $application['application_id']) ?>" 
                                   class="btn <?= $application['education'] ? 'btn-success' : 'btn-outline-secondary' ?>">
                                    <?= $application['education'] ? 'Update' : 'Add' ?>
                                </a>
                            </div>

                            <!-- Police Relatives -->
                            <div class="step-item d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <h6 class="mb-0">Police Relatives</h6>
                                    <small class="text-muted">Information about relatives in police service</small>
                                </div>
                                <a href="<?= base_url('/relative-form-data/' . $application['application_id']) ?>" 
                                   class="btn <?= $application['relation_relative'] ? 'btn-success' : 'btn-outline-secondary' ?>">
                                    <?= $application['relation_relative'] ? 'Update' : 'Add' ?>
                                </a>
                            </div>

                            <!-- Experience -->
                            <div class="step-item d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <h6 class="mb-0">Professional Experience</h6>
                                    <small class="text-muted">Previous work experience and NOC details</small>
                                </div>
                                <a href="<?= base_url('/experianceInfoForm/' . $application['application_id']) ?>" 
                                   class="btn <?= ($application['ex_army'] || $application['noc_number']) ? 'btn-success' : 'btn-outline-secondary' ?>">
                                    <?= ($application['ex_army'] || $application['noc_number']) ? 'Update' : 'Add' ?>
                                </a>
                            </div>
                            <!-- Testimonials iformation -->
                            <div class="step-item d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <h6 class="mb-0">Testimonial Information</h6>
                                    <small class="text-muted">Please add two testimonial's name, address etc</small>
                                </div>
                                <a href="<?= base_url('/testimonialinfo/' . $application['application_id']) ?>" 
                                   class="btn <?= ($application['testimonial1_name'] || $application['testimonial2_name']) ? 'btn-success' : 'btn-outline-secondary' ?>">
                                    <?= ($application['testimonial1_name'] || $application['testimonial2_name']) ? 'Update' : 'Add' ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submission Section -->
            <div class="col-md-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body text-center">
                        <h5 class="text-muted mb-4">Ready to Submit?</h5>
                        <div class="requirements-list text-start mb-4">
                            <small class="d-block mb-2 <?= $application['picture'] ? 'text-success' : 'text-muted' ?>">
                                <i class="fas fa-<?= $application['picture'] ? 'check' : 'times' ?>-circle"></i> Profile Photo
                            </small>
                            <small class="d-block mb-2 <?= $application['district_domicile'] ? 'text-success' : 'text-muted' ?>">
                                <i class="fas fa-<?= $application['district_domicile'] ? 'check' : 'times' ?>-circle"></i> Personal Info
                            </small>
                            <small class="d-block mb-2 <?= $application['permanent_district'] ? 'text-success' : 'text-muted' ?>">
                                <i class="fas fa-<?= $application['permanent_district'] ? 'check' : 'times' ?>-circle"></i> Address
                            </small>
                            <small class="d-block mb-2 <?= $application['education'] ? 'text-success' : 'text-muted' ?>">
                                <i class="fas fa-<?= $application['education'] ? 'check' : 'times' ?>-circle"></i> Education
                            </small>
                            <small class="d-block mb-2 <?= $application['relation_relative'] ? 'text-success' : 'text-muted' ?>">
                                <i class="fas fa-<?= $application['relation_relative'] ? 'check' : 'times' ?>-circle"></i> Police Relatives
                            </small>
                            <small class="d-block mb-2 <?= ($application['ex_army'] || $application['noc_number']) ? 'text-success' : 'text-muted' ?>">
                                <i class="fas fa-<?= ($application['ex_army'] || $application['noc_number']) ? 'check' : 'times' ?>-circle"></i> Experience
                            </small>
                        </div>
                        <a href="<?= base_url('dowloadApplication/'.$job['job_id']) ?>" 
                           class="btn btn-primary btn-lg w-100" 
                           id="submitButton"
                           >
                            <i class="fas fa-file-export"></i> Submit Application
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .profile-pic-container {
        position: relative;
        width: 200px;
        margin: 0 auto;
    }

    .profile-pic-wrapper {
        width: 200px;
        height: 200px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .upload-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-pic-wrapper:hover .upload-overlay {
        opacity: 1;
    }

    .step-item {
        border-bottom: 1px solid #eee;
        transition: background-color 0.2s ease;
    }

    .step-item:hover {
        background-color: #f8f9fa;
    }

    .application-container {
        max-width: 1200px;
        margin: 2rem auto;
    }

    .requirements-list small i {
        margin-right: 8px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const submitButton = document.getElementById('submitButton');
        const requirementItems = document.querySelectorAll('.requirements-list small');

        function checkCompletion() {
            let allComplete = true;
            
            requirementItems.forEach(item => {
                if (!item.classList.contains('text-success')) {
                    allComplete = false;
                }
            });

            submitButton.style.display = allComplete ? 'block' : 'none';
        }

        // Initial check
        checkCompletion();

        // Image upload handler
        document.getElementById('profile_pic').addEventListener('change', function(event) {
            const formData = new FormData();
            formData.append('profile_pic', event.target.files[0]);
            formData.append('application_id', document.getElementById('applicationId').value);

            fetch('<?= base_url('/uploadimage') ?>', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('previewImage').src = 
                        `<?= base_url('assets/uploads/') ?>${data.fileName}?t=${new Date().getTime()}`;
                    document.querySelector('[data-requirement="photo"]').classList.add('text-success');
                    checkCompletion();
                }
            });
        });

        // Auto-check every 2 seconds (can be adjusted)
        setInterval(checkCompletion, 2000);
    });
</script>

<?= $this->endSection() ?>