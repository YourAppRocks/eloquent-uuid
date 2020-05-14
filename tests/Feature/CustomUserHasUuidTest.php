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

use YourAppRocks\EloquentUuid\Tests\Models\CustomUser;
use YourAppRocks\EloquentUuid\Tests\TestCase;

class CustomUserHasUuidTest extends TestCase
{
    /** @test */
    public function it_generates_the_uuid_on_create()
    {
        $customUser = CustomUser::create(['name' => 'João Roberto']);
        $this->assertNotEmpty($customUser->getUuid());
    }

    /** @test */
    public function it_generates_the_uuid_on_save()
    {
        $customUser = new CustomUser();
        $customUser->name = 'João Roberto';
        $this->assertEmpty($customUser->getUuid());

        $customUser->save();
        $this->assertNotEmpty($customUser->getUuid());
    }

    /** @test */
    public function it_does_not_override_the_uuid_if_it_is_already_set()
    {
        $randomUuid = '44bdab3b-1da5-45ac-b7ca-468878cea619';

        $customUser = CustomUser::create(['name' => 'João Roberto']);
        $this->assertNotEmpty($customUser->getUuid());

        //Override Uuid
        $customUser->setUuid($randomUuid);
        $customUser->save();

        $this->assertNotEquals($randomUuid, $customUser->getUuid());
    }

    /** @test */
    public function find_a_model_by_its_uuid()
    {
        $customUser = CustomUser::create(['name' => 'Taylor']);
        $taylor = CustomUser::findByUuid($customUser->getUuid());

        $this->assertInstanceOf(CustomUser::class, $taylor);
        $this->assertSame('Taylor', $taylor->name);
    }

    /** @test */
    public function find_a_model_by_its_uuid_and_return_query_builder()
    {
        $customUser = CustomUser::create(['name' => 'Taylor']);
        $query = CustomUser::findByUuid($customUser->getUuid(), false);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $query);
    }

    /** @test */
    public function expected_model_not_found_exception()
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        $customUser = CustomUser::create(['name' => 'João']);
        $joao = CustomUser::findByUuid(strtoupper($customUser->getUuid()));
    }

    /** @test */
    public function get_custom_uuid_column_name()
    {
        $this->assertEquals('userid', (new CustomUser)->getUuidColumnName());
    }

    /** @test */
    public function get_custom_uuid_version()
    {
        $this->assertEquals(3, (new CustomUser)->getUuidVersion());
    }

    /** @test */
    public function get_uuid_string()
    {
        $this->assertEquals('your-app-rocks', (new CustomUser)->getUuidString());
    }
}
