<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class CarBuilder extends Builder
{
    // public function __construct($query)
    // {
    //     parent::__construct($query);
    // }

    public function Name($val)
    {
        return $this->when($val != null, function ($q) use ($val) {
            $q->where('name', $val);
        });
    }

    public function Search($value)
    {
        return $this->when($value != null, function ($q) use ($value) {
            $q->where('pic_name', 'like', '%' . $value . '%')
                ->orWhere('pic_phone', 'like', '%' . $value . '%')
                ->orWhere('merchant_name', 'like', '%' . $value . '%')
                ->orWhere('pic_email', 'like', '%' . $value . '%');
        });
    }
}
