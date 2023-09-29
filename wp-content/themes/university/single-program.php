<?php
get_header();

while (have_posts()) {
    the_post();
    pageBanner();
?>
    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo esc_url(get_post_type_archive_link('program')); ?>"><i class="fa fa-home" aria-hidden="true"></i>
                    All Programs</a> <span class="metabox__main">
                    <?php esc_html(the_title()); ?>
                </span>
            </p>
        </div>
        <div class="generic-content">
            <?php esc_html(the_field('main_body_content')); ?>
        </div>

        <?php

        $relatedProfessor = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'professor',
            'orderby' => 'title',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID('related_programs') . '"'
                )
            )
        ));

        if ($relatedProfessor->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">' . esc_html('Giảng viên giảng dạy') . '</h2>';
            echo '<ul class="professor-cards">';
            while ($relatedProfessor->have_posts()) {
                $relatedProfessor->the_post(); 
                get_template_part('template-parts/content','professor');
            }
            echo '</ul>';
        }
        wp_reset_postdata();

        $today = date('Ymd');
        $homePageEvents = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'event',
            'orderby' => 'meta_value',
            'meta_key' => 'event_date',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numberic'
                ),
                array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID('related_programs') . '"'
                )
            )
        ));

        if ($homePageEvents->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium"> Sự kiện ' . esc_html(get_the_title()) . ' sắp tới</h2>';

            while ($homePageEvents->have_posts()) {
                $homePageEvents->the_post();
                get_template_part('template-parts/content', 'event');
            }
        }
        wp_reset_postdata();
        $relatedCampuses = get_field('related_campus');
        if ($relatedCampuses) {
            echo '<hr class="section-break"/>';
            echo '<h2 class="headline headline--medium">Sự kiện' . get_the_title() . ' diễn ra tại địa chỉ</h2>';
            echo '<ul class="min-list link-list">';
            foreach ($relatedCampuses as $campus) { ?>
                <li><a href="<?php echo esc_url(get_the_permalink($campus)); ?>">
                        <?php echo esc_html(get_the_title($campus)); ?>
                    </a></li>
        <?php }
            echo '</ul>';
        }
        ?>
    </div>

<?php
}

get_footer();
?>