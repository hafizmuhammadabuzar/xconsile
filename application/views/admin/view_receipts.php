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
                View Receipts
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if(count($receipts) > 0){ ?>
                            <section id="Content" class="Listing">
                                <div class="row">
                                    <div class="row">
                                        <?php
                                        foreach ($receipts as $row): ?>
                                            <div class="col-lg-3 col-sm-6 text-center text-sm-left">
                                                <figure class="figure p-4">
                                                    <a href="<?php echo base_url('admin/receipt-detail/' . $row['id']); ?>"><img src="<?php echo base_url('uploads/' . $row['image']); ?>" class="figure-img mx-auto mb-3" alt="receipt"></a>
                                                    <figcaption class="figure-caption">
                                                        <label><?php echo ucfirst($row['title']); ?></label>
                                                        <div class="w-100">Code: <a href="#"><?php echo $row['code']; ?></a></div>
                                                    </figcaption>
                                                </figure>							
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>				
                            </section>
                            <?php } else { echo 'No record found'; } ?>
                        </div>
                        <!-- /.table-responsive -->

                        <!-- /.panel-body -->
                    </div>

                </div>
                <!-- /#page-wrapper -->

            </div><!-- /#wrapper -->
