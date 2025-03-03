<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
</head>
<body>
    <h2>Punjab Police Job Application Form</h2>
    <form action="<?= site_url('job_applications/submit') ?>" method="post">
        <label>District:</label>
        <input type="text" name="district" required><br>

        <label>Name (Urdu):</label>
        <input type="text" name="cand_name_urdu" required><br>
        
        <label>Name (English):</label>
        <input type="text" name="cand_name_eng" required><br>
        
        <label>Father's Name (Urdu):</label>
        <input type="text" name="father_name_urdu" required><br>
        
        <label>Father's Name (English):</label>
        <input type="text" name="father_name_eng" required><br>
        
        <label>Father's Occupation:</label>
        <input type="text" name="father_occupation" required><br>
        
        <label>Religion:</label>
        <input type="text" name="religion" required><br>
        
        <label>Cast:</label>
        <input type="text" name="cast" required><br>
        
        <label>Education:</label>
        <input type="text" name="education" required><br>
        
        <label>Date of Birth:</label>
        <input type="date" name="dob" required><br>
        
        <label>CNIC:</label>
        <input type="text" name="cnic" required><br>
        
        <label>Address:</label>
        <textarea name="address" required></textarea><br>
        
        <label>Qualification:</label>
        <input type="text" name="qualification" required><br>
        
        <label>Phone:</label>
        <input type="text" name="phone" required><br>
        
        <label>Job Experience:</label>
        <textarea name="job_experience"></textarea><br>
        
        <label>NOC Number (if any):</label>
        <input type="text" name="noc_number"><br>
        
        <label>Ex-Army:</label>
        <input type="checkbox" name="ex_army" value="1"><br>
        
        <label>Relative in Police:</label>
        <input type="checkbox" name="relative_inPolice" value="1"><br>
        
        <label>Relative Rank (if any):</label>
        <input type="text" name="relative_rank"><br>
        
        <label>Relative Belt Number (if any):</label>
        <input type="text" name="relative_belt_number"><br>
        
        <label>Relative District (if any):</label>
        <input type="text" name="relative_district"><br>
        
        <button type="submit">Submit Application</button>
    </form>
</body>
</html>
