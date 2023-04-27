<?php

wp_head();

// echo '<link rel="stylesheet" href="http://plaginator.local/wp-content/plugins/my-form/css/my-form.css"></link>';

$args = array(
    'post_type' => 'my_form',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);

$posts = new WP_Query($args);

if ($posts->have_posts()) {
    while ($posts->have_posts()) {
        $posts->the_post();
?>

        <h2><?php the_title() ?></h2>
        <p><?php the_content() ?></p>


<?php
    }
}
wp_reset_postdata();


wp_footer();

?>