<?php
get_header();

while (have_posts()) {
    the_post();
    pageBanner();
?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo esc_url(get_post_type_archive_link('event')); ?>"><i class="fa fa-home" aria-hidden="true"></i>
                    All Events</a> <span class="metabox__main">
                    <?php esc_html(the_title()); ?>
                </span>
            </p>
        </div>
        <div class="generic-content">
            <?php esc_html(the_content()); ?>
        </div>

        <?php
        $relatedProgram = get_field('related_programs');

        if ($relatedProgram) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">' . esc_html__('Chương trình liên quan', 'evps') . '</h2>';
            echo '<ul class="link-list min-list">';
            foreach ($relatedProgram as $program) { ?>
                <li><a href="<?php echo esc_url(get_the_permalink($program)); ?>"><?php echo esc_html(get_the_title($program)); ?></a></li>
        <?php
            }
            echo '</ul>';
        };
        ?>

    </div>


<?php
}

get_footer();
?>