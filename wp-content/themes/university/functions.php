<?php

require get_theme_file_path('/inc/search-route.php');


function university_cpt_api()
{
    register_rest_field('post', 'authorName', array(
        'get_callback' => function () {
            return esc_html(get_the_author());
        },
    ));
}

add_action('rest_api_init', 'university_cpt_api');

function pageBanner($args = NULL)
{
    if (!isset($args['title'])) {
        $args['title'] = esc_html(get_the_title());
    }
    if (!isset($args['subtitle'])) {
        $args['subtitle'] = esc_html(get_field('page_banner_subtitle'));
    }
    if (!isset($args['image'])) {
        if (get_field('page_banner_image') and !is_archive() and !is_home()) {
            $args['image'] = esc_attr(get_field('page_banner_image')['sizes']['pageBanner']);
        } else {
            $args['image'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(
            <?php
            echo esc_attr($args['image']);
            ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo sanitize_text_field($args['title']); ?></h1>
            <div class="page-banner__intro">
                <p><?php echo sanitize_text_field($args['subtitle']); ?></p>
            </div>
        </div>
    </div>
<?php
}

function evps_themes_style()
{
    // wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyBhTYhC6FJkqU8oYEFBN81WhYaUenwUu9c', null, '1.0', true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));

    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url()
    ));
}

add_action('wp_enqueue_scripts', 'evps_themes_style');

function university_features()
{
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
    register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query)
{
    $today = date('Ymd');
    if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numberic'
            )
        ));
    }

    if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if (!is_admin() and is_post_type_archive('campus') and $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }
}

add_action('pre_get_posts', 'university_adjust_queries');

function university_map_key($api)
{
    $api['key'] = "AIzaSyBhTYhC6FJkqU8oYEFBN81WhYaUenwUu9c";
    return $api;
}

add_filter('acf/fields/google_map/api', 'university_map_key');
