<?php

/*
 * This file is part of eloquent-uuid.
 *
 * (c) YourApp.Rocks <contact@yourapp.rocks>
 *
 * This source file is subject to the license file that is bundled
 * with this source code in the file LICENSE.
 */

namespace YourAppRocks\EloquentUuid\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class InvalidUser extends Model
{
    use HasUuid;

    protected $table = 'custom_users';

    protected $uuidColumnName = 'invalid';
    protected $uuidVersion = 9;    // Available 1,3,4 or 5
    protected $uuidString = false;   // Needed when $uuidVersion is "3 or 5"

    protected $fillable = [
        'name',
    ];
}
