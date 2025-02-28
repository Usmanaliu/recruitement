<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Noto Nastaliq Urdu', serif; direction: rtl; }
        .container { width: 100%; border: 1px solid black; padding: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h4 class="text-center">PUNJAB POLICE</h4>
    <p><strong>نام:</strong> <?= $application['name'] ?></p>
    <p><strong>والد کا نام:</strong> <?= $application['father_name'] ?></p>
    <p><strong>تاریخ پیدائش:</strong> <?= $application['dob'] ?></p>
    <p><strong>شناختی کارڈ نمبر:</strong> <?= $application['cnic'] ?></p>
    <p><strong>پتہ:</strong> <?= $application['address'] ?></p>
    <p><strong>تعلیمی قابلیت:</strong> <?= $application['qualification'] ?></p>
    <p><strong>فون نمبر:</strong> <?= $application['phone'] ?></p>
    <p><strong>ملازمت کا تجربہ:</strong> <?= $application['job_experience'] ?></p>
</div>

</body>
</html>
