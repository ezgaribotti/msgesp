<?php

namespace App\Dto;

abstract class Dto
{
    public function toArray(): array
    {
        $values = [];
        foreach ($this as $key => $value) {
            if (is_object($value))
                $values[$key] = get_object_vars($value);
            else $values[$key] = $value;
        }
        return $values;
    }

    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if (is_string($value))
                    $value = trim($value);
                $this->$key = $value;
            }
        }
    }
}
