<?php

namespace Util;

class Category {
	const ID_UNKNOWN = 0;
	const ID_CURRICULUM = 1;
	const ID_ACTIVITY = 2;
	const ID_EVENT = 3;
	const ID_PEOPLE = 4;
	const ID_JOB = 5;

	const STR_CURRICULUM = "curriculum";
	const STR_ACTIVITY = "activity";
	const STR_EVENT = "event";
	const STR_PEOPLE = "people";
	const STR_JOB = "job";

	public static function is_appropriate_id($id = 0) {
		return $id >= 1 && $id <= 5;
	}

	public static function id_to_string($id) {
		if ($id == self::ID_CURRICULUM) {
			return self::STR_CURRICULUM;
		} else if ($id == self::ID_ACTIVITY) {
			return self::STR_ACTIVITY;
		} else if ($id == self::ID_EVENT) {
			return self::STR_EVENT;
		} else if ($id == self::ID_PEOPLE) {
			return self::STR_PEOPLE;
		} else if ($id == self::ID_JOB) {
			return self::STR_JOB;
		} else {
			return "";
		}
	}

	public static function get_all_id() {
		return array(
			self::ID_CURRICULUM,
			self::ID_ACTIVITY,
			self::ID_EVENT,
			self::ID_PEOPLE,
			self::ID_JOB,
		);
	}

	public static function japanese_to_id($japanese = '') {
		if ($japanese == '授業紹介') {
			return self::ID_CURRICULUM;
		} else if ($japanese == '特別活動') {
			return self::ID_ACTIVITY;
		} else if ($japanese == 'イベントレポート') {
			return self::ID_EVENT;
		} else if ($japanese == '学科の人') {
			return self::ID_PEOPLE;
		} else if ($japanese == '就職活動') {
			return self::ID_JOB;
		} else {
			return self::ID_UNKNOWN;
		}
	}
}