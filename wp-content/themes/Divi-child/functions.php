<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION
/**
 * Extend Recent Posts Widget 
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

	function widget($args, $instance) {
	
		extract( $args );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
				
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;
					
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if( $r->have_posts() ) :
			
			//echo $before_widget;
			echo '<div class="sot-recent-post">';
			if( $title ) echo '<h2> '.$title.' </h2>';//$before_title . $title . $after_title; ?>
			
				<?php while( $r->have_posts() ) : $r->the_post(); ?>				
				<div class="recent-post-inner">
				    <span class="date"><?php the_time( 'd F Y'); ?></span>
				    <h3 class="title"><?php the_title(); ?></h3>
				    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> Read More </a>
				</div>  
				<?php endwhile; ?>
			
			 
			<?php
			//echo $after_widget;
		    echo '</div>';
		wp_reset_postdata();
		
		endif;
	}
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');
add_filter( 'widget_tag_cloud_args', 'all_tag_cloud_widget_parameters' );
function all_tag_cloud_widget_parameters() {
    $args = array(
        'smallest' => 12, 
        'largest' => 18, 
        'unit' => 'pt', 
        'number' => 10,
        'format' => 'flat', 
        'separator' => "\n", 
        'orderby' => 'name', 
        'order' => 'ASC',
        'exclude' => '', 
        'include' => '', 
        'link' => 'view', 
        'taxonomy' => $current_taxonomy, 
        'post_type' => '', 
        'echo' => false
    );
    return $args;
}
