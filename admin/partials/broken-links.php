<?php

use Cobolt\Admin\Modules\Health;


$health       = new Health();
$broken_links = $health->get_broken_links();
?>


<div class="wrap">
    <h1>Website Health</h1>
    <h2>Broken Links</h2>
	<?php //var_dump( $broken_shortcodes ); ?>
	<?php if ( ! empty( $broken_links ) ) : ?>
        <table class="wp-list-table widefat striped">
            <thead>
            <tr>
                <th>Post ID</th>
                <th>Post</th>
                <th>Anchor Text</th>
                <th>Broken URL</th>
                <th>Status Code</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ( $broken_links as $broken_link ) : ?>
                <tr>
                    <td><?php echo esc_html( $broken_link['id'] ); ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url( $broken_link['post_link'] ); ?>">
							<?php echo esc_html( $broken_link['post_title'] ); ?></a>
                    </td>
                    <td><?php echo esc_html( $broken_link['text'] );
						?></td>
                    <td><a href="<?php echo esc_url( $broken_link['url'] ); ?>">
							<?php echo esc_html( $broken_link['url'] ); ?></a>
                    </td>
                    <td><?php echo esc_html( $broken_link['status'] );
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