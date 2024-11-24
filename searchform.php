<form role="search" method="get" class="search-form" action="/">
	<div class="search-form-wrap">
		<label class="screen-reader-text" for="s">Search for:</label>
		<input id="s" name="s" type="text" value="<?php echo ( get_search_query() ? get_search_query() : '' ); ?>" />
		<button type="submit" class="search-submit">Submit</button>
	</div>
</form>
