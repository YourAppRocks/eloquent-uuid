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

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use YourAppRocks\EloquentUuid\Exceptions\InvalidUuidVersionException;

trait Uuidable
{
    /**
     * Get the column name for the "uuid".
     *
     * @return string
     */
    public function getUuidColumnName()
    {
        return property_exists($this, 'uuidColumnName') ? $this->uuidColumnName : 'uuid';
    }

    /**
     * Get "uuid" version or default to 4.
     *
     * @return int
     */
    public function getUuidVersion()
    {
        return property_exists($this, 'uuidVersion') ? $this->uuidVersion : 4;
    }

    /**
     * Get string to generate uuid version 3 and 5.
     *
     * @return string
     */
    public function getUuidString()
    {
        return property_exists($this, 'uuidString') ? $this->uuidString : '';
    }

    /**
     * Get the uuid value.
     *
     * @return string|null
     */
    public function getUuid()
    {
        if (! empty($this->getUuidColumnName())) {
            return (string) $this->{$this->getUuidColumnName()};
        }
    }

    /**
     * Set the uuid value.
     *
     * @param  string  $value
     * @return void
     */
    public function setUuid($value)
    {
        if (! empty($this->getUuidColumnName())) {
            $this->{$this->getUuidColumnName()} = $value;
        }
    }

    /**
     * Generate the UUID.
     *
     * @return string
     */
    public function generateUuid()
    {
        switch ($this->getUuidVersion()) {
            case 1:
                return RamseyUuid::uuid1()->toString();
            case 3:
                return RamseyUuid::uuid3(RamseyUuid::NAMESPACE_DNS, $this->getUuidString())->toString();
            case 4:
                return RamseyUuid::uuid4()->toString();
            case 5:
                return RamseyUuid::uuid5(RamseyUuid::NAMESPACE_DNS, $this->getUuidString())->toString();
            default:
                throw new InvalidArgumentException;
        }
    }

    /**
     * Validate set uuid version.
     *
     * @throws InvalidUuidVersionException
     */
    private function validateUuidVersion($value)
    {
        $validValues = [1, 3, 4, 5];

        if (! in_array($value, $validValues) or ! is_numeric($value)) {
            throw new InvalidUuidVersionException();
        }
    }
}
