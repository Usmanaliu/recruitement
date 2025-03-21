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
                                <a href="#" class="btn btn-outline-primary btn-lg">View Details</a>
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

<script>
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
