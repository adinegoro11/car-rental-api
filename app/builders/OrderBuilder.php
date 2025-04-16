<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class OrderBuilder extends Builder
{
    public function __construct($query)
    {
        parent::__construct($query);
    }

    public function OrderDate($val)
    {
        return $this->when($val != null, function ($q) use ($val) {
            $q->whereRaw('DATE(order_date) >= ?', [$val]);
        });
    }

    public function PickupDate($val)
    {
        return $this->when($val != null, function ($q) use ($val) {
            $q->whereRaw('DATE(pickup_date) >= ?', [$val]);
        });
    }

    public function PickupLocation($val)
    {
        return $this->when($val != null, function ($q) use ($val) {
            $q->where('pickup_location', 'like', '%' . $val . '%');
        });
    }
}
