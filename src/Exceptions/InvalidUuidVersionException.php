<?php

/*
 * This file is part of eloquent-uuid.
 *
 * (c) YourApp.Rocks <contact@yourapp.rocks>
 *
 * This source file is subject to the license file that is bundled
 * with this source code in the file LICENSE.
 */

namespace YourAppRocks\EloquentUuid\Exceptions;

class InvalidUuidVersionException extends \InvalidArgumentException
{
    protected $message = 'Invalid value! Expected 1,3,4 or 5 integer values.';
}
