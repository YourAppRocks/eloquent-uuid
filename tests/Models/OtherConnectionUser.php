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

class OtherConnectionUser extends Model
{
    use HasUuid;

    protected $table = 'other_connection_users';

    protected $connection = 'other-connection';

    protected $fillable = [
        'name',
    ];
}
