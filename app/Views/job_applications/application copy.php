<?= $this->extend('templates/base'); ?>


<?= $this->section('content'); ?>

<div class="form-body">
    <div class="frm-heading w-100">
        <div class="row">
            <div class="col-8">
                <!-- punjab police logo -->
                <div class="row">

                    <div class="col-6">
                        <div class="logo m-1">

                            <img src="<?= base_url('assets/images/logo.png') ?>" class="logo" alt="Punjab Police Logo">
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="heading text-center my-3">
                            <div class="row border-bottom">

                                <h1>درخواست برائے بھرتی</h1>
                            </div>
                            <div class="row">
                                <h2>PUNJAB POLICE</h2>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center">
                        <div class="box">
                            <h6 class="box border">درخواست فارم برائے بھرتی</h6>
                        </div>
                        <div class="box">
                            <h6 class="box border">فارم جمع کروانے کی آخری تاریخ</h6>
                        </div>
                    </div>
                    <div class="col-6 text-center">
                        <h6>نام آسامی ــــــــــــــــ</h6>
                        <h6>فارم نمبر ــــــــــــــــ</h6>
                    </div>
                </div>
            </div>

            <div class="col-4 d-flex justify-content-end">

                <div class="pic m-3 border">

                </div>
            </div>
        </div>

    </div>
    <div class="form pe-3">
        <div class="part text-center"><h4>حصہ اول</h4></div>
        <table class=" form-table w-100 text-end border">
            
            <tr class="mb-4">
               
                <td class="d-flex justify-content-center flex-wrap">
                <?php foreach (str_split($application['name']) as $letter): ?>
                            <div class="border spelling text-center"><?=strtoupper($letter)  ?></div>
                            <?php endforeach;?>
                </td>
                <td><span>انگریزی بڑے حروف میں</span></td>
                <td><span>نام:</span> <span class="field mx-3"> <?= esc($application['name_urdu'])   ?> </span></td>
                <td>.1</td>
            </tr>
            <tr class="my-4">
                <td class="d-flex justify-content-center flex-wrap">
                    <span class="mx-3">پیشہ/محکمہ ـــــــــــ</span>
                <?php foreach (str_split($application['father_name']) as $letter): ?>
                            <div class="border spelling text-center"><?=strtoupper($letter)  ?></div>
                            <?php endforeach;?>
                </td>
                <td><span>انگریزی بڑے حروف میں</span></td>
                <td> <span>نام:</span> <span class="field mx-3">  <?= esc($application['f_name_urdu'])   ?> </span></td>
                <td>.2</td>
            </tr>
            <tr>
                
                
                <td><span> تاریخ پیدائش بمطابق میٹرک سند </span><span class="field mx-3"><?= $application['dob']?></td>
                <td><span> ذات </span><span class="field mx-3"><?= $application['cast']?></td>
                <td><span> مذہب </span><span class="field mx-3"><?= $application['religion']?></span></td>
                <td><span>.3</span></td>
            </tr>
            <tr> 
                <td><span>  یوم </span><span class="field mx-3"><?= $application['dob']?></td>
                <td><span>  ماہ </span><span class="field mx-3"><?= $application['dob']?></td>
                <td><span> عمر  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; سال </span><span class="field mx-3"><?= $application['dob']?></td>
                <td><span> ضلع </span><span class="field mx-3"><?= $application['district']?></span></td>
                
            </tr>
        </table>
    </div>

</div>






<?= $this->endSection() ?>