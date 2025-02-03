<?php

namespace Cobolt\Admin\Modules;

use WP_Query;

class Health {

	public function get_posts_broken_shortcodes(): array {
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

				global $posts;
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

	public function get_broken_links() {

		$links = array();

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

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				ob_start();

				the_content();
				// Getting the parsed content
				// where all registered shortcodes have been replaced
				$output   = ob_get_clean();
				$base_url = get_site_url();

				// Get all anchor tags with base url in href
//				preg_match_all( '<a href=" . $base_url ">(.*)</a>', $output, $matches );
				preg_match_all( '/<a href="([^"]+)">(.*)<\/a>/', $output, $matches );

//				var_dump( $matches );
				// If any match, add it to array
				if ( $matches[0] ) {
					for ( $i = 0; $i < count( $matches[0] ); $i ++ ) {
						$href = $matches[1][ $i ];
						$text = $matches[2][ $i ];

						if ( str_starts_with( $href, '/' ) ) {
							$href = $base_url . $href;
						}
						// Check if the link is broken

						$response      = wp_remote_get( $href );
						$response_code = wp_remote_retrieve_response_code( $response );

						if ( $response_code !== 200 ) {
							$display_response = $response_code;
							if ( is_wp_error( $response ) ) {
								$display_response = $response->get_error_message();
							}
							$links[] = array(
								'id'         => get_the_id(),
								'post_link'  => get_permalink(),
								'post_title' => get_the_title(),
								'text'       => $text,
								'url'        => $href,
								'status'     => $display_response
							);
						}
					}
				}


			}
			wp_reset_postdata();
		}


		return $links;
	}

}


