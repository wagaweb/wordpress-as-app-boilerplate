<?php
class Bootstrap_Page_Menu extends Walker_Page {
	/**
	 * @see Walker::start_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}
	/**
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page Page data object.
	 * @param int $depth Depth of page. Used for padding.
	 * @param int $current_page Page ID.
	 * @param array $args
	 */
	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth ) {
			$indent = str_repeat( "\t", $depth );
		} else {
			$indent = '';
		}
		$css_class = array( 'page_item', 'page-item-' . $page->ID );
		$has_childen = (bool) isset( $args['pages_with_children'][ $page->ID ] );
		if ( $has_childen ) {
			$css_class[] = 'page_item_has_children';
		}
		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );
			if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
				$css_class[] = 'active current_page_ancestor';
			}
			if ( $page->ID == $current_page ) {
				$css_class[] = 'active current_page_item';
			} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
				$css_class[] = 'active current_page_parent';
			}
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'active current_page_parent';
		}
		if($has_childen && $depth > 0) $css_class[] = 'dropdown-submenu';
		$css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		if ( '' === $page->post_title ) {
			$page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
		}
		$args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
		$args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];
		if($has_childen && $depth == 0) $args['link_after'].= ' <b class="caret"></b>';
		$output .= $indent . sprintf(
				'<li class="%s"><a href="%s"%s>%s%s%s</a>',
				$css_classes,
				get_permalink( $page->ID ),
				$has_childen ? ' class="dropdown-toggle" data-toggle="dropdown" data-target="#"' : '',
				$args['link_before'],
				get_the_title($page->ID), // apply_filters( 'the_title', get_field('menu', $page->ID), $page->ID ),
				$args['link_after']
			);
		if ( ! empty( $args['show_date'] ) ) {
			if ( 'modified' == $args['show_date'] ) {
				$time = $page->post_modified;
			} else {
				$time = $page->post_date;
			}
			$date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
			$output .= " " . mysql2date( $date_format, $time );
		}
	}
}