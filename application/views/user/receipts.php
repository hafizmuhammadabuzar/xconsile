<section id="Content" class="Listing">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Receipts</h1>
        </div>
    </div>
    <div class="row">
        <?php foreach($receipts as $row): ?>
        <div class="col-lg-3 col-sm-6 text-center text-sm-left">
            <figure class="figure p-4">
                <a href="<?php echo base_url('user/receipt-detail/'.$row['id']); ?>"><img src="<?php echo base_url('uploads/'.$row['image']); ?>" class="figure-img mx-auto mb-3" alt="receipt"></a>
                <figcaption class="figure-caption">
                    <label><?php echo ucfirst($row['title']); ?></label>
                    <div class="w-100">Code: <a href="#"><?php echo $row['code']; ?></a></div>
                </figcaption>
            </figure>							
        </div>
        <?php endforeach; ?>
    </div>				
</section>