<?php
get_header();
while (have_posts()) : the_post();
    $post_name = get_post_field('post_name', get_post());
endwhile;
get_footer();
