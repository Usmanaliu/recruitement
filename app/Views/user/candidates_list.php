<?= $this->extend('templates/panel/base');?>


<?= $this->section('content'); ?>
<div class="container">
    <div class="heading text-center">
        <h3>Candidates List</h3>
    </div>
    <div class="cand_table">
    <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Candidate Name</th>
            <th>Candidate Father Name</th>
            <th>Domicile</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table>
    </div>
</div>
<script>
    
</script>
<?= $this->endSection() ?>