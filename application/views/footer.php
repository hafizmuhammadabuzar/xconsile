<!-- Footer -->    
        <footer id="contact_us" class="pt-md-5 pb-md-3 py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-10 m-md-auto text-center">
                        <img src="<?php echo base_url(); ?>assets/images/logo-footer.png" alt="Logo" />
                        <p>We are XConsile.com. We are a online platform for operating events effectively. We're working on a web application for facilitating anonymous questions and answers sessions. The application is to be used mainly by corporate and government customers.  </p>
                    </div>
                    <div class="col-lg-2 col-sm-4 offset-lg-1 offset-sm-2 text-center text-sm-left mb-5 mb-sm-0">
                        <h5>Useful links</h5>
                        <nav>
                            <ul>
                                <li><a href="home">Home</a></li>
                                <li><a href="how_it_works">How it works</a></li>
                                <li><a href="">Terms and conditions</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="contact_us">Contact Us</a></li>
                                <li><a href="who_we_are">About us</a></li>
                                <li><a href="features">Features</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-2 col-sm-4 offset-sm-1 text-center text-sm-left mb-5 mb-sm-0">
                        <h5>My account</h5>
                        <nav>
                            <ul>
                                <li><a href="">Open a account</a></li>
                                <li><a href="">Manage</a></li>
                                <li><a href="">Change password</a></li>
                                <li><a href="">Delete account </a></li>
                                <li><a href="">Dashboard</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-8 col-10 mx-auto text-center">
                        <h5>We are social</h5>
                        <div class="SocialiCons mb-5">
                            <a href="" class="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="" class="Pinterest"><i class="fa fa-pinterest"></i></a>
                            <a href="" class="Linkedin"><i class="fa fa-linkedin"></i></a>
                            <a href="" class="Facebook"><i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="SubscribeBox">
                            <p>Subscribe to our newsletter</p>
                            <div class="form-group has-danger mb-0">
                                <label class="sr-only">E-Mail Address</label>
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <input type="text" class="form-control" placeholder="Email address" required="">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 text-center mt-5"><small>&copy; 2018 XConsile.com, all rights received</small></div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- Popup's Section -->
        <!-- Login PopUp-->
        <div class="modal fade" id="loginBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a class="nav-brand" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="XConsile"/></a>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>			
                    <!-- Modal body -->
                    <div class="modal-body py-3 px-5">
                        <h3 class="text-center mb-3">Login</h3>
                        <p><strong>Have no account yet? <a class="HidePopup" data-toggle="modal" data-target="#SignupBox">Signup here</a></strong></p>
                        <form action="#" method="post" id="login-form">
                            <span class="form-msg"></span>
                            <div class="row justify-content-center">
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control pt-2 pb-2" id="login_email" name="email" placeholder="Email" required="required">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="password" class="form-control pt-2 pb-2" id="login_pass" name="password" placeholder="Password" required="required">
                                </div>
                                <div class="col-12 mb-3 ForgotPass">
                                    <a class="HidePopup2" data-toggle="modal" data-target="#ForgotBox">Forgot Password?</a>
                                </div>
                                <div class="ButtonBox text-center col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>			
                </div>
            </div>
        </div>
        <!-- Login PopUp End-->

        <!-- Signup PopUp-->
        <div class="modal fade" id="SignupBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="nav-brand" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="XConsile"/></a>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body py-3 px-5">
                        <h3 class="text-center mb-3">Signup</h3>
                        <form id="signup-form" action="#" method="post">
                            <span class="form-msg"></span>
                            <div class="row justify-content-center">
                                <div class="col-12 mb-3">
                                    <label>User Name</label>
                                    <input type="text" class="form-control pt-2 pb-2" id="signup_name" name="username" placeholder="Name">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control pt-2 pb-2" id="signup_email" name="email" placeholder="Email">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Password</label>
                                    <input type="password" class="form-control pt-2 pb-2" id="signup_pass" name="password" placeholder="Password">
                                </div>
