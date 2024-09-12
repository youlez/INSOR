<?php
include('functions/scripts.php');

add_theme_support('post-thumbnails');

function register_my_menus()
{
    register_nav_menus();
}
add_action('init', 'register_my_menus');

add_action('admin_head', 'my_custom_css');

function my_custom_css()
{
    if (is_user_logged_in()) { // check if there is a logged in user 

        $user = wp_get_current_user(); // getting & setting the current user 
        $roles = (array) $user->roles; // obtaining the role 
        if (in_array('editor', $roles, true)) {
            echo '<style>
                    #menu-tools {
                        display:none !important;
                    } 
                    #menu-settings {
                        display:none !important;
                    } 
                    #toplevel_page_heateor-sss-options{
                        display:none !important;
                    } 
                    #menu-comments{
                        display:none !important;
                    } 
                </style>';
        }
    }
}
