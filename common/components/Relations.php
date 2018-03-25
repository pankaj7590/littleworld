<?php

namespace common\components;

class Relations
{
	const RELATION_FATHER = 1;
	const RELATION_MOTHER = 2;
	const RELATION_OTHER = 3;
	
	public static $relations = [
		self::RELATION_FATHER => 'Father',
		self::RELATION_MOTHER => 'Mother',
		self::RELATION_OTHER => 'Other',
	];
}