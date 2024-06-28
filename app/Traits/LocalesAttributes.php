<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait LocalesAttributes
{
    public function name(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!empty($value)) {
                    return $value;
                }

                $currentLocale = app()->getLocale();
                return $this->{'name_' . $currentLocale} ?? $this->name_en;
            },
        );
    }

    public function title(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!empty($value)) {
                    return $value;
                }

                $currentLocale = app()->getLocale();
                return $this->{'title_' . $currentLocale} ?? $this->title_en;
            },
        );
    }

    public function address(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!empty($value)) {
                    return $value;
                }

                $currentLocale = app()->getLocale();
                return $this->{'address_' . $currentLocale} ?? $this->address_en;
            },
        );
    }

    public function description(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!empty($value)) {
                    return $value;
                }

                $currentLocale = app()->getLocale();
                return $this->{'description_' . $currentLocale} ?? $this->description_en;
            },
        );
    }
}
