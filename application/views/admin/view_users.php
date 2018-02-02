<div id="wrapper">

    <!-- Navigation -->
    <?php include 'navigation.php'; ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                View User
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                   id="dataTables-example" role="grid" aria-describedby="dataTables-example_info"
                                   style="width: 100%;" width="100%">
                                <thead>
                                <tr role="row">
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Date of Birth</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach( $users as $row ): ?>
                                    <tr class="gradeA odd" role="row">
                                        <td><a href="<?php echo base_url('admin/view_user_receipts/'.$row['id']); ?>"><?php echo $row['username']; ?></a></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['gender']; ?></td>
                                        <td><?php echo date('d-M-Y', strtotime($row['dob'])); ?></td>
                                        <td><?php if($row['status'] == 1) { echo 'Active'; }else{ echo 'Pending'; } ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->

                    <!-- /.panel-body -->
                </div>

            </div>
            <!-- /#page-wrapper -->

        </div><!-- /#wrapper -->