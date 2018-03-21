<?php

/*
 * This file is part of eloquent-uuid.
 *
 * (c) YourApp.Rocks <contact@yourapp.rocks>
 *
 * This source file is subject to the license file that is bundled
 * with this source code in the file LICENSE.
 */

namespace YourAppRocks\EloquentUuid\Tests\Fixtures;

class Post extends TestModel
{
    protected $fillable = [
        'title',
    ];

    protected $uuidColumnName = 'universally_unique_id';
}
