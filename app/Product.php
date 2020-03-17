<?php

namespace App;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    use Searchable;
    protected $connection = 'mongodb';
}
