<div class="post-item">
    <li class="professor-card__list-item">
        <a class="professor-card" href="<?php echo esc_url(get_the_permalink()); ?>">
            <img class="professor-card__image" src="<?php esc_url(the_post_thumbnail_url('professorLandscape')); ?>" />
            <span class="professor-card__name">
                <?php echo esc_html(get_the_title()); ?>
            </span>
        </a>
    </li>
</div>