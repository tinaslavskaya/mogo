<?php

 function mogo_print($arg) {
  echo '<pre>'; 
  		print_r($arg); 
  echo '</pre>';
 }

function mogo_scripts() {
	wp_enqueue_style('styles', get_template_directory_uri() . '/styles/main_global.css', false, '', 'all');
	wp_enqueue_style('style-my', get_template_directory_uri() . '/styles/my.css', false, '', 'all');

	// wp_enqueue_script('jq', '/"https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"');

	wp_enqueue_script('jq', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js');
	wp_enqueue_script('jq2', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js');
	wp_enqueue_script('loader', get_template_directory_uri() .'/js/font-loader.js');
	wp_enqueue_script('all', get_template_directory_uri() .'/js/all.js');
	wp_enqueue_script('main', get_template_directory_uri() .'/js/main.js');
	wp_enqueue_script('my', get_template_directory_uri() . '/js/my.js');
}
add_action('wp_enqueue_scripts', 'mogo_scripts');


function mogo_register_nav_menu( ) {
	load_theme_textdomain('mogo',  get_template_directory() . '/languages');
	register_nav_menus( array(
	 	//'header_menu' => 'Header menu',
	 	'theme_location' => 'menu'
	));
}

add_action( 'after_setup_theme', 'mogo_register_nav_menu' );


require_once get_template_directory() . '/Mogo_Header_Menu.php';

// Add block patterns
//require_once get_template_directory() . '/inc/block-patterns.php';


function mogo_setup() {

	//настройка изображения фона (Фоновое изображение)
	$args = array(
		'default-color' => '9966cc',
		'default-image' => '%1$s/img/what-bg.jpg',
		'default-repeat' => 'no-repeat',

	);

	add_theme_support( 'custom-background', $args );

	//-----------

	//logo
	// add_theme_support( 'custom-logo', array(
	//     'height' => 50,
	//     'width'  => 100,
	// ) );

	//thumbnails
	//add_theme_support('post-thumbnails');

}	

add_action( 'after_setup_theme', 'mogo_setup' );


//Вывести собственный логотип
function mogo_prefix_the_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}


//Изображение заголовка (Изображение block header) && Цвет текста заголовка
function mogo_custom_header_setup() {
		add_theme_support( 'custom-header', array(
		    'height' => '1000',
		    'width'  => '1920',
		    'default-image' => get_template_directory_uri() . '/img/abstract-background.jpg',
		    'header-text'  => true,
		    'default-text-color'     => '#000000',
		) );
}

add_action( 'after_setup_theme', 'mogo_custom_header_setup' );



function mogo_customize_register( $wp_customize ) {
   //Все наши секции, настройки и элементы управления будут добавлены здесь

	$wp_customize->add_setting( 'header_link_textcolor' , array(
	    'default'     => '#ffffff',
	    'transport'   => 'refresh',
	) );


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_textcolor', array(
		'label'        =>  __( 'Header link color', 'mogo' ),
		'section'    => 'colors',
		'settings'   => 'header_link_textcolor',
	) ) );

//---------------------------

	$wp_customize->add_setting( 'link_textcolor' , array(
	    'default'     => '#333333',
	    'transport'   => 'refresh',
	) );


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_textcolor', array(
		'label'        => __( 'Links color', 'mogo' ),
		'section'    => 'colors',
		'settings'   => 'link_textcolor',
	) ) );
	
}

//add_action( 'customize_register', 'mogo_customize_register' );



function mogo_customize_css()
{
    ?>
         <style type="text/css">
             a.header_menu_link { color:<?php echo get_theme_mod('header_link_textcolor'); ?> !important }
         </style>

         <style type="text/css">
             a { color:<?php echo get_theme_mod('link_textcolor'); ?> !important }
         </style>
    <?php
}

//add_action( 'wp_head', 'mogo_customize_css');


//Services
add_action('init', 'mogo_codex_service_init');

