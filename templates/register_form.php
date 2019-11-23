<body>
    <div class="col-md-6 bg_header col-md-offset-3 m-t-10">
        <div class="res-xs-p-0" style="padding: 30px;">
            <div class="p-l-30 p-r-30 p-t-10 p-b-10">
                <h3 class="f-w-400 m-b-5">New Registration!</h3>
                <p class="m-b-0">Sign up to your account to continue</p>
                <?php if ( $attributes['show_title'] ) : ?>
                        <h3><?php _e( 'Register', 'personalize-login' ); ?></h3>
                    <?php endif; ?>
                    
                    <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
                        <?php foreach ( $attributes['errors'] as $error ) : ?>
                            <p>
                                <?php echo $error; ?>
                            </p>
                        <?php endforeach; ?>
                <?php endif; ?>
                <br>

                <form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">

                    <div class="form-group">
                        <div class="sm-form-design">
                            <input type="text" name="email" id="modal_username2" class="form-control"
                                placeholder="Please enter your username" required="" autocomplete="off">
                            <label class="control-label">Email</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="sm-form-design">
                            <input type="text" name="first_name" id="modal_username11" class="form-control"
                                placeholder="Please enter your username" required="" autocomplete="off">
                            <label class="control-label">First Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="sm-form-design">
                            <input type="text" name="last_name" id="modal_username11" class="form-control"
                                placeholder="Please enter your username" required="" autocomplete="off">
                            <label class="control-label">Last Name</label>
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
                    <button type="submit" class="btn p-t-12 p-b-12 btn-block btn-primary">Sign Up</button>
                </form>
                <div class="m-t-30 m-b-20 f-s-12">
                    Have an account yet? <a href="<?php echo wp_login_url(); ?>">Sign In</a>
                    <a href="javascript:void(0)" class="f-s-12 d-block m-t-5">Forgot password?</a>
                </div>
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

    //add_action('load_page_scripts', 'load_scripts');
?>