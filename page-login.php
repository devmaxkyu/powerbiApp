<!DOCTYPE html>
<html class="js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description">
    <meta content="" name="author">
    <title>Login || Taxi</title>

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

    <?php
        /**
         * Enqueue scripts and styles for the login page.
         *
         * @since 3.1.0
         */
        do_action( 'login_enqueue_scripts' );
    ?>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 bg_header col-md-offset-3 m-t-10 p-t-100">
                <?php
                /**
                 * Fires when the login form is initialized.
                 *
                 * @since 3.2.0
                 */
                do_action( 'login_init' );
                ?>
                <form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
                    <div class="p-l-30 p-r-30 p-t-10 p-b-10">
                        <h3 class="f-w-400 m-b-5">Welcome back!</h3>
                        <p>Sign in to your account to continue</p>
                        <br>
                        <div class="form-group">
                            <div class="sm-form-design">
                                <input type="text" name="log" id="modal_username" class="form-control" placeholder="Please enter your username" required="" autocomplete="off">
                                <label class="control-label"><?php _e( 'Username or Email Address' ); ?></label>
                            </div>
                        </div>
                        <div class="form-group m-b-20">
                            <div class="sm-form-design">
                                <input type="password" name="pwd" id="modal_password" class="form-control" placeholder="Please enter your password" required="" autocomplete="off">
                                <label class="control-label"><?php _e( 'Password' ); ?></label>
                            </div>
                            <a href="javascript:void(0)" class="f-s-12 d-block m-t-10">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn p-t-12 p-b-12 btn-block btn-primary">Sign In</button>
                        <div class="m-t-30 m-b-20 f-s-12">
                            Don't have an account yet? <a href="<?php echo home_url('/signup/');?>">Sign Up</a>
                        </div>
                         <div class="m-t-30 m-b-20 f-s-12">
                            <?php

                            /**
                             * Fires following the 'Password' field in the login form.
                             *
                             * @since 2.1.0
                             */
                            do_action( 'login_form' );

                            ?>
                        </div>
                    </div>
                </form>
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