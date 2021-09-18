<?php

namespace PEAVEL\Pilot\Database\Types\Postgresql;

use PEAVEL\Pilot\Database\Types\Common\VarCharType;

class CharacterVaryingType extends VarCharType
{
    public const NAME = 'character varying';
    public const DBTYPE = 'varchar';
}
