<?php

/**
 * Renders the contents of the given template to a string and returns it.
 *
 * @param string $template_name The name of the template to render (without .php)
 * @param array  $attributes    The PHP variables for the template
 *
 * @return string               The contents of the template.
 */
function get_pages_template( $template_name, $attributes = null ) {
    if ( ! $attributes ) {
        $attributes = array();
    }
 
    ob_start();
 
    do_action( 'pbibot_before_' . $template_name );
 
    require( 'pages/' . $template_name . '.php');
 
    do_action( 'pbibot_after_' . $template_name );
 
    $html = ob_get_contents();
    ob_end_clean();
 
    return $html;
}

function render_dashboard(){
    if ( is_user_logged_in() ) {
        return get_pages_template('dashboard');
    } else{
        wp_redirect(wp_login_url());
        exit;
    }
}


add_shortcode( 'custom-dashboard', 'render_dashboard' );

/**
* Plugin activation hook.
*
* Creates all WordPress pages needed by the plugin.
*/
function theme_activated() {
    // Information needed for creating the plugin's pages
    $page_definitions = array(
        'dashboard' => array(
            'title' => __( 'Dashboard', 'pbibot' ),
            'content' => '[custom-dashboard]'
        )
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
// Create the custom pages at plugin activation
add_action( 'after_setup_theme', 'theme_activated' );