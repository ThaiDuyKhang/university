<?php
add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch()
{
    register_rest_route('university/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults($data)
{
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'event', 'program', 'campus', 'professor'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
        'campuses' => array(),
    );

    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if (get_post_type() == 'post' or get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => esc_html(get_the_title()),
                'permalink' => esc_url(get_the_permalink()),
                'postType' => esc_html(get_post_type()),
                'authorName' => esc_html(get_the_author())
            ));
        }
        if (get_post_type() == 'professor') {
            array_push($results['professors'], array(
                'title' => esc_html(get_the_title()),
                'permalink' => esc_url(get_the_permalink()),
                'avatar' => esc_url(get_the_post_thumbnail_url(0, 'professorLandscape'))
            ));
        }
        if (get_post_type() == 'event') {
            $eventDate = new DateTime(get_field('event_date'));
            $description = null;
            if (has_excerpt()) {
                $description = esc_html(wp_trim_words(get_the_excerpt(), 13));
            } else {
                $description = esc_html(wp_trim_words(get_the_content(), 13));
            }
            array_push($results['events'], array(
                'title' => esc_html(get_the_title()),
                'permalink' => esc_url(get_the_permalink()),
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'description' => $description
            ));
        }
        if (get_post_type() == 'program') {
            $related_campuses = get_field('related_campus');

            if ($related_campuses) {
                foreach ($related_campuses as $campus) {
                    array_push( $results['campuses'], array(
                        'title' => esc_html(get_the_title($campus)),
                        'permalink' => esc_url(get_the_permalink($campus))
                    ));
                }
            }

            array_push($results['programs'], array(
                'title' => esc_html(get_the_title()),
                'permalink' => esc_url(get_the_permalink()),
                'id' => get_the_ID()
            ));
        }
        if (get_post_type() == 'campus') {
            array_push($results['campuses'], array(
                'title' => esc_html(get_the_title()),
                'permalink' => esc_url(get_the_permalink()),
            ));
        }
    }

    if ($results['programs']) {
        $programMetaQuery = array('relation' => 'OR');

        foreach ($results['programs'] as $item) {
            array_push($programMetaQuery, array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . $item['id'] . '"'
            ));
        }

        $programRelationQuery = new WP_Query(array(
            'post_type' => array('professor', 'event'),
            'meta_query' => $programMetaQuery
        ));

        while ($programRelationQuery->have_posts()) {
            $programRelationQuery->the_post();
            if (get_post_type() == 'event') {
                $eventDate = new DateTime(get_field('event_date'));
                $description = null;
                if (has_excerpt()) {
                    $description = esc_html(wp_trim_words(get_the_excerpt(), 13));
                } else {
                    $description = esc_html(wp_trim_words(get_the_content(), 13));
                }
                array_push($results['events'], array(
                    'title' => esc_html(get_the_title()),
                    'permalink' => esc_url(get_the_permalink()),
                    'month' => $eventDate->format('M'),
                    'day' => $eventDate->format('d'),
                    'description' => $description
                ));
            }

            if (get_post_type() == 'professor') {
                array_push($results['professors'], array(
                    'title' => esc_html(get_the_title()),
                    'permalink' => esc_url(get_the_permalink()),
                    'avatar' => esc_url(get_the_post_thumbnail_url(0, 'professorLandscape'))
                ));
            }
        }

        $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));
        $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));
    }


    return $results;
}
