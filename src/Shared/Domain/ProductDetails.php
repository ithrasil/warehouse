<?php


namespace App\Shared\Domain;


interface ProductDetails
{
    function getDetails() : array;

    function toString() : string;

    function fromArray(array $details) : self;
}
