<?php
get_header();

while (have_posts()) {
    the_post();
    pageBanner();
?>
    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo esc_url(get_post_type_archive_link('campus')); ?>"><i class="fa fa-home" aria-hidden="true"></i>
                    Tất cả chi nhánh</a> <span class="metabox__main">
                    <?php esc_html(the_title()); ?>
                </span>
            </p>
        </div>
        <div class="generic-content"> <?php esc_html(the_content()); ?> </div>

        <div class="acf-map" data-zoom="14">
            <?php
            $mapLocation = get_field('map_location');
            if ($mapLocation) { ?>
                <div class="marker" data-lat="<?php echo esc_attr($mapLocation['lat']); ?>" data-lng="<?php echo esc_attr($mapLocation['lng']); ?>">
                    <h3><?php echo esc_html(get_the_title()); ?></h3>
                    <?php echo esc_html($mapLocation['address']); ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

<?php
}

get_footer();
?>