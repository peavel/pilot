<?php

namespace PEAVEL\Pilot\Database\Types\Postgresql;

use PEAVEL\Pilot\Database\Types\Common\CharType;

class CharacterType extends CharType
{
    public const NAME = 'character';
    public const DBTYPE = 'bpchar';
}
