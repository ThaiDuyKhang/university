<?php
get_header();

while (have_posts()) {
    the_post();
    pageBanner();
?>
    <div class="container container--narrow page-section">
        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
                    <?php esc_attr(the_post_thumbnail('professorPortrait')); ?>
                </div>
                <div class="two-thirds">
                    <?php esc_html(the_content()); ?>
                </div>
            </div>
        </div>

        <?php
        $relatedProgram = get_field('related_programs');

        if ($relatedProgram) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">' . esc_html__('Môn học giảng dạy', 'evps') . '</h2>';
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