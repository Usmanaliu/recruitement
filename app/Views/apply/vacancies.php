<!-- filepath: /c:/Users/dmonitring/Desktop/codeigniter4/recruitement/app/Views/apply/vacancies.php -->
<?= $this->extend('templates/base'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('assets/images/job1.jpg') ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/images/job2.jpg') ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/images/job3.jpg') ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<section class="body-cards my-5">
    <div class="container">
        <?php if (!$jobs): ?>
            <div class="text-center">
                <h1>No Jobs Available</h1>
            </div>
        <?php endif; ?>
        <div class="d-flex flex-wrap">
            <?php foreach ($jobs as $job): ?>
                <div class="card m-5" style="width: 18rem;">
                    <img src="<?= base_url('assets/images/constable.jfif') ?>" class="card-img-top" alt="constable posts">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Apply for <?= $job['job_title'] ?></strong></h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="btn d-flex justify-content-between">
                            <a href="#" class="">View Details</a>
                            <a data-bs-toggle="modal" data-bs-target="#applyModel-<?= $job['job_id'] ?>" href="<?= base_url('/apply/' . $job['job_id']) ?>" class=" ">Apply</a>
                            <a href="#" class="">Download Slip</a>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="applyModel-<?= $job['job_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Your CNIC</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('/apply/' . $job['job_id']) ?>" method="post">
                                    <div class="mb-3">
                                        <label for="cand_cnic" class="form-label">CNIC:</label>
                                        <input type="number" class="form-control" name="cand_cnic" id="cand_cnic" placeholder="without dashes" required>
                                        <?php if (isset($validation) && $validation->hasError('cand_cnic')): ?>
                                            <div class="text-danger">
                                                <?= $validation->getError('cand_cnic') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Apply</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>