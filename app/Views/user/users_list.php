<?= $this->extend('templates/panel/base');?>


<?= $this->section('content'); ?>
<div class="container">
    <div class="heading text-center">
        <h3>Users List</h3>
    </div>
    <table id="usersTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>CNIC</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
</div>
    
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
            "url": "<?= site_url('joinpunjabpolice/admin/users') ?>",
            "type": "GET"
        },
        "columns": [
            { "data": 0 },
            { "data": 1 },
            { "data": 2 },
            { "data": 3 },
            { "data": 4 },
            { "data": 5 },
            { "data": 6 }
        ]
    });
});
</script>


<?= $this->endSection() ?>