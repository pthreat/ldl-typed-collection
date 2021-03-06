<?php declare(strict_types=1);

namespace LDL\Type\Collection\Item;

use LDL\Type\Collection\Types\Object\ObjectCollectionInterface;

interface NamedItemCollectionInterface extends ObjectCollectionInterface
{
    /**
     * @param $key
     * @return int
     * @throws \InvalidArgumentException
     */
    public function getItemKeyCount($key) : int;

    public function getItemKeyStats() : array;
}