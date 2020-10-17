<?php


function event_main () {
    wp_enqueue_style('event_style', get_theme_file_uri('/style.css'));
    wp_enqueue_style('event_slider_json', '//www.jssor.com');
    wp_enqueue_script('event_new_overlay', get_theme_file_uri('/js/NewsOverlay.js'), NULL, microtime(), true);
    wp_enqueue_script('event_subscribe', get_theme_file_uri('/js/Subscribe.js'), NULL, microtime(), true);
    wp_enqueue_script('event_sidebar', get_theme_file_uri('/js/Sidebar.js'), NULL, microtime(), true);
    wp_enqueue_script('event_count_down', get_theme_file_uri('/js/CountDown.js'), NULL, microtime(), true);
    wp_enqueue_script('event_slider', get_theme_file_uri('/js/Slider.js'), NULL, microtime(), true);
    wp_enqueue_script('jquery_slider', get_theme_file_uri('/js/jssor.slider-22.2.16.mini.js'), NULL, microtime(), true);
    wp_enqueue_script('slider_music', get_theme_file_uri('/js/SliderMusic.js'), NULL, microtime(), true);
	wp_enqueue_script('jquery');
    wp_localize_script('event_new_overlay', 'eventData', [
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ]);
}

add_action('wp_enqueue_scripts', 'event_main');

add_action('init', 'event_post_type');

function event_post_type(){
    register_post_type('new',[
        'show_in_rest' => true,
        'show_ui' => true,
        'supports' => ['title', 'editor'],
        'public' => true,
        'labels' => [
            'name' => 'News',
            'edit_item' => 'Edit New',
            'add_item' => 'Add New',
            'all_items' => 'All News',
            'singular_name' => 'New'
        ],
        'menu_icon' => 'dashicons-text-page',
    ]);
    register_post_type('subscriber',[
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
        'public' => true,
        'show_ui' => true,
        'labels' => [
            'name' => 'Subscriber',
            'edit_item' => 'Edit Subscriber',
            'add_item' => 'Add Subscriber',
            'all_items' => 'All Subscribers',
        ],
        'menu_icon' => 'dashicons-email'
    ]);
    register_post_type('event-date',[
        'show_in_rest' => true,
        'show_ui' => true,
        'supports' => ['title'],
        'public' => true,
        'labels' => [
            'name' => 'Event Dates',
            'edit_item' => 'Edit Event Date',
            'add_item' => 'Add Event Date',
            'all_items' => 'All Event Dates',
            'singular_name' => 'Event Date'
        ],
        'menu_icon' => 'dashicons-calendar-alt',
    ]);
    register_post_type('event-place',[
        'show_in_rest' => true,
        'show_ui' => true,
        'supports' => ['title'],
        'public' => true,
        'labels' => [
            'name' => 'Event Places',
            'edit_item' => 'Edit Event Place',
            'add_item' => 'Add Event Place',
            'all_items' => 'All Event Places',
            'singular_name' => 'Event Place'
        ],
        'menu_icon' => 'dashicons-location',
    ]);
    register_post_type('slider',[
        'show_in_rest' => true,
        'show_ui' => true,
        'supports' => ['title', 'thumbnail'],
        'public' => true,
        'labels' => [
            'name' => 'Event Sliders',
            'edit_item' => 'Edit Event Slider',
            'add_item' => 'Add Event Slider',
            'all_items' => 'All Event Sliders',
            'singular_name' => 'Event Slider'
        ],
        'menu_icon' => 'dashicons-images-alt',
    ]);
}

add_action('after_setup_theme', 'event_menu');

function event_menu(){
    register_nav_menu('header_menu', 'Header Menu');
    register_nav_menu('social_media', 'Social Media Button');
    register_nav_menu('buy_ticket', 'Buy Ticket Button');
    register_nav_menu('sponsor', 'Sponsor Menu');
    add_image_size('SlideShow', 300, 600, true );
    add_theme_support('post-thumbnails');
}

add_action('rest_api_init', 'event_api');

function event_api(){
    register_rest_field('new', 'month', [
        'get_callback' => function(){
            return get_the_time('M');
        }
    ]);
    register_rest_field('new', 'day', [
        'get_callback' => function(){
            return get_the_time('d');
        }
    ]);

    register_rest_field('event-date', 'date_event', [
        'get_callback' => function(){
            return get_field('event_date');
        }
    ]);

    register_rest_field('slider', 'slider_media', [
        'get_callback' => function(){
            return get_field('slider_music');
        }
    ]);

    register_rest_route('event/v1', 'event-date-place', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'event_filter',
    ]);
}

function event_filter(){
    $today = date('Y-m-d H:i:s');
    $upComingEvent = new WP_Query([
        'post_type' => 'event-date',
        'posts_per_page' => 1,
        'meta_key' => 'event_date',
        'orderby' => 'event_date',
        'order' => 'ASC',
        'meta_query' => [
            [
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            ]
        ]
    ]);

    $results = [];

    while($upComingEvent->have_posts()){
        $upComingEvent->the_post();
        array_push($results, [
            'ID' => get_the_ID(),
        ]);
    }

    return $results;
}

add_filter('login_enqueue_scripts', 'event_login');

function event_login(){?>
    <style type="text/css">
        body.login div#login h1 a{
            background-image: url(<?php echo get_theme_file_uri('/img/logo.png');?>);
        }
    </style>
<?php }

add_filter('login_headerurl', 'event_link');

function event_link(){
    return esc_url(site_url('/'));
}

add_action('widgets_init', 'event_widget_menu');

function event_widget_menu(){
    register_sidebar([
		'name' => esc_html('sponsor', 'sponsor'),
		'id' => 'sponsor',
    ]);

    register_sidebar(([
        'name' => esc_html('social_media', 'social_media'),
        'id' => 'social_media'
    ]));
}

?>