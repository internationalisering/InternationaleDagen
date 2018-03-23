<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Users</h1>
        </div>
    </div>
    <?php $this->notifications->buildNotification(); ?>
    <div class="btn-toolbar pull-right" style="margin-bottom: 10px">
        <div class="btn-group">
            <a href="/gebruiker/new" class="btn btn-primary">New User</a>
        </div>
        <div class="btn-group">
            <a href="/gebruiker/import" class="btn btn-primary">Import Users</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabel-users">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-mail</th>
                        <th>Type</th>
                        <th width="33px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user){
                        echo '
                        <tr class="odd gradeX">
                            <td>' . $user->voornaam . '</td>
                            <td>' . $user->achternaam . '</td>
                            <td>' . $user->email . '</td>
                            <td>' . $user->type->naam . '</td>
                            <td class="center"><a href="/gebruiker/view/' . $user->id . '"><i class="far fa-search"></i></a> <a href="/gebruiker/edit/' . $user->id . '"><i class="far fa-edit"></i></a> <a href="/gebruiker/remove/' . $user->id . '"><i class="far fa-trash"></i></a></td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#tabel-users').DataTable({
        responsive: true,
        columnDefs: [
            {
                targets: [4],
                orderable: false
            }
        ]
    });
});
</script>