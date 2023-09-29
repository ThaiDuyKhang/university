<div class="post-item">
    <h2 class="headline headline--medium headline--post-title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h2>
    <div class="metabox">
        <p>Đăng bởi <?php esc_url(the_author_posts_link()); ?> ngày <?php esc_html(the_time('d/m/Y')) ?> trong <?php echo get_the_category_list(', '); ?></p>
    </div>
    <div class="generic-content">
        <?php esc_html(the_excerpt()); ?>
        <p><a class="btn btn--blue" href="<?php esc_url(the_permalink()); ?>">Xem tiếp &raquo;</a></p>
    </div>
</div>