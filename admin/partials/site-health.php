<?php
/**
 * Page to view website health.
 */

//namespace Cobolt\Admin;

use Cobolt\Admin\Modules\Health;

$health            = new Health();
$broken_shortcodes = $health->get_posts_broken_shortcodes();
?>

<div class="wrap">
    <h1>Website Health</h1>
    <h2>Broken Shortcodes</h2>
	<?php //var_dump( $broken_shortcodes ); ?>
	<?php if ( ! empty( $broken_shortcodes ) ) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
            <tr>
                <th>Post ID</th>
                <th>Post Link</th>
                <th>Shortcode</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ( $broken_shortcodes as $broken_shortcode ) : ?>
                <tr>
                    <td><?php echo esc_html( $broken_shortcode['id'] ); ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url( $broken_shortcode['link'] ); ?>">
							<?php echo esc_html( $broken_shortcode['link'] ); ?></a>
                    </td>
                    <td><?php echo esc_html( $broken_shortcode['shortcode'] );
						?></td>
                </tr>
			<?php endforeach;
			?>
            </tbody>
        </table>
	<?php else :
		?>
        <p>No broken shortcodes found.</p>
	<?php endif; ?>

</div>
