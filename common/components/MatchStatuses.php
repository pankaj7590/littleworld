<?php

namespace common\components;

class MatchStatuses
{
	const STATUS_SCHEDULED = 1;
	const STATUS_ON_GOING = 2;
	const STATUS_CANCELLED = 3;
	const STATUS_OVER = 4;
	
	public static $statuses = [
		self::STATUS_SCHEDULED => 'Scheduled',
		self::STATUS_ON_GOING => 'On Going',
		self::STATUS_CANCELLED => 'Cancelled',
		self::STATUS_OVER => 'Over',
	];
}