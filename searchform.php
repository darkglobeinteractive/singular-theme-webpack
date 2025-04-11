<?php $input_id = singular_random_id( 10, 'sid-' ); ?>
<form role="search" method="get" class="search-form" action="/">
	<div class="search-form-wrap">
		<label for="<?php echo $input_id; ?>">Search for:</label>
		<input id="<?php echo $input_id; ?>" name="s" type="text" value="<?php echo ( get_search_query() ? get_search_query() : '' ); ?>" />
		<button type="submit" class="search-submit">Submit</button>
	</div>
</form>
