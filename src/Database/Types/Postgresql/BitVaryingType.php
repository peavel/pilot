<?php

namespace PEAVEL\Pilot\Database\Types\Postgresql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use PEAVEL\Pilot\Database\Types\Type;

class BitVaryingType extends Type
{
    public const NAME = 'bit varying';
    public const DBTYPE = 'varbit';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        $length = empty($field['length']) ? 255 : $field['length'];

        return "varbit({$length})";
    }
}
