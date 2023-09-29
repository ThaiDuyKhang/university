<?php
get_header();
pageBanner(array(
    'title' => esc_html(get_the_title(get_option('page_for_posts'))),
    'subtitle' => 'All latest news '
));
?>

<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post(); 
        get_template_part('template-parts/content','post');
    }
    echo esc_url(paginate_links());
    ?>
</div>

<?php get_footer(); ?>