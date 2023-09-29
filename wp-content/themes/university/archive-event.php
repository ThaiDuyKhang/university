<?php 
get_header(); 
pageBanner(array(
    'title'=> 'Events',
    'subtitle'=> 'All events here'
));
?>
<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post(); 
        get_template_part('template-parts/content', 'event');
    }
    echo paginate_links();
    ?>
    <hr class="section-break"/>
    <p>Tìm kiếm các sự kiện đã diễn ra tại <a href="<?php echo esc_url(site_url('/past-events')); ?>">Past Events</a></p>
</div>

<?php get_footer(); ?>