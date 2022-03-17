<?php

require get_template_directory() . '/inc/helpers/template-tags.php';

/**
 * Theme setup.
 */
function tailpress_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tailpress' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

    add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-style.css' );
}

add_action( 'after_setup_theme', 'tailpress_setup' );

/**
 * Enqueue theme assets.
 */
function tailpress_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'tailpress', tailpress_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', tailpress_asset( 'js/app.js' ), array(), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'tailpress_enqueue_scripts' );

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function tailpress_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4 );

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3 );

/**
 * Adds style to comments
 */
function mytheme_comment($comment, $args, $depth) {


    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }

	?>

	<!-- Comment Body -->
    <<?php echo $tag ?> <?php comment_class('text-base') ?> id="comment-<?php comment_ID() ?>">

    	<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    	<?php endif; ?>
    
		<div class="comment-container">

			<!-- Comment Author -->
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment); ?>
			</div>

			<!-- Comment text -->
			<div class="comment-box">

				<!-- Comment Name and Date -->
				<div class="comment-name">
					<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
					<div class="comment-date text-slate-400">
						<?php printf( __('%1$s'), smk_get_comment_time()); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );?>
					</div>
				</div>

				<!-- Comment Text -->
				<div class="comment-text">
					<?php comment_text(); ?>
				</div>

				<!-- Comment Reply Button -->
				<div class="reply text-base text-slate-500">
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>

			</div>
		
		</div>



		<!-- Moderation -->
    	<?php if ( $comment->comment_approved == '0' ) : ?>
        	 <em class="comment-awaiting-moderation">
				 <?php _e( 'Your comment is awaiting moderation.' ); ?>
			</em>
          	<br />
    	<?php endif; ?>

		
		<?php if ( 'div' != $args['style'] ) : ?>
			</div>
		<?php endif; ?>
    	<?php
    }


	function smk_get_comment_time( $comment_id = 0 ){
		return sprintf( 
			_x( '%s', 'Human-readable time', 'text-domain' ), 
			human_time_diff( 
				get_comment_date( 'U', $comment_id ), 
				current_time( 'timestamp' ) 
			) 
		);
	}
