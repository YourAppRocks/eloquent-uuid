<?php

/*
 * This file is part of eloquent-uuid.
 *
 * (c) YourApp.Rocks <contact@yourapp.rocks>
 *
 * This source file is subject to the license file that is bundled
 * with this source code in the file LICENSE.
 */

namespace YourAppRocks\EloquentUuid\Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Tests\TestCase;
use YourAppRocks\EloquentUuid\Traits\Uuidable;

class UuidableTest extends TestCase
{
    /** @test */
    public function get_default_uuid_column_name()
    {
        $this->assertEquals('uuid', (new UuidableModel)->getUuidColumnName());
    }

    /** @test */
    public function set_uuid_column_name()
    {
        $model = new UuidableModel;
        $model->setUuidColumnName('universally_unique_id');

        $this->assertEquals('universally_unique_id', $model->getUuidColumnName());
    }

    /** @test */
    public function get_default_uuid_version()
    {
        $this->assertEquals(4, (new UuidableModel)->getUuidVersion());
    }

    /** @test */
    public function set_uuid_version()
    {
        $model = new UuidableModel;
        $model->setUuidVersion(3);

        $this->assertEquals(3, $model->getUuidVersion());
    }

    /** @test */
    public function expected_invalid_uuid_version_exception()
    {
        $this->expectException('\YourAppRocks\EloquentUuid\Exceptions\InvalidUuidVersionException');

        $model = new UuidableModel;
        $model->setUuidVersion(9);
    }
}

class UuidableModel extends Model
{
    use Uuidable;
}
