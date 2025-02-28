<!DOCTYPE html>
<html lang="ur">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنجاب پولیس درخواست فارم</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Noto Nastaliq Urdu', serif;
            direction: rtl;
            text-align: right;
            background: white;
            padding: 30px;
        }
        .container {
            width: 850px;
            margin: auto;
            border: 2px solid black;
            padding: 20px;
            background: white;
        }
        .header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .sub-header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .logo {
            width: 80px;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        td, th {
            border: 1px solid black;
            padding: 8px;
            font-size: 16px;
        }
        .bold {
            font-weight: bold;
        }
        .signature-box {
            height: 50px;
            border: 1px solid black;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">پنجاب پولیس</div>
    <div class="sub-header">درخواست فارم برائے بھرتی</div>
        <?php foreach ($applications as $application): ?>
    <table>
        <tr>
            <td class="bold">نام:</td>
            <td colspan="3"><?= esc($application['name']); ?></td>
        </tr>
        <tr>
            <td class="bold">والد کا نام:</td>
            <td colspan="3"><?= esc($application['father_name']); ?></td>
        </tr>
        <tr>
            <td class="bold">تاریخ پیدائش:</td>
            <td><?= esc($application['dob']); ?></td>
            <td class="bold">شناختی کارڈ نمبر:</td>
            <td><?= esc($application['cnic']); ?></td>
        </tr>
        <tr>
            <td class="bold">مکمل پتہ:</td>
            <td colspan="3"><?= esc($application['address']); ?></td>
        </tr>
        <tr>
            <td class="bold">فون نمبر:</td>
            <td><?= esc($application['phone']); ?></td>
            <td class="bold">ڈومیسائل:</td>
            <td><?= esc($application['domicile']); ?></td>
        </tr>
    </table>

    <h3 class="sub-header">تعلیم اور جسمانی پیمائش</h3>

    <table>
        <tr>
            <td class="bold">تعلیم:</td>
            <td><?= esc($application['education']); ?></td>
            <td class="bold">قد (فٹ):</td>
            <td><?= esc($application['height']); ?></td>
        </tr>
        <tr>
            <td class="bold">چھاتی (انچ):</td>
            <td><?= esc($application['chest']); ?></td>
            <td class="bold">کیا آپ پہلے پولیس میں کام کر چکے ہیں؟</td>
            <td>
                <?= esc($application['police_experience']) ? 'ہاں' : 'نہیں'; ?>
            </td>
        </tr>
        <tr>
            <td class="bold">کیا آپ پہلے کسی سرکاری ادارے میں کام کر چکے ہیں؟</td>
            <td colspan="3">
                <?= esc($application['government_experience']) ? 'ہاں' : 'نہیں'; ?>
            </td>
        </tr>
    </table>

    <h3 class="sub-header">دیگر تفصیلات</h3>
    <table>
        <tr>
            <td colspan="4"><?= esc($application['other_details']); ?></td>
        </tr>
    </table>

    <h3 class="sub-header">دستخط اور تصدیق</h3>
    <table>
        <tr>
            <td class="bold">درخواست دہندہ کا دستخط:</td>
            <td class="signature-box"></td>
            <td class="bold">تاریخ:</td>
            <td class="signature-box"></td>
        </tr>
    </table>
            <?php endforeach; ?>
</div>

</body>
</html>
