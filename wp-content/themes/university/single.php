<?php
get_header();
pageBanner();

while (have_posts()) {
    the_post(); ?>
    <div class="container container--narrow page-section">
        <?php $categoryParent = get_option('page_for_posts');
        if ($categoryParent) { ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo get_permalink($categoryParent) ?>"><i class="fa fa-home" aria-hidden="true"></i>
                        <?php echo get_the_title($categoryParent) ?></a> <span class="metabox__main">
                        Đăng bởi <?php the_author_posts_link() ?> ngày <?php the_time('d/m/Y') ?> trong <?php echo get_the_category_list(', ') ?>
                    </span>
                </p>
            </div>
        <?php
        }
        ?>
        <div class="generic-content">
            <?php the_content(); ?>
        </div>
    </div>

<?php
}

get_footer();
?>