<?= $this->extend('templates/base'); ?>


<?= $this->section('content'); ?>

<div class="container-fluid my-3 border">
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

    <section class="part-1">
        <div class="container-fluid">
            <div class="text-center">
                <h5>حصہ اؤل</h5>
            </div>

            <!-- sr 1 -->

            <div class="row my-1 text-end">

                <div class="col-6 d-flex justify-content-between">

                    <table class="w-75 spelling-table">
                        <tr>

                            <td class="d-flex justify-content-start flex-wrap">
                                <?php foreach (str_split($application['name']) as $letter): ?>
                                    <div class="border spelling text-center"><?= strtoupper($letter)  ?></div>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-2 d-flex justify-content-center">
                    <div class="">بڑے انگریزی حروف میں</div>

                </div>

                <div class="col-4 d-flex justify-content-end">
                    <table class="spelling-table">
                        <tr>


                            <td class="px-2">
                                <div class="field"><?= esc($application['name_urdu'])  ?></div>
                            </td>
                            <td class="px-2">نام</td>
                            <td class="px-2">.1</td>
                        </tr>
                    </table>
                </div>


            </div>
            <!-- sr 2 -->
            <div class="row my-1 text-end">

                <div class="col-6">

                    <table class="w-100">
                        <tr>
                            <td class="px-2">پیشہ/محکمہ ـــــــــــ</td>
                            <td class="d-flex justify-content-start flex-wrap">
                                <?php foreach (str_split($application['father_name']) as $letter): ?>
                                    <div class="border spelling text-center"><?= strtoupper($letter)  ?></div>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-2 d-flex justify-content-center">
                    <div class="">بڑے انگریزی حروف میں</div>

                </div>
                <!-- sr 2 -->
                <div class="col-4 d-flex justify-content-end">
                    <table>
                        <tr>
                            <td class="px-2">
                                <div class="field"><?= esc($application['f_name_urdu']) ?></div>
                            </td>
                            <td class="px-2"> والد کا نام</td>
                            <td class="px-2">.2</td>
                        </tr>
                    </table>
                </div>


            </div>

            <!-- from 3 to 6 -->
            <div class="row my-1 text-end">
                <div class="col-12 d-flex justify-content-end"">

                    <table class=" w-100">
                    <tr>
                        <td class="px-1 field"><?= esc($application['dob']) ?></td>
                        <td class="px-1">تاریخ پیدائش بمطابق میٹرک سند</td>
                        <td class="px-1">.6</td>
                        <td class="px-1 field"><?= esc($application['education']) ?></td>
                        <td class="px-1">تعلیم</td>
                        <td class="px-1">.5</td>
                        <td class="px-1 field"><?= esc($application['cast']) ?></td>
                        <td class="px-1">ذات</td>
                        <td class="px-1">.4</td>
                        <td class="px-1 field"><?= esc($application['religion']) ?></td>
                        <td class="px-1">مذہب</td>
                        <td class="px-1">.3</td>
                    </tr>
                    </table>
                </div>
            </div>
            <!-- from 7 to 8 -->
            <div class="row my-1 text-end">
                <div class="col-12 d-flex justify-content-end"">

                    <table class=" w-100">
                    <tr>

                        <td class="pe-2">یوم</td>
                        <td class="px-1 text-start field"><?= esc($age['days']) ?></td>
                        <td class="pe-2">ماہ</td>
                        <td class="px-1 text-start field"><?= esc($age['month']) ?></td>
                        <td class="pe-2">سال</td>
                        <td class="px-1 text-start field"><?= esc($age['year']) ?></td>
                        <td class="px-2">عمر</td>
                        <td class="px-2">.8</td>
                        <td class="px-2 field"><?= esc($application['district']) ?></td>
                        <td class="px-2">ضلع</td>
                        <td class="px-2">.7</td>
                    </tr>
                    </table>
                </div>
            </div>

            <!-- sr 9 -->
            <div class="row my-1 d-flex justify-content-end">
                <div class="col-8">
                    <table class="w-100">
                        <tr>  
                        <?php 
                        $count = 0;
                        foreach (str_split($application['cnic']) as $letter): 
                            $count++;
                            if($count == 6 || $count == 13):
                                ?>
                                <td class="border text-center">-</td>
                                    <?php endif; ?>
                            <td class="border text-center"><?= $letter ?></td>
                        <?php endforeach; ?>
                           
                        </tr>
                    </table>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <table>
                        <tr>
                            <td class="px-2">قومی شناختی کارڈنمبر</td>
                            <td class="px-3">.9</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- sr 10 -->
            <div class="row my-1 d-flex justify-content-end">

                <div class="col-12 d-flex justify-content-end">
                    <table class="w-100 text-end">
                        <tr>
                            <td class="px-2">ــــــــــ یوم</td>
                            <td class="px-2">ـــــــــ ماہ</td>
                            <td class="px-2">ـــــــــ سال</td>
                            <td class="px-2">مدت ملازمت</td>
                            <td class="px-2">تاریخ ڈسچارج ـــــــــــ</td>
                            <td class="px-2">ڈسچارج سرٹیفیکیٹ ـــــــــــ</td>
                            <td class="px-2"><strong>برائے سابقہ فوجی۔</strong></td>
                            <td class="px-2">.10</td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="w-100">
                            <tr>
                                <td class="px-2">ــــــــــ یوم</td>
                                <td class="px-2">ــــــــــ ماہ</td>
                                <td class="px-2">ــــــــــ سال</td>
                                <td class="px-2">موجودہ عمر سے فوجی ملازمیت منہا کرنے کے بعد بقایا عمر: ۔ </td>

                            </tr>
                        </table>

                    </div>
                </div>


            </div>
            <!-- sr 11 -->
            <div class="row my-1 d-flex justify-content-end">


                <div class="col-12 d-flex justify-content-end">

                    <table class="text-end">
                        <tr>
                            <td class="px-2"> </td>
                            <td class="px-2 bold"> <strong>برایے سرکاری ملازم:۔</strong> <span>سابقہ ملاذمت کے مکمل کوائف:ــــــــــــــــــــــــــــــــــــــــــ</span></td>
                            <td class="px-2">.11</td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="w-100">
                            <tr>

                                <td class="px-2">ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ</td>
                                <td class="px-2"> بمعہ نمبر برایے جاری کردہ مجاز اتھارٹی لف ہے:۔<strong>(NOC)</strong><strong>محکمانہ اجازت نامہ </strong> </td>

                            </tr>
                        </table>

                    </div>
                </div>


            </div>
            <!-- sr 12 -->
            <div class="row my-1 d-flex justify-content-end">
                <div class="col-12 d-flex justify-content-end">
                    <table class="text-end w-100">
                        <tr>
                            <td class="px-2 bold"><span>_____________________فون نمبر</span></td>
                            <td class="px-2 bold"><span>_____________________تھانہ</span></td>
                            <td class="px-2 bold"><span>_____________________مستقل پتہ</span></td>
                            <td class="px-2">.12</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- sr 13 -->
            <div class="row my-1 d-flex justify-content-end">
                <div class="col-12 d-flex justify-content-end">
                    <table class="text-end w-100">
                        <tr>

                            <td class="px-2 bold"><span>_____________________تھانہ</span></td>
                            <td class="px-2 bold"><span>____________________ موجودہ پتہ برایے خط و کتابت:</span></td>
                            <td class="px-2">.13</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- sr 14 -->
            <div class="row my-1 d-flex justify-content-end">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <table class="text-end w-100">
                            <tr>
                                <td class="px-2 bold"><span>_____________________رشتہ</span></td>
                                <td class="px-2 bold"><span>_____________________نام</span></td>
                                <td class="px-2 bold"><span>والد یا دادا پولیس میں تھا تو اس کے مکمل کوائف:۔</span></td>
                                <td class="px-2">.14</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="w-100">
                            <tr>
                                <td class="px-2 bold"><span>_____________________ضلع</span></td>
                                <td class="px-2 bold"><span>_____________________عہدہ</span></td>
                                <td class="px-2 bold"><span>_____________________پیٹی نمبر</span></td>


                            </tr>
                        </table>
                    </div>
                </div>

            </div>
            <!-- sr 15 -->
            <div class="row my-1 d-flex justify-content-end">
                <div class="col-12 d-flex justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            <table class="text-end w-100">
                                <tr>
                                    <td class="px-2 bold"><span>دو معززین کے نام و مکمل پتہ جن سے مندرجہ بالا کوائف کی تصدیق کی جاسکتی ہے۔</span></td>
                                    <td class="px-2">.15</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex">
                    <table class="text-end w-100">
                        <tr>
                            <td class="px-2 bold"><span>فون نمبر ــــــــــــــــــــــــــــــــــــــــــــــــــــ</span></td>
                            <td class="px-2 bold"><span>ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ</span></td>
                            <td class="px-2">(الف)</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex">
                    <table class="text-end w-100">
                        <tr>
                            <td class="px-2 bold"><span>فون نمبر ــــــــــــــــــــــــــــــــــــــــــــــــــــ</span></td>
                            <td class="px-2 bold"><span>ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ</span></td>
                            <td class="px-2">(ب)</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-12 d-flex justify-content-end">
                    <p class="text-end">
                        <strong>حلف نامہ:۔</strong>
                        میں حلفابیان کرتا /کرتی ہوں کہ مندرجہ بالاکوائف درست ہیں اور میں کسی قسم کے جرم یا تخریبی کاروائی میں کبھی گرفتار / چالان / سزا یافتہ یا ملوث نہ رہا ہوں ۔ میں اپنی سابقہ ملازمت میں سزایافتہ نہ رہا ہوں اور با عزت طور پر ریٹائرڈ ہوا ہوں۔ نیز میں کسی خطر ناک بیماری میں بھی مبتلا نہیں ہوں۔
                    </p>
                </div>
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
    </section>

</div>

<?= $this->endSection() ?>