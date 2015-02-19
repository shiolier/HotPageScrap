<?php

namespace Fuel\Tasks;

use \Util\Category;
use \Util\EntryParser as Parser;

class Entry {
	
	public function run() {
		foreach (Category::get_all_id() as $id) {
			$oil_dir = __DIR__ . '/../../../oil';
			$command = "php ${oil_dir} r entry:scrap ${id} > /dev/null 2>&1 &";
			\system($command);
		}
	}

	public function scrap($category_id = 0) {
		if (!Category::is_appropriate_id($category_id)) {
			return false;
		}

		// $json = \json_encode(Parser::parse($category_id), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		$json = \json_encode(Parser::parse($category_id), JSON_PRETTY_PRINT);
		\file_put_contents(__DIR__ . "/../../../json/${category_id}.json", $json);

		\file_put_contents(__DIR__ . "/../../../json/last_update.txt", date('Y-m-d H:i:s'));

		return true;
	}
}
