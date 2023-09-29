<?php 
get_header(); 
pageBanner(array(
    'title'=> 'Programs',
    'subtitle'=> 'All programs here'
));
?>

<div class="container container--narrow page-section">
    <ul class="link-list min-list">
        <?php
        while (have_posts()) {
            the_post(); ?>
            <li><a href="<?php echo esc_url(the_permalink()) ?>"><?php echo esc_html(the_title()); ?></a></li>

        <?php
        }
        echo paginate_links();
        ?>
    </ul>
</div>

<?php get_footer(); ?>