<?php

namespace PEAVEL\Pilot\Database\Types\Common;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use PEAVEL\Pilot\Database\Types\Type;

class TextType extends Type
{
    public const NAME = 'text';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'text';
    }
}
