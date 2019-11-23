<!DOCTYPE html>
<html class="js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description">
    <meta content="" name="author">
    <title>SignUp || Taxi</title>

    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#212121">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#212121">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#212121">

    <!-- BEGIN BASE CSS STYLE -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/essential.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/animate.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/chat.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/style.css" rel="stylesheet" type="text/css">
    <!-- BEGIN END BASE CSS STYLE -->

</head>

<body>
    <div class="col-md-6 bg_header col-md-offset-3 m-t-10">
        <div class="res-xs-p-0" style="padding: 30px;">
            <div class="p-l-30 p-r-30 p-t-10 p-b-10">
                <h3 class="f-w-400 m-b-5">New Registration!</h3>
                <p class="m-b-0">Sign up to your account to continue</p>
                <br>
                <div class="form-group">
                    <div class="sm-form-design">
                        <input type="text" name="name" id="modal_username11" class="form-control"
                            placeholder="Please enter your username" required="" autocomplete="off">
                        <label class="control-label">Fullname</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="sm-form-design">
                        <input type="text" name="name" id="modal_username2" class="form-control"
                            placeholder="Please enter your username" required="" autocomplete="off">
                        <label class="control-label">Email</label>
                    </div>
                </div>
                <div class="form-group m-b-20">
                    <div class="sm-form-design">
                        <input type="text" name="name" id="modal_password1" class="form-control"
                            placeholder="Please enter your password" required="" autocomplete="off">
                        <label class="control-label">Password</label>
                    </div>
                    <div class="form-check pull-left">
                        <div class="form-check-label">
                            <div class="checkbox checkbox-primary">
                                <input id="form-check-input1" class="styled form-check-input" type="checkbox" checked=""
                                    autocomplete="off">
                                <label for="form-check-input1">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn p-t-12 p-b-12 btn-block btn-primary">Sign Up</button>

                <div class="m-t-30 m-b-20 f-s-12">
                    Have an account yet? <a href="#bottom_style1" data-toggle="tab" aria-expanded="false">Sign In</a>
                    <a href="javascript:void(0)" class="f-s-12 d-block m-t-5">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN BASE JS -->
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/jquery.min.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/jquery-ui.min.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/bootstrap.min.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/nicescroll.min.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/jquery.slimscroll.min.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/jquery.sparkline.js"></script>
    <!-- END BASE JS -->

    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/chatVendor.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/chat.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/app.js"></script>
    <!-- END PAGE LEVEL JS -->
</body>

</html>