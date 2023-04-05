<?php
namespace app\core;

use IntlDateFormatter;
use DateTime;

class TimeHelper{
	public static function DTOutput($s_datetime) {
		$datetime = new DateTime($s_datetime);
		global $lang;
		$timezone='UTC';
		$fmt = new IntlDateFormatter(
			$lang,
			IntlDateFormatter::MEDIUM, //date format
			IntlDateFormatter::MEDIUM, //time format
			$timezone
		);
		return $fmt->format($datetime);
	}
}