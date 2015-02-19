<?php

namespace Util;

class EntryParser {
	public static function parse($category_id = 0) {
		$entries = array();

		$request_url = "http://www.jec.ac.jp/design-w/" . Category::id_to_string($category_id);
		$config = array(
			'useragent' => 'HotPage Crawler',
		);
		$client = new \Goutte\Client($config);
		$crawler = $client->request('GET', $request_url);
		$entries[] = self::_parse_entry($crawler->filter('div#entryRecent'));

		$crawler->filter('div.entryArchiveInner')->each(function ($node) use (&$entries) {
			$entries[] = self::_parse_entry($node);
		});

		return $entries;
	}

	private static function _parse_entry($node) {
		$date_japanese = $node->filter('div.entryTitle p')->text();
		$date_normal = \date('Y-m-d', DateTime::strtotime($date_japanese));

		$category_text = $node->filter('p.entryCategory img')->attr('alt');
		$category_id = Category::japanese_to_id($category_text);

		return array(
			'title' => $node->filter('div.entryTitle h2')->text(),
			'date' => $date_normal,
			// 'category_str' => $category_text,
			'category_id' => $category_id,
			'lead' => self::_parse_lead($node),
			'image_url' => $node->filter('img.photo')->attr('src'),
			'url' => $node->filter('p.readmore a')->attr('href'),
		);
	}

	private static function _parse_lead($node) {
		$lead = null;
		$lead_node = $node->filter('p.lead');
		if ($lead_node->count() > 0) {
			$lead = $lead_node->text();
		} else {
			$node->filter('p')->each(function ($p_node, $i) use (&$lead) {
				if ($i == 2) {
					$lead = $p_node->text();
				}
			});
		}
		return $lead;
	}
}
