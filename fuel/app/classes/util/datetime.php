<?php

namespace Util;

class DateTime {
	/**
	 * strtotime()の日本語対応版
	 * http://xirasaya.com/?m=detail&hid=194
	 *
	 * @param string $sDate
	 * @param boolean $blnNow
	 * @return integer
	 */
	public static function strtotime($sDate = null, $blnNow = true) {
		if (preg_match('/^([0-9]{4})[年]{1}([0-9]{1,2})[月]{1}([0-9]{1,2})[日]{1}[\s　]([0-9]{1,2})[時]{1}([0-9]{1,2})[分]{1}([0-9]{1,2})[秒]{1}[\s　]*$/u', $sDate, $match)) {	// YYYY年MM月DD日HH時MI分SS秒
			$sTimestamp = mktime($match[4], $match[5], $match[6], $match[2], $match[3], $match[1]);
		} else if (preg_match('/^([0-9]{4})[年]([0-9]{1,2})[月]([0-9]{1,2})[日][\s　]([0-9]{1,2})[時]([0-9]{1,2})[分][\s　]*$/u', $sDate, $match)) {	// YYYY年MM月DD日HH時MI分
			$sTimestamp = mktime($match[4], $match[5], 0, $match[2], $match[3], $match[1]);
		} else if (preg_match('/^([0-9]{4})[年]([0-9]{1,2})[月]([0-9]{1,2})[日][\s　]*$/u', $sDate, $match)) {	// YYYY年MM月DD日
			$sTimestamp = mktime(0, 0, 0, $match[2], $match[3], $match[1]);
		} else {
			$sTimestamp = strtotime($sDate, $blnNow);
		}
		return $sTimestamp;
	}
}
