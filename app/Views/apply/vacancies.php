<?= $this->extend('templates/base'); ?>

<?= $this->section('content'); ?>

<div class="container my-4">
    <div id="jobCarousel" class="carousel slide shadow-lg rounded overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#jobCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#jobCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#jobCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="4000">
                <img src="<?= base_url('assets/images/job1.jpg') ?>" class="d-block w-100 rounded" alt="Job Vacancy">
                <div class="carousel-caption bg-dark bg-opacity-50 rounded p-2">
                    <h5>Join Us Today</h5>
                    <p>Explore the latest job opportunities available.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="<?= base_url('assets/images/job2.jpg') ?>" class="d-block w-100 rounded" alt="Career Growth">
                <div class="carousel-caption bg-dark bg-opacity-50 rounded p-2">
                    <h5>Build Your Career</h5>
                    <p>Find the perfect job that matches your skills.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/images/job3.jpg') ?>" class="d-block w-100 rounded" alt="Success Stories">
                <div class="carousel-caption bg-dark bg-opacity-50 rounded p-2">
                    <h5>Your Future Starts Here</h5>
                    <p>Apply now and take the first step towards success.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="container py-5">
    <?php if (!$jobs): ?>
        <div class="text-center py-5">
            <h2 class="text-muted">No Jobs Available</h2>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($jobs as $job): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 rounded h-100">
                        <img src="<?= base_url('assets/images/constable.jfif') ?>" class="card-img-top" alt="Job Image">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary">Apply for <?= esc($job['job_title']) ?></h5>
                            <p class="card-text">Find out if you're eligible and apply today.</p>
                            <div class="mt-auto d-flex justify-content-around">
                            <button class="btn btn-info btn-lg view-details"
                                            data-job='<?= json_encode($job, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                            data-bs-toggle="modal"
                                            data-bs-target="#jobModal">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                <button class="btn btn-success btn-lg apply-btn" data-bs-toggle="modal" data-job-id="<?= esc($job['job_id']) ?>"  data-bs-target="#applyModal-<?= $job['job_id'] ?>">Apply</button>
                                <a href="<?= base_url('SearchApplication/'.$job['job_id']) ?>" class="btn btn-dark btn-lg">Download Slip</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Apply Modal -->
                <div class="modal fade" id="applyModal-<?= $job['job_id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Apply for <?= esc($job['job_title']) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Requirements:</strong></p>
                                <ul id="requirements-<?= $job['job_id'] ?>" class="list-group list-group-flush">Loading...</ul>
                                <form action="<?= base_url('/apply/' . $job['job_id']) ?>" method="post">
                                    <div class="mb-3">
                                        <label for="cand_cnic_<?= $job['job_id'] ?>" class="form-label">Enter CNIC</label>
                                        <input type="text" class="form-control" name="cand_cnic" id="cand_cnic_<?= $job['job_id'] ?>" pattern="\d{13}" maxlength="13" placeholder="Without dashes" required>
                                        <span id="cnicError_<?= $job['job_id'] ?>" class="text-danger"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>





<!-- Job Details Modal -->
<div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title d-flex align-items-center gap-2">
                    <i class="fas fa-briefcase"></i>
                    <span id="jobModalLabel">Job Details</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Header Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="job-header bg-light p-4 rounded-3">
                                <h3 class="text-primary mb-3" id="modal-title"></h3>
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="badge bg-primary-subtle text-primary-emphasis py-2 px-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span id="modal-district"></span>
                                    </div>
                                    <div class="badge bg-success-subtle text-success-emphasis py-2 px-3">
                                        <i class="fas fa-layer-group me-2"></i>
                                        <span id="modal-scale"></span>
                                    </div>
                                    <div class="badge bg-info-subtle text-info-emphasis py-2 px-3">
                                        <i class="fas fa-clock me-2"></i>
                                        <span id="modal-type"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Section -->
                    <div class="row mb-4 jobVeiw">
                        <div class="col-md-6">
                            <div class="card border-primary h-100">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Timeline</h6>
                                </div>
                                <div class="card-body">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-5 text-muted">Start Date</dt>
                                        <dd class="col-sm-7 fw-bold text-primary" id="modal-start"></dd>
                                        
                                        <dt class="col-sm-5 text-muted">Closing Date</dt>
                                        <dd class="col-sm-7 fw-bold text-danger" id="modal-closing"></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Requirements Summary -->
                        <div class="col-md-6 mt-3 mt-md-0 jobVeiw">
                            <div class="card border-info h-100">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Key Requirements</h6>
                                </div>
                                <div class="card-body">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-5 text-muted">Education</dt>
                                        <dd class="col-sm-7" id="modal-education"></dd>
                                        
                                        <dt class="col-sm-5 text-muted">Age Range</dt>
                                        <dd class="col-sm-7" id="modal-age"></dd>
                                        
                                        <dt class="col-sm-5 text-muted">Height (M/F)</dt>
                                        <dd class="col-sm-7">
                                            <span id="modal-height-male"></span> /
                                            <span id="modal-height-female"></span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Requirements -->
                    <div class="row jobVeiw">
                        <div class="col-12">
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-dark">
                                    <h6 class="mb-0"><i class="fas fa-running me-2"></i>Physical Requirements</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-6 text-muted">Chest Measurement</dt>
                                                <dd class="col-sm-6" id="modal-chest"></dd>
                                                
                                                <dt class="col-sm-6 text-muted">Running (Male)</dt>
                                                <dd class="col-sm-6" id="modal-running-male"></dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="row">
                                                <dt class="col-sm-6 text-muted">Running (Female)</dt>
                                                <dd class="col-sm-6" id="modal-running-female"></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Note Section -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Please ensure you meet all requirements before applying. Contact support for any queries.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>
