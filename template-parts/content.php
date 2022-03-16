<div class="p-4 max-w-sm h-full">
	<a href="<?php echo esc_url( get_permalink()); ?>" class="flex-1 flex flex-wrap no-underline space-y-4 hover:no-underline">
		<img src="https://source.unsplash.com/collection/225/800x600" class="h-64 w-full rounded-t pb-6">
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
		<div class="flex items-center justify-between">
			<img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="Author Name" src="http://i.pravatar.cc/300" alt="Avatar of Author">
			<p class="text-gray-600 text-xs md:text-sm">
				<?php estimativeTimeRead($content); ?>
			</p>
		</div>
	</div>
</div>
