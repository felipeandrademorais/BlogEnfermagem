<?php 
	$author_id = get_the_author_meta('ID');
	$author_name = get_the_author_meta('display_name');
	$author_avatar_url = get_avatar_url($author_id);
?>

<div class="p-4 max-w-sm h-full cards">
	<a href="<?php echo esc_url( get_permalink()); ?>" class="flex-1 flex flex-wrap no-underline space-y-4 hover:no-underline">
		<img src="<?php the_post_thumbnail_url('large') ?>" class="h-64 w-full rounded-t pb-6 thumnail-card">
		<p class="w-full text-gray-600 text-xs md:text-sm px-6">
			<?php getAllCategories(); ?>
		</p>
		<div class="w-full font-bold text-xl text-gray-900 px-6">
			<h2 class="entry-title text-2xl md:text-2xl font-extrabold leading-tight mb-1">
				<?php the_title(); ?>
			</h2>
		</div>
		<p class="text-gray-800 font-serif text-base px-6 mb-1">
			<?php  
				$content = strip_tags(get_the_content());
				echo substr($content, 0, 300) . " <span> [...] </span> ";
			?>
		</p>
	</a>
	
	<div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
		<div class="flex items-center justify-between avatar-card">

			<img class="w-8 h-8 rounded-full mr-4 avatar" data-name="<?php echo $author_name; ?>" src="<?php echo esc_url($author_avatar_url); ?>" alt="Avatar of Author">
			<p class="text-gray-600 text-xs md:text-sm">
				<?php estimativeTimeRead($content); ?>
			</p>
		</div>
	</div>
</div>
