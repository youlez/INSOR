<?php
get_header();
while (have_posts()) : the_post();
    if (get_post_type() == "post") {
    }
endwhile;
get_footer();
