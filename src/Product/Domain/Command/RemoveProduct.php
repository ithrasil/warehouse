<?php


namespace App\Product\Domain\Command;


use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

class RemoveProduct extends Command implements PayloadConstructable
{
    use PayloadTrait;

}

