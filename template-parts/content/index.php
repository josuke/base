<article <?php post_class(); ?>>
	<?php if (is_singular()) : ?>
		<h1><?php the_title(); ?></h1>
	<?php else : ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php endif; ?>
	<div><?php the_content(); ?></div>
</article>
