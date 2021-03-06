<?php
/**
 * Template tags
 *
 * This file holds template tags for the theme. Template tags are PHP functions
 * meant for use within theme templates.
 *
 * @package amply
 */

/**
 * [ Table of contents]
 *
 * # amply_is_amp()
 * # amply_using_amp_live_list_comments()
 * # amply_add_amp_live_list_pagination_attribute()
 * # amply_index_header()
 * # amply_posted_on()
 * # amply_posted_by()
 * # amply_entry_footer()
 * # amply_post_categories()
 * # amply_post_tags()
 * # amply_comments_link()
 * # amply_edit_post_link()
 * # amply_post_thumbnail()
 * # amply_attachment_in()
 * # amply_the_attachment_navigation()
 * # amply_excerpt()
 * # amply_the_comments()
 * # amply_filter_add_amp_live_list_pagination_attribute()
 */

/**
 * Determine whether this is an AMP response.
 *
 * Note that this must only be called after the parse_query action.
 *
 * @link https://github.com/Automattic/amp-wp
 * @return bool Is AMP endpoint (and AMP plugin is active).
 */
function amply_is_amp() {
	return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
}

/**
 * Determine whether amp-live-list should be used for the comment list.
 *
 * @return bool Whether to use amp-live-list.
 */
function amply_using_amp_live_list_comments() {
	if ( ! amply_is_amp() ) {
		return false;
	}
	$amp_theme_support = get_theme_support( 'amp' );
	return ! empty( $amp_theme_support[0]['comments_live_list'] );
}

/**
 * Add pagination reference point attribute for amp-live-list when theme supports AMP.
 *
 * This is used by the navigation_markup_template filter in the comments template.
 *
 * @link https://www.ampproject.org/docs/reference/components/amp-live-list#pagination
 *
 * @param string $markup Navigation markup.
 * @return string Markup.
 */
function amply_add_amp_live_list_pagination_attribute( $markup ) {
	return preg_replace( '/(\s*<[a-z0-9_-]+)/i', '$1 pagination ', $markup, 1 );
}

/**
 * Prints the header of the current displayed page based on its contents.
 */
function amply_index_header() {
	if ( is_home() && ! is_front_page() ) {
		?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>
		<?php
	} elseif ( is_search() ) {
		?>
		<header class="page-header">
			<h1 class="page-title">
			<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'amply' ), '<span>' . get_search_query() . '</span>' );
			?>
			</h1>
		</header><!-- .page-header -->
		<?php
	} elseif ( is_archive() ) {
		?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->
		<?php
	}
}

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function amply_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'amply' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . ' </span>'; // WPCS: XSS OK.

}

/**
 * Prints HTML with meta information for the current author.
 */
function amply_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'amply' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . ' </span>'; // WPCS: XSS OK.
}

/**
 * Prints HTML with the comment count for the current post.
 */
function amply_comment_count() {
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		echo amply_get_icon_svg( 'comment', 16 ); // WPCS: XSS OK.

		/* translators: %s: Name of current post. Only visible to screen readers. */
		comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'amply' ), get_the_title() ) );

		echo '</span>';
	}
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function amply_entry_footer() {

	// Hide author, post date, category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		// Posted by.
		amply_posted_by();

		// Posted on.
		amply_posted_on();

		/* translators: used between list items, there is a space after the comma. */
		$categories_list = get_the_category_list( __( ', ', 'amply' ) );
		if ( $categories_list ) {
			/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of categories. */
			printf(
				'<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
				amply_get_icon_svg( 'archive', 16 ),
				__( 'Posted in', 'amply' ),
				$categories_list
			); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma. */
		$tags_list = get_the_tag_list( '', __( ', ', 'amply' ) );
		if ( $tags_list ) {
			/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of tags. */
			printf(
				'<span class="tags-links">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span>',
				amply_get_icon_svg( 'tag', 16 ),
				__( 'Tags:', 'amply' ),
				$tags_list
			); // WPCS: XSS OK.
		}
	}

	// Comment count.
	if ( ! is_singular() ) {
		amply_comment_count();
	}

	// Edit post link.
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers. */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'amply' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">' . amply_get_icon_svg( 'edit', 16 ),
		'</span>'
	);
}

/**
 * Prints a link list of the current categories for the post.
 *
 * If additional post types should display categories, add them to the conditional statement at the top.
 */
function amply_post_categories() {
	// Only show categories on post types that have categories.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'amply' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'amply' ) . ' </span>', $categories_list ); // WPCS: XSS OK.
		}
	}
}

/**
 * Prints a link list of the current tags for the post.
 *
 * If additional post types should display tags, add them to the conditional statement at the top.
 */
function amply_post_tags() {
	// Only show tags on post types that have categories.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'amply' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'amply' ) . ' </span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}

/**
 * Prints comments link when comments are enabled.
 */
function amply_comments_link() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'amply' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo ' </span>';
	}
}

/**
 * Prints edit post/page link when a user with sufficient priveleges is logged in.
 */
