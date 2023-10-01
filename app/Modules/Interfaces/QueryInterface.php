<?php

namespace App\Modules\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface QueryInterface
{
    /**
     * @return mixed
     */
    public function handle(array $parameters);

}
