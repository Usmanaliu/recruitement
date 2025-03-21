<?= $this->extend('templates/base'); ?>


<?= $this->section('content'); ?>

<div class="form-body p-4 shadow-lg rounded bg-light">
    <div class="frm-heading w-100 border-bottom pb-3">
        <div class="row align-items-center">
            <div class="col-8">
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <img src="<?= base_url('assets/images/logo.png') ?>" class="logo img-fluid" alt="Punjab Police Logo">
                    </div>
                    <div class="col-6 text-center">
                        <h1 class="fw-bold text-primary">درخواست برائے بھرتی</h1>
                        <h2 class="text-uppercase text-dark">PUNJAB POLICE</h2>
                    </div>
                </div>
                <div class="row mt-auto">
                    <div class="col-6 text-center border p-3 bg-white rounded shadow-sm">
                        <h6 class="fw-bold">درخواست فارم برائے بھرتی</h6>
                        <h6>فارم جمع کروانے کی آخری تاریخ:</h6>
                        <h6 class="text-danger fw-bold"><?= $job['closing_date'] ?></h6>
                    </div>
                    <div class="col-6 text-center border p-3 bg-white rounded shadow-sm">
                        <table class="w-100 text_direction">
                            <tr>
                                <td><strong>نام آسامی:</strong></td>
                                <td class="fw-bold text-primary"><?= $job['job_title'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>فارم نمبر:</strong></td>
                                <td class="fw-bold text-secondary"><?= $application['form_number'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>ضلع:</strong></td>
                                <td class="fw-bold text-secondary"><?= $application['district_domicile'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <div class="pic border rounded p-1 shadow-sm">
                    <img src="<?= base_url('assets/uploads/' . $application['picture']) ?>" class="img-fluid rounded" alt="candidate picture">
                </div>
            </div>
        </div>
    </div>

    <div id="main_app" class="form">
        <div class="part text-center mb-auto">
            <h4 class="fw-bold text-dark border-bottom py-2">حصہ اول</h4>
        </div>
        <table id="application_tbl" class=" form-table w-100 text-end border">

            <tr class="mb-4">

                <td class="d-flex justify-content-center flex-wrap">
                    <?php foreach (str_split($application['cand_name_eng']) as $letter): ?>
                        <div class="border spelling text-center"><?= strtoupper($letter)  ?></div>
                    <?php endforeach; ?>
                </td>
                <td><span>انگریزی بڑے حروف میں</span></td>
                <td><span>نام:</span> <span class="field mx-3"> <?= esc($application['cand_name_urdu'])   ?> </span></td>
                <td>.1</td>
            </tr>
            <tr class="my-4">
                <td class="d-flex flex-wrap">
                    <span class="field w-1 mx-3"> <?= $application['father_occupation']   ?> </span><span class="mx-3">پیشہ/محکمہ </span>
                    <?php foreach (str_split($application['father_name_eng']) as $letter): ?>
                        <div class="border spelling text-center"><?= strtoupper($letter)  ?></div>
                    <?php endforeach; ?>
                </td>
                <td><span>انگریزی بڑے حروف میں</span></td>
                <td> <span>نام:</span> <span class="field mx-3"> <?= esc($application['father_name_urdu'])   ?> </span></td>
                <td>.2</td>
            </tr>
            <tr>


                <td><span class="field mx-3"><?= $application['dob'] ?></span><span class="mx-1"> تاریخ پیدائش بمطابق میٹرک سند </span></td>
                <td><span class="field mx-3"><?= $application['cast'] ?></span><span class="mx-1"> ذات </span></td>
                <td><span class="field mx-3"><?= $application['religion'] ?></span><span class="mx-1"> مذہب </span></td>
                <td><span>.3</span></td>
            </tr>
            <tr id="row_4">
                <td colspan="2" class="text_direction"><span class="mx-4"> .8 </span><span>عمر:</span><span class="field ms-1 me-3"><?= $age['year'] ?></span><span>سال</span><span class="field me-3 ms-1"><?= $age['month'] ?></span><span>ماہ</span><span class="field ms-1 me-3"><?= $age['days'] ?></span><span>یوم</span></td>
                <td><span class="field mx-3"><?= $application['district_domicile'] ?></span><span> ضلع </span></td>
                <td><span> .7 </span></span></td>

            </tr>
            <tr>

                <td colspan="2" class="d-flex justify-content-center">

                    <?php
                    $count = 0;
                    foreach (str_split($application['cnic']) as $letter):
                        $count++;
                        if ($count == 6 || $count == 13):
                    ?>
                            <div class="border cnic text-center">-</div>
                        <?php endif; ?>
                        <div class="border cnic text-center"><?= $letter ?></div>
                    <?php endforeach; ?>

                </td>
                <td></td>
                <td><span> قومی شناختی کارڈنمبر </span></span></td>
                <td><span> .9 </span></span></td>

            </tr>
        </table>
        <table class="w-100 tbl2 boarder text_direction">

            <tr class="text_direction border-bottom-0">
                <td>10.</td>
                <td><strong>برائے سابقہ فوجی۔</strong></td>
                <td><span> ڈسچارج سرٹیفیکیٹ تاریخ</span><span class="field mx-2"><?= $application['ex_army_discharge_certificate_number'] ?></span><span>ڈسچارج سرٹیفیکیٹ نمبر</span><span class="field mx-2"><?= $application['ex_army_discharge_certificate_date'] ?></span></td>
                <td><span>مدت ملاذمت:</span><span class="field ms-1 me-3"><?= $age['year'] ?></span><span>سال</span><span class="field me-3 ms-1"><?= $age['month'] ?></span><span>ماہ</span><span class="field ms-1 me-3"><?= $age['days'] ?></span><span>یوم</span></td>
            </tr>
            <tr class="border-top-0">
                <td colspan="3" class="text-center"><span>موجودہ عمرسےفوجی ملازمت منہا کرنے کے بعد بقایا</span><span>عمر:</span><span class="field ms-1 me-3"><?= $age['year'] ?></span><span>سال</span><span class="field me-3 ms-1"><?= $age['month'] ?></span><span>ماہ</span><span class="field ms-1 me-3"><?= $age['days'] ?></span><span>یوم</span></td>
                <td></td>
            </tr>
            <tr class="border-bottom-0">
                <td>11.</td>
                <td colspan="3" class="text-end"> <strong>برائے سرکاری ملازمت:۔</strong><span>ملازمت کے مکمل کوائف</span><span class="field mx-4"><?= $application['job_experience'] ?></span></td>
            </tr>
            <tr class="border-top-0">
                <td colspan="3" class="text-center"><span>محکمانہ اجازت نامہ<strong>NOC</strong>بمعہ نمبر جاری کردہ مجاز اتھارٹی لف ہے</span><span class="field mx-4"><?= $application['noc_number'] ?></span></td>
                <td></td>
            </tr>
            <tr>
                <td>12.</td>
                <td colspan="3" class="text-end"> <span>مستقل پتہ</span> <span class="field mx-3"><?= $application['current_address'] ?></span><span>تھانہ</span><span class="field mx-3"><?= $application['current_add_ps'] ?></span> <span>فون نمبر</span> <span class="field mx-3"><?= $application['phone'] ?></span> </td>
            </tr>
            <tr>
                <td>13.</td>
                <td colspan="3" class="text-end"> <span>موجودہ پتہ برائے خط و کتابت</span> <span class="field mx-3"><?= $application['current_address'] ?></span><span>تھانہ</span><span class="field mx-3"><?= $application['current_add_ps'] ?></span> </td>
            </tr>
            <tr class="border-bottom-0">
                <td>14.</td>
                <td colspan="3" class="text-end"> <span>والد /دادا پولیس میں تھایا ہے تو اس کے کوائف</span> <span>نام:</span> <span class="field mx-3"><?= $application['current_address'] ?></span><span>رشتہ</span><span class="field mx-3"><?= $application['relation_relative'] ?></span> </td>
            </tr>
            <tr class="border-bottom-0 border-top-0">
                <td colspan="3" class="text-center"><span>پیٹی نمبر</span><span class="field mx-3"><?= $application['relative_belt_number'] ?></span><span>عہدہ</span><span class="field mx-3"><?= $application['relative_rank'] ?></span>ضلع<span></span><span class="field mx-3"><?= $application['relative_district'] ?></span></td>
                <td></td>
            </tr>
            <tr class="border-top-0">
                <td colspan="3" class="text-center"><span>پولیس کے جس شعبہ میں ملازمت کی/کر رہے ہیں</span><span class="field mx-3"><?= $application['relative_district'] ?></span>ریٹائرڈ<span></span><span class="field mx-3"><?= $application['relative_job_status'] ?></span></td>
                <td></td>
            </tr>
            <tr class="border-bottom-0">
                <td>15.</td>
                <td colspan="3" class="text-end"><span>دو معززین کے نام و مکمل پتہ جن سے مندرجہ بالا کوائف کی تصدیق کی جاسکتی ہے۔</span></td>
            </tr>
            <tr class="border-bottom-0 border-top-0">
                <td></td>
                <td colspan="2" class="text-end"><strong>(الف)</strong><span>نام:</span><span class="field mx-3"><?= $application['testimonial1_name'] ?></span><span>ولد</span><span class="field mx-3"><?= $application['testimonial1_father'] ?></span></td>
                <td></span><span>موبائل نمبر</span><span class="field mx-3"><?= $application['testimonial1_phone'] ?></span></td>
            </tr>
            <tr class="border-bottom-0 border-top-0">
                <td></td>
                <td colspan="3" class="text-end"><span class="mx-4">سکنہ:</span><span class="field mx-3"><?= $application['testimonial1_address'] ?></td>                
            </tr>
            <tr class="border-bottom-0 border-top-0">
                <td></td>
                <td colspan="2" class="text-end"><strong>(ب)</strong><span>نام:</span><span class="field mx-3"><?= $application['testimonial2_name'] ?></span><span>ولد</span><span class="field mx-3"><?= $application['testimonial2_father'] ?></span></td>
                <td></span><span>موبائل نمبر</span><span class="field mx-3"><?= $application['testimonial2_phone'] ?></span></td>
            </tr>
            <tr class="border-top-0">
                <td></td>
                <td colspan="3" class="text-end"><span class="mx-4">سکنہ:</span><span class="field mx-3"><?= $application['testimonial2_address'] ?></span></td>
            </tr>

        </table>
        <div class="oathPara text_direction tbl2">
            <p>
                <strong>حلف نامہ:۔</strong>
                میں حلفابیان کرتا /کرتی ہوں کہ مندرجہ بالاکوائف درست ہیں اور میں کسی قسم کے جرم یا تخریبی کاروائی میں کبھی گرفتار / چالان / سزا یافتہ یا ملوث نہ رہا ہوں ۔ میں اپنی سابقہ ملازمت میں سزایافتہ نہ رہا ہوں اور با عزت طور پر ریٹائرڈ ہوا ہوں۔ نیز میں کسی خطر ناک بیماری میں بھی مبتلا نہیں ہوں۔
            </p>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <div class="signature">
                    دستخط امید وار
                </div>
                <div class="thumb">
                    انگوٹھے کے نشان
                </div>
            </div>
        </div>
    </div>
</div>

</div>


<div id="slip" class="form-body p-4 shadow-lg rounded my-4 bg-light">
    <?php for ($i = 0; $i < 3; $i++):  ?>
        <div class="rolSlip w-100">
            <div class="slipHeading py-2 text-center">
                <h4>رول نمبر سلپ</h4>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="pic mx-auto border rounded p-1 shadow-sm">
                        <img src="<?= base_url('assets/uploads/' . $application['picture']) ?>" class="img-fluid rounded" alt="candidate picture">
                    </div>
                    <div class="stamp">
                        <div>
                            <strong>دستخط و مہر وصول کنندہ</strong>

                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <table class="text_direction slipTbl ">
                        <tr>
                            <td>فارم نمبر</td>
                            <td> <span class="field mx-3 fw-bold  text-primary"> <?= esc($application['application_id'])   ?></td>
                            <td>برائے آسامی</td>
                            <td><span class="field fw-bold  text-primary"><?= $job['job_title'] ?></span></td>
                        </tr>
                        <tr>
                            <td>نام</td>
                            <td> <span class="field mx-3 fw-bold  text-primary"> <?= esc($application['cand_name_urdu'])   ?></td>
                            <td>ولدیت</td>
                            <td><span class="field fw-bold  text-primary"><?= $application['father_name_urdu'] ?></span></td>
                        </tr>
                        <tr>
                        <td>شناختی کارڈ نمبر</td>
                            <td> <span class="field mx-3 fw-bold  text-primary"> <?= esc($application['cnic'])   ?></td>
                            <td>ضلع</td>
                            <td><span class="field fw-bold  text-primary"><?= $application['district_domicile'] ?></span></td>
                        </tr>
                        <tr>
                            <td >ڈائیری نمبر</td>
                            <td ></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

    <?php endfor; ?>
</div>





<?= $this->endSection() ?>