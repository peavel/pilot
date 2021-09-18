<?php

namespace PEAVEL\Pilot\Database\Types\Postgresql;

use PEAVEL\Pilot\Database\Types\Common\DoubleType;

class DoublePrecisionType extends DoubleType
{
    public const NAME = 'double precision';
    public const DBTYPE = 'float8';
}
