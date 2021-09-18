<?php

namespace PEAVEL\Pilot\Database\Types\Common;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use PEAVEL\Pilot\Database\Types\Type;

class CharType extends Type
{
    public const NAME = 'char';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        $field['length'] = empty($field['length']) ? 1 : $field['length'];

        return "char({$field['length']})";
    }
}
