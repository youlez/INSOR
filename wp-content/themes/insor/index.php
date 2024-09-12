<?php get_header(); ?>
<?php echo get_bloginfo('name'); ?></h1>
<?php get_bloginfo('template_url') ?>
<?php get_bloginfo('url'); ?>
<?php
$args = array(
  'post_type'   => 'responsive_slider',
  'order' => 'ASC'
);
$query = get_posts($args);
get_footer();
