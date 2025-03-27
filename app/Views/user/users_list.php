<?= $this->extend('templates/panel/base');?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary-gradient">
            <h3 class="mb-0 text-white font-weight-bold">User Management</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="usersTable" class="table table-hover table-striped nowrap" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>CNIC</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url": "<?= site_url('joinpunjabpolice/admin/users') ?>",
                "type": "GET"
            },
            "order": [[0, 'desc']],
            "language": {
                "processing": '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
            },
            "columns": [
                { "data": 0, "className": "fw-medium" },
                { "data": 1 },
                { "data": 2 },
                { 
                    "data": 3,
                    "render": function(data) {
                        return data.replace(/(\d{5})(\d{7})(\d{1})/, "$1-$2-$3");
                    }
                },
                { "data": 4 },
                { "data": 5 }, // Plain role text
                { "data": 6 }, // Plain status text
                { 
                    "data": 0,
                    "className": "text-center",
                    "render": function(data) {
                        return `
                        <div class="d-inline-flex gap-2">
                            <a href="<?= site_url('joinpunjabpolice/admin/user/') ?>${data}" 
                               class="btn btn-icon btn-sm btn-outline-primary rounded-circle"
                               data-bs-toggle="tooltip" 
                               title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="btn btn-icon btn-sm btn-outline-danger rounded-circle"
                                    data-bs-toggle="tooltip" 
                                    title="Delete User">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>`;
                    }
                }
            ],
            "initComplete": function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>

<?= $this->endSection() ?>