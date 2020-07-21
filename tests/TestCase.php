<?php

/*
 * This file is part of eloquent-uuid.
 *
 * (c) YourApp.Rocks <contact@yourapp.rocks>
 *
 * This source file is subject to the license file that is bundled
 * with this source code in the file LICENSE.
 */

namespace YourAppRocks\EloquentUuid\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('database.other-connection', 'sqlite');
        $app['config']->set('database.connections.other-connection', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUpDatabase()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::dropIfExists('custom_users');
        Schema::create('custom_users', function (Blueprint $table) {
            $table->uuid('userid');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::connection('other-connection')->dropIfExists('other_connection_users');
        Schema::connection('other-connection')->create('other_connection_users', function ($table) {
            $table->uuid('uuid');
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }
}
