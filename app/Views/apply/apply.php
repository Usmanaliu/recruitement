<?= $this->extend('templates/base'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="heading text-center">
        <h1>Apply for <?= $job['job_title'] ?> BS- <?= $job['job_scale'] ?></h1>

        <table class="text-center w-50 mx-auto">
            <tr>
                <td>Job Title</td>
                <td><?= $job['job_title'] ?></td>
            </tr>
            <tr>
                <td>Job Scale</td>
                <td><?= $job['job_scale'] ?></td>
            </tr>
            <tr>
                <td>Applicant CNIC:</td>
                <td><?= $application['cnic'] ?></td>
            </tr>
            <tr>
                <td>Application ID:</td>
                <td><?= $application['application_id'] ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="pic border ms-auto">
                        <a class="pic border " href="#">
                            <img id="previewImage" src="<?= $application['picture'] ? base_url('/assets/uploads/' . $application['picture']) : '' ?>" alt="upload your image size 30kb" class="img-fluid">
                        </a>
                    </div>

                    <input type="hidden" id="applicationId" value="<?= $application['application_id'] ?>">
                    <input type="file" accept="image/*" name="profile_pic" id="profile_pic" class="form-control" required>
                    <button type="submit" id="btn_upload_img" onclick="uploadImage()" class="btn btn-primary mt-2">Upload Image</button>

                </td>
            </tr>
            <tr>
                <td>Generl Information:</td>

                <td>
                    <a id="genInfo" href="<?= base_url('/informationForm/' . $application['application_id']) ?>" class="btn btn-primary m-2 show-loader">
                        <?php echo ($application['district']) ? "Update" : "Add"; ?></a>
                </td>

            </tr>
            <tr>
                <td>Education:</td>

                <td>
                    <a id="edu" href="<?= base_url('/educationFrom/' . $application['application_id']) ?>" class="btn btn-primary m-2 show-loader">
                        <?php echo ($application['education']) ? "Update" : "Add"; ?></a>
                </td>

            </tr>
            <tr>
                <td>Relatives Police:</td>

                <td>
                    <a id="relPo" href="<?= base_url('/relative-form-data/' . $application['application_id']) ?>" class="btn btn-primary m-2 show-loader">
                        <?= ($application['relation_relative']) ? "Update" : "Add"; ?>
                    </a>
                </td>

            </tr>
            <tr>
                <td>Experiance:</td>

                <td>
                    <a id="exp" href="<?= base_url('/experianceInfoForm/' . $application['application_id']) ?>" class="btn btn-primary m-2 show-loader">
                        <?= ($application['relation_relative']) ? "Update" : "Add"; ?>
                    </a>
                </td>

            </tr>


            <tr>
                <td>
                    <div id="btn_submit_app" class="btn_submit_app">
                        <button class="btn btn-primary">Submit Application</button>
                    </div>
                </td>
            </tr>


        </table>
    </div>
    </section>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const app_sm_btn = document.querySelector('#btn_submit_app');
            const edu_btn = document.querySelector('#edu');
            const rel_btn = document.querySelector('#relPo');
            const genInf_btn = document.querySelector('#genInfo');
            const exp_btn = document.querySelector('#exp');

            function checkButtons() {
                if (
                    edu_btn.innerText.trim() === "Update" &&
                    rel_btn.innerText.trim() === "Update" &&
                    genInf_btn.innerText.trim() === "Update" &&
                    exp_btn.innerText.trim() === "Update"
                ) {
                    app_sm_btn.style.display = 'block'; // Show button
                } else {
                    app_sm_btn.style.display = 'none'; // Hide button
                }
            }

            // Run check on page load
            checkButtons();

            // If links are clicked, delay execution to allow page to update
            [edu_btn, rel_btn, genInf_btn, exp_btn].forEach(btn => {
                btn.addEventListener('click', function() {
                    setTimeout(checkButtons, 500);
                });
            });
        });



        let imgSelector = document.getElementById('profile_pic');
        imgSelector.style.display = 'none';
        let previewImage = document.getElementById('previewImage');
        let btnUpload = document.getElementById('btn_upload_img');
        btnUpload.style.display = 'none';
        previewImage.addEventListener('click', function() {
            imgSelector.click();
        });
        imgSelector.addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                // document.getElementById('previewImage').src = reader.result;
                btnUpload.click();
            }
            reader.readAsDataURL(event.target.files[0]);
        });



        function uploadImage() {

            const fileInput = document.getElementById('profile_pic');
            const applicationId = document.getElementById('applicationId').value;
            const file = fileInput.files[0];

            if (!file) {
                alert('Please select an image first');
                return;
            }

            const formData = new FormData();
            formData.append('profile_pic', file);
            formData.append('application_id', applicationId);
            console.log(formData);
            fetch('<?= base_url('/uploadimage') ?>', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Success: ' + data.message);
                        // Update image preview with cache-busting
                        const previewImage = document.getElementById('previewImage');
                        previewImage.src = `<?= base_url('assets/uploads/') ?>${data.fileName}?t=${new Date().getTime()}`;
                    } else {
                        alert('Error: ' + data.message);
                    }
                });
        }
    </script>

    <?= $this->endSection() ?>