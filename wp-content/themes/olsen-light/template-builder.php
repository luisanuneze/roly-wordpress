<?php
/*
* Template Name: Page builder
*/
?>

<?php get_header(); ?>

<div>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; ?>

</div>

<?php get_footer(); ?>
