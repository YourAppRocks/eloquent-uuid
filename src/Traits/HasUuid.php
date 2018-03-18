<?php

/*
 * This file is part of eloquent-uuid.
 *
 * (c) YourApp.Rocks <contact@yourapp.rocks>
 *
 * This source file is subject to the license file that is bundled
 * with this source code in the file LICENSE.
 */

namespace YourAppRocks\EloquentUuid\Traits;

use YourAppRocks\EloquentUuid\Exceptions\MissingUuidColumnException;

trait HasUuid
{
    use Uuidable;

    /**
     * Boot trait on the model.
     *
     * @return void
     */
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            (new static)->hasColumnUuid($model);

            $model->setUuid($model->generateUuid());
        });

        static::saving(function ($model) {
            (new static)->hasColumnUuid($model);

            $originalUuid = $model->getOriginal($model->getUuidColumnName());

            if ($originalUuid !== $model->getUuid()) {
                $model->setUuid($originalUuid);
            }
        });
    }

    /**
     * Check if the table have a column uuid.
     *
     * @throws MissingUuidColumnException
     */
    private function hasColumnUuid($model)
    {
        if (! \Schema::hasColumn($model->getTable(), $model->getUuidColumnName())) {
            throw new MissingUuidColumnException("You don't have a '{$model->getUuidColumnName()}' column on '{$model->getTable()}' table.");
        }
    }
}
