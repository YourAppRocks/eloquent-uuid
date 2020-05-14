<?php

/*
 * This file is part of eloquent-uuid.
 *
 * (c) YourApp.Rocks <contact@yourapp.rocks>
 *
 * This source file is subject to the license file that is bundled
 * with this source code in the file LICENSE.
 */

namespace YourAppRocks\EloquentUuid\Test\Feature;

use YourAppRocks\EloquentUuid\Tests\Models\InvalidUser;
use YourAppRocks\EloquentUuid\Tests\TestCase;

class InvalidUserHasUuidTest extends TestCase
{
    /** @test */
    public function expected_missing_uuid_column_exception()
    {
        $this->expectException(\YourAppRocks\EloquentUuid\Exceptions\MissingUuidColumnException::class);

        $invalidUser = InvalidUser::create(['name' => 'João Roberto']);
    }

    /** @test */
    public function expected_invalid_uuid_version_exception()
    {
        $this->expectException(\YourAppRocks\EloquentUuid\Exceptions\InvalidUuidVersionException::class);

        $model = new InvalidUser();
        $model->generateUuid();
    }
}
