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
                            <section id="Content" class="List_review">

                                <div class="row mb-4">
                                    <div class="col-md-4 col-sm-7 text-center">
                                        <div class="bgColor p-2 p-sm-3 mb-3">
                                            <img src="<?php echo base_url('uploads/' . $receipt->image); ?>" alt="Logo" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <figcaption class="figure-caption">
                                            <p><label>Title: </label> <?php echo ucfirst($receipt->title); ?></p>
                                            <p><label>Code:</label> <?php echo $receipt->code; ?></p>
                                            <p><label>Date:</label> 
                                                <?php
                                                $date = explode('/', $receipt->date);
                                                $m = date('F', mktime(0, 0, 0, $date[1], 10));
                                                echo $date[0] . ' ' . $m . ', ' . $date[2];
                                                ?>
                                            </p>
                                            <p><label>Location:</label> <?php echo $receipt->location; ?></p>
                                            <p><label>Amount:</label> <?php echo number_format($receipt->amount); ?></p>
                                        </figcaption>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- /.table-responsive -->

                        <!-- /.panel-body -->
                    </div>

                </div>
                <!-- /#page-wrapper -->

            </div><!-- /#wrapper -->
