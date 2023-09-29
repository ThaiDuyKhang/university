<div class="event-summary">
    <a class="event-summary__date t-center" href="#">
        <span class="event-summary__month">
            <?php
            $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('M');
            ?>
        </span>
        <span class="event-summary__day">
            <?php
            echo $eventDate->format('d');
            ?>
        </span>
    </a>
    <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php esc_url(the_permalink());  ?>">
                <?php
                echo esc_html(get_the_title());
                ?></a></h5>
        <p style="margin-bottom:10px">
            <?php
            if (has_excerpt()) {
                echo esc_html(wp_trim_words(get_the_excerpt(), 18));
            } else {
                echo esc_html(wp_trim_words(get_the_content(), 15));
            }
            ?>
        </p>
        <a href="<?php esc_url(the_permalink()); ?>" class="nu gray">Xem thêm &raquo;</a>
    </div>
</div>