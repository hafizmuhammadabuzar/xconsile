
<section id="RegisterBox" class="py-5 mb-4">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-sm-8 col-md-8 col-lg-5">
                <h1>Reset Password</h1>
                <?php echo validation_errors(); ?>
                <form action="<?php echo base_url('password/reset'); ?>" method="post">
                    <div class="row text-left">
                        <div class="col-12 mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control pt-2 pb-2" id="signup_pass" name="password" placeholder="Password">
                        </div>
                        <div class="col-12 mb-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control pt-2 pb-2" id="signup_retype_pass" name="c_password" placeholder="Confirm Password">
                        </div>
                        <div class="ButtonBox text-center col-12">
                            <button type="submit" class="btn btn-primary" name="reset_btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>