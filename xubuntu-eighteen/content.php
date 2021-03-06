<?php while( have_posts( ) ) { ?>
	<?php the_post( ); ?>
	<div <?php post_class( 'group' ) ?> id="post-<?php the_ID( ); ?>">
		<?php	if( !is_front_page( ) ) { ?>
			<?php if( !is_page( ) ) { ?>
				<h1 class="post-title"><a href="<?php the_permalink( ); ?>"><?php the_title( ); ?></a></h1>
			<?php } else { ?>
				<h1 class="post-title"><?php the_title( ); ?></h1>
			<?php } ?>
		<?php } ?>

		<?php	if( !is_page( ) ) { ?>
			<div class="post-meta">
				<span class="post-time"><?php print strftime( _x( '%B %e, %Y', 'post time format (strftime)', 'xubuntu' ), get_the_time( 'U' ) ); ?></span>
				<?php the_terms( $post->ID, 'category', '&mdash; <span class="post-cat">', ', ', '</span>' ); ?>
				<?php the_terms( $post->ID, 'release', '&mdash; <span class="post-release">', ', ', '</span>' ); ?>
				<?php the_tags( '&mdash; <span class="post-tags">', ', ', '</span>' ); ?>
			</div>
		<?php } ?>

		<div class="post-post">
			<div class="post-entry entry">
				<?php if( has_post_thumbnail( ) ) { ?>
					<div class="post-thumbnail"><?php the_post_thumbnail( ); ?></div>
				<?php } ?>
				<?php the_content( __( 'Read the rest of this entry »', 'xubuntu' ) ); ?>
			</div>
		</div>
	</div>
<?php } ?>
<?php if( is_home( ) && ( get_next_posts_page_link( ) || get_previous_posts_page_link( ) ) ) { ?>
	<p class="post-pagination">
		<?php if( get_next_posts_link( ) ) { ?>
			<a class="button back" href="<?php echo get_next_posts_page_link( ); ?>"><?php _e( 'Older posts' ); ?></a>
		<?php } ?>
		<?php if( get_previous_posts_link( ) ) { ?>
			<a class="button forward" href="<?php echo get_previous_posts_page_link( ); ?>"><?php _e( 'Newer posts' ); ?></a>
		<?php } ?>
	</p>
<?php } ?>