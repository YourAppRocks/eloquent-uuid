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

use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->getUuidColumnName();
    }

    /**
     * Scope query by UUID.
     *
     * @param  string $uuid
     * @param  bool $firstOrFail
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function scopeFindByUuid($query, $uuid, $firstOrFail = true)
    {
        $this->validateUuid($uuid);

        $queryBuilder = $query->where($this->getUuidColumnName(), $uuid);

        return $firstOrFail ? $queryBuilder->firstOrFail() : $queryBuilder;
    }

    /**
     * Check if the table have a column uuid.
     *
     * @param \Illuminate\Database\Eloquent\Model
     * @return void
     *
     * @throws \YourAppRocks\EloquentUuid\Exceptions\MissingUuidColumnException
     */
    private function hasColumnUuid($model)
    {
        if (! \Schema::hasColumn($model->getTable(), $model->getUuidColumnName())) {
            throw new MissingUuidColumnException("You don't have a '{$model->getUuidColumnName()}' column on '{$model->getTable()}' table.");
        }
    }

    /**
     * Check if uuid value is valid.
     *
     * @param  string $uuid
     * @return void
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    private function validateUuid($uuid)
    {
        if (! \Ramsey\Uuid\Uuid::isValid($uuid)) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }
    }
}
