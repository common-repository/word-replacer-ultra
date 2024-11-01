<?php if (!defined('ABSPATH')) {
	exit;
	// Exit if directly accessed
}
/**
 * ajax
 */
if (!class_exists('WordReplacerUltraAjax')) {
	class WordReplacerUltraAjax extends WordReplacerUltra {
		public function __construct() {

			add_action("wp_ajax_word_replacer_ultra_action", array($this, 'word_replacer_ultra'), 10);
			add_action("wp_ajax_nopriv_word_replacer_ultra_action", array($this, 'word_replacer_ultra'), 10);

		}
		public function word_replacer_ultra() {
			global $wpdb;
			if (!isset($_POST['search_key']) || !isset($_POST['replace_key']) || !isset($_POST['post_types'])) {
				$response['message'] = "Oops Something is missing";
				$response['status'] = false;
			} else {
				$total_changes = 0;
				$search = $this->word_replacer_ultra_validator($_POST['search_key'], 'textfield');
				$replace = $this->word_replacer_ultra_validator($_POST['replace_key'], 'textfield');

				foreach ($_POST['post_types'] as $key => $posttype) {
					$posttype = $this->word_replacer_ultra_validator($posttype, 'checkbox');
					$res = $wpdb->query(
						$wpdb->prepare(
							"UPDATE " . $wpdb->posts . "
						 SET post_excerpt = REPLACE(post_excerpt, %s, %s),
						 post_content = REPLACE(post_content, %s, %s),
						 post_title = REPLACE(post_title, %s, %s)
						 WHERE post_type='$posttype'",
							$search, $replace, $search, $replace, $search, $replace
						)
					);
					$total_changes = $res + $total_changes;
				}
				$response['message'] = $total_changes . " records were updated";
				$response['status'] = true;
			}
			$this->responseJsonResults($response);
		}
		private function responseJsonResults($data) {
			header('Content-Type: application/json');
			echo json_encode($data);
			wp_die();
		}
	}
	new WordReplacerUltraAjax();
}
