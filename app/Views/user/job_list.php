<?= $this->extend('templates/panel/base'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">Job Vacancies</h4>
            <a href="<?= base_url('joinpunjabpolice/admin/create-job') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle"></i> Create New Job
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Job Title</th>
                            <th>Type</th>
                            <th>Scale</th>
                            <th>District</th>
                            <th>Summary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($job_list)) : ?>

                            <?php foreach ($job_list as $job) : ?>
                                <tr>
                                    <td><?= esc($job['job_title']) ?></td>
                                    <td><?= esc($job['job_type']) ?></td>
                                    <td><?= esc($job['job_scale']) ?></td>
                                    <td><?= esc($job['job_district']) ?></td>
                                    <td><?= esc($job['requirements']) ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm view-details"
                                            data-job='<?= json_encode($job, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                            data-bs-toggle="modal"
                                            data-bs-target="#jobModal">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="alert alert-warning mb-0">No job vacancies found</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
                            <div class="card h-100">
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
                            <div class="card h-100">
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
                            <div class="card ">
                                <div class="card-header bg-primary text-white">
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
                    <!-- <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Please ensure you meet all requirements before applying. Contact support for any queries.
                            </div>
                        </div>
                    </div> -->
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

<style>
</style>



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
</script>

<?= $this->endSection() ?>