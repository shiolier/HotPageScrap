<?php

use \Util\Category;

class Controller_Api_Entries extends Controller_Api_Base {
	public function get_category($category_id = 0) {
		if (!Category::is_appropriate_id($category_id)) {
			$this->result['error'] = array(
				'type' => 'Bad param',
				'message' => ':category_id が不正です',
			);
			return $this->response($this->result, 400);
		}

		$json_file_contents = @file_get_contents(__DIR__ . "/../../../../../json/${category_id}.json");
		if (!$json_file_contents) {
			$this->result['entries'] = array();
			return $this->response($this->result, 418);
		}

		$last_update_text = @file_get_contents(__DIR__ . "/../../../../../json/last_update.txt");
		if (!$last_update_text) {
			$this->result['meta']['last_update'] = 'Unknown';
		} else {
			$this->result['meta']['last_update'] = $last_update_text;
		}

		$this->result['entries'] = json_decode($json_file_contents, true);
		return $this->response($this->result);
	}

	public function get_all() {
		#foreach (Category::get_all_id() as $id) {
		for ($i = 1; $i <= 5; $i++) {
			$json_file_contents = @file_get_contents(__DIR__ . "/../../../../../json/${i}.json");
			if (!$json_file_contents) {
				continue;
			}
			$one_category_entries = json_decode($json_file_contents, true);
			foreach ($one_category_entries as $entry) {
				$this->result['entries'][] = $entry;
			}
		}

		$last_update_text = @file_get_contents(__DIR__ . "/../../../../../json/last_update.txt");
		if (!$last_update_text) {
			$this->result['meta']['last_update'] = 'Unknown';
		} else {
			$this->result['meta']['last_update'] = $last_update_text;
		}

		return $this->response($this->result);
	}
}
