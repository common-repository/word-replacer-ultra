<?php if (!defined('ABSPATH')) {
exit;
}
// Exit if directly accessed
?>
<div class="row">
	<div class="col-12">
		<div class="wor_repl">
			<div class="wor_repl-header">
				<h3><?php _e('Word Replacer Ultra', 'word-replacer-ultra', 'word-replacer-ultra');?></h3>
				<p><?php _e('Enter a word & select any post type below to get the magic started!', 'word-replacer-ultra');?></p>
			</div>
			<div class="wor_repl-body">
				<form action="" method="post" id="quick-search">
					<div class="form-group row">
						<div class="col-12">
							<div class="row">
								<div class="col-6">
									<div class="search">
										<?php wp_nonce_field('search_replace')?>
										<label for="search_key"><?php _e('Search:', 'word-replacer-ultra');?></label>
										<input type="text" name="search_key" id="search_key" />
									</div>
								</div>
								<div class="col-6">
									<div class="replace">
										<label for="replace_key"><?php _e('Replace by:', 'word-replacer-ultra');?></label>
										<input type="text" name="replace_key" id="replace_key" />
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="post">
									<label for="in"><?php _e('Replace In:', 'word-replacer-ultra');?></label>
									<div class="postcheckbox">
										<input type="hidden" name="action" value="word_replacer_ultra_action">
										<?php
										$post_types = get_post_types(['public' => true], object);
										unset($post_types['attachment']);
										foreach ($post_types as $post_type) {
										echo "<label>" . $post_type->labels->singular_name;
											echo '<input type="checkbox" value="' . $post_type->name . '" name="post_types[]" id="post_types" />';
										echo "</label>";
										}
										?>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="quick_replace" class="col-sm-2 col-form-label"></label>
								<div class="col-12">
									<button type="submit" id="quick_replace" name="quick_replace" class="btn btn-primary"><?php _e('Go!', 'quick-search');?></button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>	</div>
		</div>