y
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Corrected event handler with proper data handling
    $(document).on('click', '.view-details', function() {
        // Get the properly parsed job data object
        const jobData = $(this).data('job');
        
        // Format dates
        const startDate = new Date(jobData.start_date).toLocaleDateString();
        const closingDate = new Date(jobData.closing_date).toLocaleDateString();

        // Populate modal fields
        $('#modal-title').text(jobData.job_title || 'N/A');
        $('#modal-type').text(jobData.job_type || 'N/A');
        $('#modal-scale').text(jobData.job_scale || 'N/A');
        $('#modal-district').text(jobData.job_district || 'N/A');
        $('#modal-start').text(startDate);
        $('#modal-closing').text(closingDate);
        
        // Handle requirements with null checks
        $('#modal-education').text(jobData.education || 'N/A');
        $('#modal-age').text(
            (jobData.age_min ? `${jobData.age_min} years` : 'N/A') + ' - ' + 
            (jobData.age_max ? `${jobData.age_max} years` : 'N/A')
        );
        $('#modal-height-male').text(jobData.height_male ? `${jobData.height_male} cm` : 'N/A');
        $('#modal-height-female').text(jobData.height_female ? `${jobData.height_female} cm` : 'N/A');
        $('#modal-chest').text(
            jobData.chest ? 
            `${jobData.chest} cm${jobData.chest_expended ? ` (Expanded: ${jobData.chest_expended} cm)` : ''}` : 
            'N/A'
        );
        $('#modal-running-male').text(
            jobData.running_male ? 
            `${jobData.running_male}${jobData.running_duration_male ? ` (${jobData.running_duration_male})` : ''}` : 
            'N/A'
        );
        $('#modal-running-female').text(
            jobData.running_female ? 
            `${jobData.running_female}${jobData.running_duration_female ? ` (${jobData.running_duration_female})` : ''}` : 
            'N/A'
        );
    });

    // Fix for aria-hidden warning
    $('#jobModal').on('hidden.bs.modal', function () {
        $(this).removeAttr('aria-hidden');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
});

//--------------------------------------------------------------------------------------------------
document.querySelectorAll("input[id^='cand_cnic_']").forEach(input => {
        input.addEventListener("input", function() {
            let cnic = this.value;
            let errorSpan = document.getElementById("cnicError_" + this.id.split("_")[2]);
            errorSpan.textContent = (/^\d{13}$/.test(cnic)) ? "" : "CNIC must be exactly 13 digits.";
        });
    });

    document.querySelectorAll(".apply-btn").forEach(button => {
        button.addEventListener("click", function() {
            let jobId = this.getAttribute("data-job-id");
            let requirementsElement = document.getElementById("requirements-" + jobId);

            fetch("<?= base_url('/get-requirements/') ?>" + jobId)
                .then(response => response.json())
                .then(data => {
                    requirementsElement.innerHTML = Object.keys(data).length > 0 ? Object.values(data).map(req => `<li class='list-group-item'>${req}</li>`).join('') : "No requirements available.";
                })
                .catch(error => {
                    requirementsElement.innerHTML = "Failed to load requirements.";
                    console.error("Error fetching requirements:", error);
                });
        });
    });
</script>

<?= $this->endSection() ?>
