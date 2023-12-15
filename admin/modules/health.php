<?php

namespace Dev_Suite\Admin\Modules;

use WP_Query;

class Health {
	public static function get_posts_broken_shortcodes(): array {
		$args = array(
			//Type & Status Parameters
			'post_type'      => array( 'post', 'page' ),
			'post_status'    => 'any',

			//Pagination Parameters
			'posts_per_page' => - 1,
		);

		// In case we have a huge Database
		set_time_limit( 0 );

		$query = new WP_Query( $args );
		$posts = array();

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				ob_start();

				the_content();
				// Getting the parsed content
				// where all registered shortcodes have been replaced
				$output = ob_get_clean();

				// Checking for a shortcode pattern
				preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $output, $matches );
				// If any match, add it to array
				if ( $matches[0] ) {
					$posts[] = array(
						'id'        => get_the_id(),
						'link'      => get_permalink(),
						'shortcode' => $matches[1][0]
					);
				}
			}
			wp_reset_postdata();
		}

		return $posts;
	}

}