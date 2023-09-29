<?php
get_header();
pageBanner(array(
    'title' => 'Campuses',
    'subtitle' => 'All campuses here',
));
?>
<div class="container container--narrow page-section">
    <div class="acf-map" data-zoom="14">
        <?php
        while (have_posts()) {
            the_post(); ?>
            <?php
            // esc_html(get_the_title());
            $mapLocation = get_field('map_location');
            if ($mapLocation) { ?>
                <div class="marker" data-lat="<?php echo esc_attr($mapLocation['lat']); ?>" data-lng="<?php echo esc_attr($mapLocation['lng']); ?>">
                    <h3><a href="<?php esc_url(the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
                    <?php echo esc_html($mapLocation['address']); ?>
                </div>
            <?php
            }
            ?>
        <?php
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>