<?php


namespace App\Product\Domain\Command;


use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

class ReserveProduct extends Command implements PayloadConstructable
{
    use PayloadTrait;

}
