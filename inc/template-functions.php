<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _s_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function _s_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', '_s_pingback_header' );

add_filter( 'wp_nav_menu_items', 'cody_add_search_box_to_menu', 10, 2 );
function cody_add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'menu-1' )
		$items .= '<li class="menu-item">' . get_search_form( false ) . '</li>';

    return $items;
}

add_filter( 'the_content', 'cody_search_results_hightlight' );
add_filter( 'the_title', 'cody_search_results_hightlight' );
add_filter( 'the_excerpt', 'cody_search_results_hightlight' );
function cody_search_results_hightlight( $text ){

	$colors = array( '', '#ffeb3b', '#CDDC39', '#7fdce8', '#edb5f7' );

	if ( ! is_search() || is_admin() ) return $text;

	$query_terms = get_query_var('search_terms');
	if( empty( $query_terms ) ) {
		$query_terms = (array)get_query_var( 's' );
	}

	if( empty( $query_terms ) ) {
		return $text;
	}

	$n = 0;
	foreach( $query_terms as $term ){
		$n++;

		$term = preg_quote( $term, '/' );
		$text = preg_replace_callback( "/$term/iu", function( $match ) use ( $colors, $n ){
			return '<span style="background-color: '. $colors[ $n ] .';">'. $match[0] .'</span>';
		}, $text );
	}

	return $text;
}

// Обрабатываем AJAX

// AJAX поиск по сайту
add_action( 'wp_ajax_nopriv__s_ajax_search', '_s_ajax_search' );
add_action( 'wp_ajax__s_ajax_search', '_s_ajax_search' );
function _s_ajax_search(){
	$args = array(
		'post_type'      => 'any',
		'post_status'    => 'publish',
		'order'          => 'DESC',
		'orderby'        => 'date',
		's'              => $_POST['term'],
		'posts_per_page' => 5
	);
	$query = new WP_Query( $args );
	if($query->have_posts()){
	while ($query->have_posts()) { $query->the_post();?>
<li>
	<?php if(!empty($_s_url)) {
		the_post_thumbnail('_s-mini-thumbnail');
	} else{ ?>
		<span><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-mini.gif'); ?>" alt=""></span>
	<?php } ?>
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<?php the_excerpt();?>
 </li>
<?php } }else{ ?>
	<li><a href="#">Ничего не найдено, попробуйте другой запрос</a></li>
<?php } exit;
}

add_action( 'template_redirect', 'cody_redirect_single_post' );
function cody_redirect_single_post() {
	if ( !is_search() ) return;

	global $wp_query;
	if ( $wp_query->post_count == 1 ) {
		wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
	}
}

// Скрываем заголовок "Навтигация по записям"

add_filter('navigation_markup_template', 'monster_navigation_markup_template');
function monster_navigation_markup_template() {
	return '
     <nav class="navigation %1$s" role="navigation">
         <div class="nav-links">%3$s</div>
     </nav>';
}

// ACF Options

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}