function mogo_codex_service_init() {
	$labels = array(
		'name' 					=> _x( 'Services', 'Post type general name', 'mogo' ),
		'singular_name'         => _x( 'Service', 'Post type singular name', 'mogo' ),
        'menu_name'             => _x( 'Services', 'Admin Menu text', 'mogo' ),
        'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'mogo' ),
        'add_new'               => __( 'Add New Service', 'mogo' ),
		'new_item'              => __( 'New Service', 'mogo' ),
		'edit_item'             => __( 'Edit Service', 'mogo' ),
		'view_item'             => __( 'View Service', 'mogo' ),
		'view_items'			=> __( 'View Services', 'mogo' ),
		'search_items'			=> __( 'Search Service', 'mogo' ),
		'not_found'				=> __( 'No Service found', 'mogo' ),
        'all_items'             => __( 'All Services', 'mogo' ),
        'item_published'		=> __( 'Service published', 'mogo' ),
        'item_updated'          => __( 'Service updated', 'mogo' ),
        'item_trashed'			=> __( 'Service trashed', 'mogo' ),
        'item_link'				=> __( 'Service Link', 'mogo' ),
        'item_link_description' => __( 'A link to a Service', 'mogo' ),
	);

	$args = array (
		'label'  			 => 'service',
		'labels'			 => $labels,
		'public'			 => true,
		'menu_icon' 		 => 'dashicons-clock',
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services' ),
		'supports'           => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail', 'post-formats'),
		'show_in_rest' 		 => true
	);
	add_theme_support( 'post-thumbnails' );
	register_post_type( 'service', $args );
}

//Team
add_action('init', 'mogo_team_codex_service_init');
function mogo_team_codex_service_init() {
	$labels = array(
		'name' 					=> _x( 'Team', 'Post type general name', 'mogo' ),
		'singular_name'         => _x( 'Team', 'Post type singular name', 'mogo' ),
        'menu_name'             => _x( 'Team', 'Admin Menu text', 'mogo' ),
        'name_admin_bar'        => _x( 'Team', 'Add New on Toolbar', 'mogo' ),
        'add_new'               => __( 'Add New Team', 'mogo' ),
		'new_item'              => __( 'New Team', 'mogo' ),
		'edit_item'             => __( 'Edit Team', 'mogo' ),
		'view_item'             => __( 'View Team', 'mogo' ),
		'view_items'			=> __( 'View Team', 'mogo' ),
		'search_items'			=> __( 'Search Team', 'mogo' ),
		'not_found'				=> __( 'No Team found', 'mogo' ),
        'all_items'             => __( 'All Team', 'mogo' ),
        'item_published'		=> __( 'Team published', 'mogo' ),
        'item_updated'          => __( 'Team updated', 'mogo' ),
        'item_trashed'			=> __( 'Team trashed', 'mogo' ),
        'item_link'				=> __( 'Team Link', 'mogo' ),
        'item_link_description' => __( 'A link to a Team', 'mogo' ),
	);

	$args = array (
		'label'  			 => 'team',
		'labels'			 => $labels,
		'public'			 => true,
		'menu_icon' 		 => 'dashicons-groups',
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'team' ),
		'supports'           => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail', 'post-formats'),
		'show_in_rest' 		 => true
	);
	add_theme_support( 'post-thumbnails', array('team') );
	register_post_type( 'team', $args );
}

//Testimonials
add_action('init', 'mogo_testimonials_codex_service_init');
function mogo_testimonials_codex_service_init() {
	$labels = array(
		'name' 					=> _x( 'Testimonials', 'Post type general name', 'mogo' ),
		'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'mogo' ),
        'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'mogo' ),
        'name_admin_bar'        => _x( 'Testimonials', 'Add New on Toolbar', 'mogo' ),
        'add_new'               => __( 'Add New Testimonial', 'mogo' ),
		'new_item'              => __( 'New Testimonial', 'mogo' ),
		'edit_item'             => __( 'Edit Testimonial', 'mogo' ),
		'view_item'             => __( 'View Testimonial', 'mogo' ),
		'view_items'			=> __( 'View Testimonials', 'mogo' ),
		'search_items'			=> __( 'Search Testimonials', 'mogo' ),
		'not_found'				=> __( 'No Testimonials found', 'mogo' ),
        'all_items'             => __( 'All Testimonials', 'mogo' ),
        'item_published'		=> __( 'Testimonial published', 'mogo' ),
        'item_updated'          => __( 'Testimonial updated', 'mogo' ),
        'item_trashed'			=> __( 'Testimonial trashed', 'mogo' ),
        'item_link'				=> __( 'Testimonial Link', 'mogo' ),
        'item_link_description' => __( 'A link to a Testimonial', 'mogo' ),
	);

	$args = array (
		'label'  			 => 'testimonials',
		'labels'			 => $labels,
		'public'			 => true,
		'menu_icon' 		 => 'dashicons-buddicons-groups',
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonials' ),
		'supports'           => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail', 'post-formats'),
		'show_in_rest' 		 => true
	);
	add_theme_support( 'post-thumbnails', array('testimonials') );
	register_post_type( 'testimonials', $args );
}


