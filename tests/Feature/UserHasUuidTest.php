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

use YourAppRocks\EloquentUuid\Tests\Models\User;
use YourAppRocks\EloquentUuid\Tests\TestCase;

class UserHasUuidTest extends TestCase
{
    /** @test */
    public function it_generates_the_uuid_on_create()
    {
        $user = User::create(['name' => 'João Roberto']);
        $this->assertNotEmpty($user->getUuid());
    }

    /** @test */
    public function it_generates_the_uuid_on_save()
    {
        $user = new User();
        $user->name = 'João Roberto';
        $this->assertEmpty($user->getUuid());

        $user->save();
        $this->assertNotEmpty($user->getUuid());
    }

    /** @test */
    public function it_does_not_override_the_uuid_if_it_is_already_set()
    {
        $randomUuid = '44bdab3b-1da5-45ac-b7ca-468878cea619';

        $user = User::create(['name' => 'João Roberto']);
        $this->assertNotEmpty($user->getUuid());

        //Override Uuid
        $user->setUuid($randomUuid);
        $user->save();

        $this->assertNotEquals($randomUuid, $user->getUuid());
    }

    /** @test */
    public function find_a_model_by_its_uuid()
    {
        $user = User::create(['name' => 'Taylor']);
        $taylor = User::findByUuid($user->getUuid());

        $this->assertInstanceOf(User::class, $taylor);
        $this->assertSame('Taylor', $taylor->name);
    }

    /** @test */
    public function find_a_model_by_its_uuid_and_return_query_builder()
    {
        $user = User::create(['name' => 'Taylor']);
        $query = User::findByUuid($user->getUuid(), false);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $query);
    }

    /** @test */
    public function expected_model_not_found_exception()
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        $user = User::create(['name' => 'João']);
        $joao = User::findByUuid(strtoupper($user->getUuid()));
    }

    /** @test */
    public function get_default_uuid_column_name()
    {
        $this->assertEquals('uuid', (new User)->getUuidColumnName());
    }

    /** @test */
    public function get_default_uuid_version()
    {
        $this->assertEquals(4, (new User)->getUuidVersion());
    }

    /** @test */
    public function get_uuid_string()
    {
        $this->assertEquals('', (new User)->getUuidString());
    }
}
