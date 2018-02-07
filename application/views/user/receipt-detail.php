<section id="Content" class="List_review">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Receipts Listing</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 col-sm-7 text-center">
            <div class="bgColor p-2 p-sm-3 mb-3">
                <img src="<?php echo base_url('uploads/'.$receipt->image); ?>" alt="Logo" />
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
                    echo $date[0].' '.$m.', '.$date[2];
                    ?>
                </p>
                <p><label>Location:</label> <?php echo $receipt->location; ?></p>
                <p><label>Amount:</label> <?php echo number_format($receipt->amount); ?></p>
            </figcaption>
        </div>
    </div>
</section>