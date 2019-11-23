<?php
/**
 * Plugin Name:       Personalize Login
 * Description:       A plugin that replaces the WordPress login flow with a custom page.
 * Version:           1.0.0
 * Author:            Zemin Wang
 * License:           GPL-2.0+
 * Text Domain:       personalize-login
 */
 
class Personalize_Login_Plugin {
 
    /**
     * Initializes the plugin.
     *
     * To keep the initialization fast, only add filter and action
     * hooks in the constructor.
     */
    public function __construct() {

    	// 
     	add_shortcode( 'custom-login-form', array( $this, 'render_login_form' ) );
     	add_shortcode( 'custom-register-form', array( $this, 'render_register_form' ) );

     	// handling the GET login request
     	add_action( 'login_form_login', array( $this, 'redirect_to_custom_login' ) );

     	// handling the GET register request
     	add_action( 'login_form_register', array( $this, 'redirect_to_custom_register' ) );
     	// handling the POST register submit request
     	add_action( 'login_form_register', array( $this, 'do_register_user' ) ); 

     	add_filter( 'authenticate', array( $this, 'maybe_redirect_at_authenticate' ), 101, 3 );

		add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );

		add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );
    }


    /**
	 * A shortcode for rendering the login form.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_login_form( $attributes, $content = null ) {

	    // Parse shortcode attributes
	    $default_attributes = array( 'show_title' => false );
	    $attributes = shortcode_atts( $default_attributes, $attributes );
	    $show_title = $attributes['show_title'];

	    // Check if the user just registered
		$attributes['registered'] = isset( $_REQUEST['registered'] );
	 
	    if ( is_user_logged_in() ) {
	        return __( 'You are already signed in.', 'personalize-login' );
	    }
	     
	    // Pass the redirect parameter to the WordPress login functionality: by default,
	    // don't specify a redirect, but if a valid redirect URL has been passed as
	    // request parameter, use it.
	    $attributes['redirect'] = '';
	    if ( isset( $_REQUEST['redirect_to'] ) ) {
	        $attributes['redirect'] = wp_validate_redirect( $_REQUEST['redirect_to'], $attributes['redirect'] );
	    }

	    // Error messages
		$errors = array();
		if ( isset( $_REQUEST['login'] ) ) {
		    $error_codes = explode( ',', $_REQUEST['login'] );
		 
		    foreach ( $error_codes as $code ) {
		        $errors []= $this->get_error_message( $code );
		    }
		}
		$attributes['errors'] = $errors;

		// Check if user just logged out
		$attributes['logged_out'] = isset( $_REQUEST['logged_out'] ) && $_REQUEST['logged_out'] == true;
	     
	    // Render the login form using an external template
	    return $this->get_template_html( 'login_form', $attributes );
	}

	/**
	 * A shortcode for rendering the new user registration form.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_register_form( $attributes, $content = null ) {
	    // Parse shortcode attributes
	    $default_attributes = array( 'show_title' => false );
	    $attributes = shortcode_atts( $default_attributes, $attributes );
	 	
	 	// Retrieve possible errors from request parameters
		$attributes['errors'] = array();
		if ( isset( $_REQUEST['register-errors'] ) ) {
		    $error_codes = explode( ',', $_REQUEST['register-errors'] );
		 
		    foreach ( $error_codes as $error_code ) {
		        $attributes['errors'] []= $this->get_error_message( $error_code );
		    }
		}

	    if ( is_user_logged_in() ) {
	        return __( 'You are already signed in.', 'personalize-login' );
	    } elseif ( ! get_option( 'users_can_register' ) ) {
	        return __( 'Registering new users is currently not allowed.', 'personalize-login' );
	    } else {
	        return $this->get_template_html( 'register_form', $attributes );
	    }
	}

	/**
	 * Renders the contents of the given template to a string and returns it.
	 *
	 * @param string $template_name The name of the template to render (without .php)
	 * @param array  $attributes    The PHP variables for the template
	 *
	 * @return string               The contents of the template.
	 */
	private function get_template_html( $template_name, $attributes = null ) {
	    if ( ! $attributes ) {
	        $attributes = array();
	    }
	 
	    ob_start();
	 
	    do_action( 'personalize_login_before_' . $template_name );
	 
	    require( 'templates/' . $template_name . '.php');
	 
	    do_action( 'personalize_login_after_' . $template_name );
	 
	    $html = ob_get_contents();
	    ob_end_clean();
	 
	    return $html;
	}

	 /**
	 * Plugin activation hook.
	 *
	 * Creates all WordPress pages needed by the plugin.
	 */
	public static function plugin_activated() {
	    // Information needed for creating the plugin's pages
	    $page_definitions = array(
	        'member-login' => array(
	            'title' => __( 'Sign in to your account to continue' ),
	            'content' => '[custom-login-form]'
	        ),
	        'member-account' => array(
	            'title' => __( 'Your Account' ),
	            'content' => '[account-info]'
	        ),
			'member-register' => array(
		        'title' => __( 'Register', 'personalize-login' ),
		        'content' => '[custom-register-form]'
		    ),
	    );
	 
	    foreach ( $page_definitions as $slug => $page ) {
	        // Check that the page doesn't exist already
	        $query = new WP_Query( 'pagename=' . $slug );
	        if ( ! $query->have_posts() ) {
	            // Add the page using the data from the array above
	            wp_insert_post(
	                array(
	                    'post_content'   => $page['content'],
	                    'post_name'      => $slug,
	                    'post_title'     => $page['title'],
	                    'post_status'    => 'publish',
	                    'post_type'      => 'page',
	                    'ping_status'    => 'closed',
	                    'comment_status' => 'closed',
	                )
	            );
	        }
	    }
	     
	}

	/**
	 * Redirect the user to the custom login page instead of wp-login.php.
	 */
	function redirect_to_custom_login() {
	    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
	        $redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : null;
	     
	        if ( is_user_logged_in() ) {
	            $this->redirect_logged_in_user( $redirect_to );
	            exit;
	        }
	 
	        // The rest are redirected to the login page
	        $login_url = home_url( 'member-login' );
	        if ( ! empty( $redirect_to ) ) {
	            $login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
	        }
	 
	        wp_redirect( $login_url );
	        exit;
	    }
	}

	/**
	 * Redirects the user to the custom registration page instead
	 * of wp-login.php?action=register.
	 */
	public function redirect_to_custom_register() {
	    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
	        if ( is_user_logged_in() ) {
	            $this->redirect_logged_in_user();
	        } else {
	            wp_redirect( home_url( 'member-register' ) );
	        }
	        exit;
	    }
	}
	/**
	 * Redirects the user to the correct page depending on whether he / she
	 * is an admin or not.
	 *
	 * @param string $redirect_to   An optional redirect_to URL for admin users
	 */
	private function redirect_logged_in_user( $redirect_to = null ) {
	    $user = wp_get_current_user();
	    if ( user_can( $user, 'manage_options' ) ) {
	        if ( $redirect_to ) {
	            wp_safe_redirect( $redirect_to );
	        } else {
	            wp_redirect( admin_url() );
	        }
	    } else {
	        wp_redirect( home_url( 'member-account' ) );
	    }
	}

	/**
	 * Redirect the user after authentication if there were any errors.
	 *
	 * @param Wp_User|Wp_Error  $user       The signed in user, or the errors that have occurred during login.
	 * @param string            $username   The user name used to log in.
	 * @param string            $password   The password used to log in.
	 *
	 * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
	 */
	function maybe_redirect_at_authenticate( $user, $username, $password ) {
	    // Check if the earlier authenticate filter (most likely, 
	    // the default WordPress authentication) functions have found errors
	    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	        if ( is_wp_error( $user ) ) {
	            $error_codes = join( ',', $user->get_error_codes() );
	 
	            $login_url = home_url( 'member-login' );
	            $login_url = add_query_arg( 'login', $error_codes, $login_url );
	 
	            wp_redirect( $login_url );
	            exit;
	        }
	    }
	 
	    return $user;
	}

	/**
	 * Finds and returns a matching error message for the given error code.
	 *
	 * @param string $error_code    The error code to look up.
	 *
	 * @return string               An error message.
	 */
	private function get_error_message( $error_code ) {
	    switch ( $error_code ) {
	        case 'empty_username':
	            return __( 'You do have an email address, right?', 'personalize-login' );
	 
	        case 'empty_password':
	            return __( 'You need to enter a password to login.', 'personalize-login' );
	 
	        case 'invalid_username':
	            return __(
	                "We don't have any users with that email address. Maybe you used a different one when signing up?",
	                'personalize-login'
	            );
	 
	        case 'incorrect_password':
	            $err = __(
	                "The password you entered wasn't quite right. <a href='%s'>Did you forget your password</a>?",
	                'personalize-login'
	            );
	            return sprintf( $err, wp_lostpassword_url() );
	 		// Registration errors
			 
			case 'email':
			    return __( 'The email address you entered is not valid.', 'personalize-login' );
			 
			case 'email_exists':
			    return __( 'An account exists with this email address.', 'personalize-login' );
			 
			case 'closed':
			    return __( 'Registering new users is currently not allowed.', 'personalize-login' );
	        default:
	            break;
	    }
	     
	    return __( 'An unknown error occurred. Please try again later.', 'personalize-login' );
	}

	/**
	 * Redirect to custom login page after the user has been logged out.
	 */
	public function redirect_after_logout() {
	    $redirect_url = home_url( 'member-login?logged_out=true' );
	    wp_safe_redirect( $redirect_url );
	    exit;
	}

	/**
	 * Returns the URL to which the user should be redirected after the (successful) login.
	 *
	 * @param string           $redirect_to           The redirect destination URL.
	 * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
	 * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
	 *
	 * @return string Redirect URL
	 */
	public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
	    $redirect_url = home_url();
	 
	    if ( ! isset( $user->ID ) ) {
	        return $redirect_url;
	    }
	 
	    if ( user_can( $user, 'manage_options' ) ) {
	        // Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
	        if ( $requested_redirect_to == '' ) {
	            $redirect_url = admin_url();
	        } else {
	            $redirect_url = $requested_redirect_to;
	        }
	    } else {
	        // Non-admin users always go to their account page after login
	        $redirect_url = home_url( 'member-account' );
	    }
	 
	    return wp_validate_redirect( $redirect_url, home_url() );
	}

	/**
	 * Validates and then completes the new user signup process if all went well.
	 *
	 * @param string $email         The new user's email address
	 * @param string $first_name    The new user's first name
	 * @param string $last_name     The new user's last name
	 *
	 * @return int|WP_Error         The id of the user that was created, or error if failed.
	 */
	private function register_user( $email, $first_name, $last_name ) {
	    $errors = new WP_Error();
	 
	    // Email address is used as both username and email. It is also the only
	    // parameter we need to validate
	    if ( ! is_email( $email ) ) {
	        $errors->add( 'email', $this->get_error_message( 'email' ) );
	        return $errors;
	    }
	 
	    if ( username_exists( $email ) || email_exists( $email ) ) {
	        $errors->add( 'email_exists', $this->get_error_message( 'email_exists') );
	        return $errors;
	    }
	 
	    // Generate the password so that the subscriber will have to check email...
	    $password = wp_generate_password( 12, false );
	 
	    $user_data = array(
	        'user_login'    => $email,
	        'user_email'    => $email,
	        'user_pass'     => $password,
	        'first_name'    => $first_name,
	        'last_name'     => $last_name,
	        'nickname'      => $first_name,
	    );
	 
	    $user_id = wp_insert_user( $user_data );
	    wp_new_user_notification( $user_id, $password );
	 
	    return $user_id;
	}

	/**
	 * Handles the registration of a new user.
	 *
	 * Used through the action hook "login_form_register" activated on wp-login.php
	 * when accessed through the registration action.
	 */
	public function do_register_user() {
	    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
	        $redirect_url = home_url( 'member-register' );
	 
	        if ( ! get_option( 'users_can_register' ) ) {
	            // Registration closed, display error
	            $redirect_url = add_query_arg( 'register-errors', 'closed', $redirect_url );
	        } else {
	            $email = $_POST['email'];
	            $first_name = sanitize_text_field( $_POST['first_name'] );
	            $last_name = sanitize_text_field( $_POST['last_name'] );
	 
	            $result = $this->register_user( $email, $first_name, $last_name );
	 
	            if ( is_wp_error( $result ) ) {
	                // Parse errors into a string and append as parameter to redirect
	                $errors = join( ',', $result->get_error_codes() );
	                $redirect_url = add_query_arg( 'register-errors', $errors, $redirect_url );
	            } else {
	                // Success, redirect to login page.
	                $redirect_url = home_url( 'member-login' );
	                $redirect_url = add_query_arg( 'registered', $email, $redirect_url );
	            }
	        }
	 
	        wp_redirect( $redirect_url );
	        exit;
	    }
	}
}

// Initialize the plugin
$personalize_login_pages_plugin = new Personalize_Login_Plugin();

// Create the custom pages at plugin activation
register_activation_hook( __FILE__, array( 'Personalize_Login_Plugin', 'plugin_activated' ) );