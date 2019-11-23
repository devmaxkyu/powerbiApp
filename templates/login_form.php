

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
                <form name="loginform" id="loginform" action="<?php echo wp_login_url(); ?>" method="post">
                    <div class="p-l-30 p-r-30 p-t-10 p-b-10">
                        <h3 class="f-w-400 m-b-5">Welcome back!</h3>
                        <p>
					    <?php _e( 'Sign in to your account to continue' ); ?>
                        </p>

                        <!-- Show errors if there are any -->
						<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
						    <?php foreach ( $attributes['errors'] as $error ) : ?>
						        <p class="login-error">
						            <?php echo $error; ?>
						        </p>
						    <?php endforeach; ?>
						<?php endif; ?>

						<?php if ( $attributes['logged_out'] ) : ?>
						    <p class="login-info">
						        <?php _e( 'You have signed out. Would you like to sign in again?', 'personalize-login' ); ?>
						    </p>
						<?php endif; ?>

						<?php if ( $attributes['registered'] ) : ?>
						    <p class="login-info">
						        <?php
						            printf(
						                __( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'personalize-login' ),
						                get_bloginfo( 'name' )
						            );
						        ?>
						    </p>
						<?php endif; ?>

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
                            <a href="<?php echo wp_lostpassword_url(); ?>" class="f-s-12 d-block m-t-10">Forgot password?</a>
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
                            do_action( 'aad_sso_login_form' );

                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
<?php
    function load_scripts(){
    	$html = '<script src="'.get_bloginfo('template_directory').'/assets/chatVendor.js"></script>';
        $html.= '<script src="'.get_bloginfo('template_directory').'/assets/chat.js"></script>';
        $html.= '<script src="'.get_bloginfo('template_directory').'/assets/app.js"></script>';

        echo $html;
    }

    add_action('load_page_scripts', 'load_scripts');
?>