<!--                                <div class="col-12 mb-3">
                                    <label>Re-type Password</label>
                                    <input type="password" class="form-control pt-2 pb-2" id="signup_retype_pass" name="signup_retype_pass" placeholder="Re-type Password">
                                </div>-->
                                <div class="col-12 mb-3">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control pt-2 pb-2" id="signup_dob" name="dob" placeholder="Date of Birth" required="required">

                                </div>
                                <div class="col-12">
                                    <label>Gender</label>
                                    <div class="col-9">
                                        <label class="custom-control custom-radio">
                                            <input name="gender" type="radio" class="custom-control-input" value="Male" checked="checked">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Male</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="mixed0" name="gender" type="radio" class="custom-control-input" value="Female">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Female</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="ButtonBox text-center col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Signup PopUp End-->

        <!-- Forgot Password PopUp-->
        <div class="modal fade" id="ForgotBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a class="nav-brand" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="XConsile"/></a>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>			
                    <!-- Modal body -->
                    <div class="modal-body py-3 px-5">
                        <h3 class="text-center mb-3">Forgot Password</h3>
                        <form action="#" method="post" id="forgot-form">
                            <span class="form-msg"></span>
                            <div class="row justify-content-center">
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control pt-2 pb-2" id="forgot_email" name="email" placeholder="Email">
                                </div>
                                <div class="ButtonBox text-center col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>			
                </div>
            </div>
        </div>
        <!-- Forgot Password PopUp End-->
        <!-- Popup's Section End-->

        <!-- Common Files -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" ></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script>
            //Scroll Up/Down
            $(document).ready(function () {
                $('a[href^="#"]').click(function () {
                    var target = $(this.hash);
                    if (target.length == 0)
                        target = $('a[name="' + this.hash.substr(1) + '"]');
                    if (target.length == 0)
                        target = $('html');
                    $('html, body').animate({scrollTop: target.offset().top}, 800);
                    return false;
                });
                
                $('#signup-form').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        data: $(this).serialize(),
                        url: '<?php echo base_url()."user/signup" ?>',
                        success: function (res) {
                            if (res.status == 'Success') {
                                $('.form-msg').css('color', 'green').text(res.msg);
                                $('#signup-form')[0].reset();
                                
                                setTimeout(function(){
                                    $('#SignupBox').modal('hide');
                                    $('.form-msg').text('');
                                }, 2000);
                            }
                            else{
                                $('.form-msg').css('color', 'red').html(res.msg);
                            }
                            setTimeout(function(){
                                $('.form-msg').text('');
                            }, 3000);
                        }
                    });
                })
                
                $('#login-form').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        data: $(this).serialize(),
                        url: '<?php echo base_url()."user/login" ?>',
                        success: function (res) {
                            if (res.status == 'Success') {
                                $('.form-msg').css('color', 'green').text('Logged In, Redirecting....');
                                $('#login-form')[0].reset();
                                window.location = '<?php echo base_url()."user"; ?>';
                                
                                setTimeout(function(){
                                    $('#loginBox').modal('hide');
                                    $('.form-msg').text('');
                                }, 2000);
                            }
                            else{
                                $('.form-msg').css('color', 'red').html(res.msg);
                            }
                            setTimeout(function(){
                                $('.form-msg').text('');
                            }, 3000);
                        }
                    });
                })
                
                $('#forgot-form').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        data: $(this).serialize(),
                        url: '<?php echo base_url()."user/forgot-password" ?>',
                        success: function (res) {
                            if (res.status == 'Success') {
                                $('.form-msg').css('color', 'green').text(res.msg);
                                $('#forgot-form')[0].reset();
                                
                                setTimeout(function(){
                                    $('#ForgotBox').modal('hide');
                                    $('.form-msg').text('');
                                }, 2000);
                            }
                            else{
                                $('.form-msg').css('color', 'red').html(res.msg);
                            }
                            setTimeout(function(){
                                $('.form-msg').text('');
                            }, 3000);
                        }
                    });
                })
            });

            $(".HidePopup, .HidePopup2").on("click", function () {
                $('#loginBox').modal('hide');
            });
            $(".HidePopup").on("click", function () {
                $('#SignupBox').modal('show');
            });
            $(document).on('hidden.bs.modal', function () {
                $('body').addClass('modal-open');
            });
            
        </script>
        <script>
            //Scroll Up/Down
            $(document).ready(function () {
                $('a[href^="#"]').click(function () {
                    var target = $(this.hash);
                    if (target.length == 0)
                        target = $('a[name="' + this.hash.substr(1) + '"]');
                    if (target.length == 0)
                        target = $('html');
                    $('html, body').animate({scrollTop: target.offset().top}, 800);
                    return false;
                });
            });
        </script>

    </body>
</html>