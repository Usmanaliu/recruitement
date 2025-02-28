<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درخواست نام برائے ملازمت - پنجاب پولیس</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Noto Nastaliq Urdu';
            src: url('<?= base_url('assets/fonts/NotoNastaliqUrdu-Regular.ttf') ?>') format('truetype');
        }
        body {
            font-family: 'Noto Nastaliq Urdu', serif;
            direction: rtl;
            text-align: right;
        }
        .form-container {
            width: 95%;
            margin: auto;
            border: 3px solid black;
            padding: 20px;
            background: #fff;
        }
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
        }
        .logo {
            width: 100px;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid black !important;
            text-align: center;
            vertical-align: middle;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 10px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-label {
            flex: 1;
            font-weight: bold;
        }
        .form-input {
            flex: 2;
            border-bottom: 1px solid black;
            text-align: center;
        }
        .checkbox-group {
            display: flex;
            gap: 10px;
        }
        .signature {
            margin-top: 30px;
            text-align: center;
            font-weight: bold;
        }
        .footer-text {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-container">
    <img src="<?= base_url('assets/images/logo.png') ?>" class="logo" alt="Punjab Police Logo">
    
    <div class="header">
        <p>درخواست نام برائے ملازمت</p>
        <p>PUNJAB POLICE</p>
    </div>
    <?php foreach ($applications as $application): ?>

    <table class="table table-bordered">
        <tr>
            <td>تاریخ</td>
            <td><?= date('d-m-Y') ?></td>
            <td>نام</td>
            <td><?= $application['name'] ?></td>
        </tr>
        <tr>
            <td>والد کا نام</td>
            <td><?= $application['father_name'] ?></td>
            <td>شناختی کارڈ نمبر</td>
            <td><?= $application['cnic'] ?></td>
        </tr>
        <tr>
            <td>پیدائش کی تاریخ</td>
            <td><?= $application['dob'] ?></td>
            <td>فون نمبر</td>
            <td><?= $application['phone'] ?></td>
        </tr>
        <tr>
            <td>پتہ</td>
            <td colspan="3"><?= $application['address'] ?></td>
        </tr>
        <tr>
            <td>تعلیمی قابلیت</td>
            <td><?= $application['qualification'] ?></td>
            <td>پولیس میں پہلے کام کیا؟</td>
            <td>
                <?= ($application['police_experience'] == 'yes') ? 'ہاں' : 'نہیں' ?>
            </td>
        </tr>
    </table>

    <div class="signature">امیدوار کے دستخط: ______________</div>

    <a href="<?= site_url('jobapplication/pdf/' . $application['id']) ?>" class="btn btn-primary mt-3">پی ڈی ایف ڈاؤن لوڈ کریں</a>
<?php endforeach; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