function amply_edit_post_link() {
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'amply' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		' </span>'
	);
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function amply_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'full', array( 'class' => 'skip-lazy' ) ); ?>
		</div><!-- .post-thumbnail -->

		<?php
	else :
		?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			global $wp_query;
			if ( 0 === $wp_query->current_post ) {
				the_post_thumbnail(
					'full',
					array(
						'class' => 'skip-lazy',
						'alt'   => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
			} else {
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
			}
			?>
		</a>

		<?php
	endif; // End is_singular().
}

/**
 * Prints HTML with title and link to original post where attachment was added.
 *
 * @param object $post object.
 */
function amply_attachment_in( $post ) {
	if ( ! empty( $post->post_parent ) ) :
		$postlink = sprintf(
			/* translators: %s: original post where attachment was added. */
			esc_html_x( 'in %s', 'original post', 'amply' ),
			'<a href="' . esc_url( get_permalink( $post->post_parent ) ) . '">' . esc_html( get_the_title( $post->post_parent ) ) . '</a>'
		);

		echo '<span class="attachment-in"> ' . $postlink . ' </span>'; // WPCS: XSS OK.

	endif;

}

/**
 * Prints HTML with for navigation to previous and next attachment if available.
 */
function amply_the_attachment_navigation() {
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php echo esc_html__( 'Post navigation', 'amply' ); ?></h2>
		<div class="nav-links">
			<div class="nav-previous">
				<div class="post-navigation-sub">
					<?php echo esc_html__( 'Previous attachment:', 'amply' ); ?>
				</div>
				<?php previous_image_link( false ); ?>
			</div><!-- .nav-previous -->
			<div class="nav-next">
				<div class="post-navigation-sub">
					<?php echo esc_html__( 'Next attachment:', 'amply' ); ?>
				</div>
				<?php next_image_link( false ); ?>
			</div><!-- .nav-next -->
		</div><!-- .nav-links -->
	</nav><!-- .navigation .attachment-navigation -->
	<?php
}

/**
 * The excerpt.
 *
 * @param integer $length The excerpt lenght.
 * @return string $output The excerpt.
 */
function amply_excerpt( $length = 30 ) {
	global $post;

	// Check for custom excerpt.
	if ( has_excerpt( $post->ID ) ) {
		$output = $post->post_excerpt;
	} else {

		// Check for more tag and return content if it exists.
		if ( strpos( $post->post_content, '<!--more-->' ) ) {
			$output = apply_filters( 'the_content', get_the_content() );
		} else {
			$output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );
		}
	}

	return $output;

}

/**
 * Displays the list of comments for the current post.
 *
 * Internally this method calls `wp_list_comments()`. However, in addition to that it will render the wrapping
 * element for the list, so that must not be added manually. The method will also take care of generating the
 * necessary markup if amp-live-list should be used for comments.
 *
 * @param array $args Optional. Array of arguments. See `wp_list_comments()` documentation for a list of supported
 *                    arguments.
 */
function the_comments( array $args = array() ) {
	$args = array_merge(
		$args,
		array(
			'style'      => 'ol',
			'short_ping' => true,
		)
	);

	$amp_live_list = amply_using_amp_live_list_comments();

	if ( $amp_live_list ) {
		$comment_order     = get_option( 'comment_order' );
		$comments_per_page = get_option( 'page_comments' ) ? (int) get_option( 'comments_per_page' ) : 10000;
		$poll_inverval     = MINUTE_IN_SECONDS * 1000;

		?>
		<amp-live-list
			id="amp-live-comments-list-<?php the_ID(); ?>"
			<?php echo ( 'asc' === $comment_order ) ? ' sort="ascending" ' : ''; ?>
			data-poll-interval="<?php echo esc_attr( $poll_inverval ); ?>"
			data-max-items-per-page="<?php echo esc_attr( $comments_per_page ); ?>"
		>
		<?php

		add_filter( 'navigation_markup_template', 'amply_filter_add_amp_live_list_pagination_attribute' );
	}

	?>
	<ol class="comment-list"<?php echo $amp_live_list ? ' items' : ''; ?>>
		<?php wp_list_comments( $args ); ?>
	</ol><!-- .comment-list -->
	<?php

	the_comments_navigation();

	if ( $amp_live_list ) {
		remove_filter( 'navigation_markup_template', 'amply_filter_add_amp_live_list_pagination_attribute' );

		?>
			<div update>
				<button class="button" on="tap:amp-live-comments-list-<?php the_ID(); ?>.update"><?php esc_html_e( 'New comment(s)', 'amply' ); ?></button>
			</div>
		</amp-live-list>
		<?php
	}
}

/**
 * Adds a pagination reference point attribute for amp-live-list when theme supports AMP.
 *
 * This is used by the navigation_markup_template filter in the comments template.
 *
 * @link https://www.ampproject.org/docs/reference/components/amp-live-list#pagination
 *
 * @param string $markup Navigation markup.
 * @return string Filtered markup.
 */
function amply_filter_add_amp_live_list_pagination_attribute( string $markup ) : string {
	return preg_replace( '/(\s*<[a-z0-9_-]+)/i', '$1 pagination ', $markup, 1 );
}
