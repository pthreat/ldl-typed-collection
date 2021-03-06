<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces;

use LDL\Type\Collection\Exception\TypedCollectionException;

interface CollectionInterface extends \Countable, \Iterator, \ArrayAccess
{
    /**
     * Append an element to the collection
     *
     * @param mixed $item
     * @param mixed $key
     *
     * @throws \Exception
     *
     * @return CollectionInterface
     */
    public function append($item, $key = null) : CollectionInterface;


    /**
     * Append many elements (same as append but for many elements)
     *
     * @param iterable $items
     * @param bool $useKey (use key when appending, false by default)
     * @throws \Exception
     * @return CollectionInterface
     */
    public function appendMany(iterable $items, bool $useKey=false) : CollectionInterface;

    /**
     * If the key already exists, it will be replaced, if the key does not exists
     * it will be appended to the collection.
     *
     * @param $item
     * @param $key
     * @throws \Exception if the value does not exist
     * @return CollectionInterface
     */
    public function replace($item, $key) : CollectionInterface;

    /**
     * Return associated indices
     *
     * @return array
     */
    public function keys() : array;

    /**
     * Check if a key exists
     *
     * @param number|string $key
     * @return bool
     */
    public function hasKey($key) : bool;

    /**
     * Syntax sugar for unset($collection[$key]); or $collection->offsetUnset($key);
     *
     * @param $key
     * @throws \Exception
     * @return CollectionInterface
     */
    public function remove($key) : CollectionInterface;

    /**
     * Remove last appended item
     *
     * @throws \Exception
     * @return CollectionInterface
     */
    public function removeLast() : CollectionInterface;

    /**
     * Check if a value exists inside the collection, comparison should between the given value and the collection
     * items should be performed by using strict comparison
     *
     * @param $value
     * @return bool
     */
    public function hasValue($value) : bool;

    /**
     * Obtains the first element in the collection
     *
     * @throws TypedCollectionException if there are no elements inside the collection
     * @return mixed
     */
    public function getFirst();

    /**
     * Returns the first appended key
     *
     * @return string|number
     */
    public function getFirstKey();

    /**
     * Obtains the last element in the collection
     *
     * @throws TypedCollectionException if there are no elements inside the collection
     * @return mixed
     */
    public function getLast();

    /**
     * Returns the last appended key
     *
     * @return string|number
     */
    public function getLastKey();

    /**
     * Syntactic sugar to determine if the collection is empty or not (since you could use $collection->count() === 0)
     * @return bool
     */
    public function isEmpty() : bool;

    /**
     * @param string $key
     * @return mixed
     */
    public function filterByKey(string $key);

    /**
     * @param iterable $keys
     * @return CollectionInterface
     */
    public function filterByKeys(iterable $keys) : CollectionInterface;

    /**
     * @param string $regex
     * @return CollectionInterface
     */
    public function filterByKeyRegex(string $regex) : CollectionInterface;

    /**
     * @return CollectionInterface
     */
    public function truncate() : CollectionInterface;

    /**
     * Removes elements from a collection by value comparison
     *
     * @param $value
     * @param bool $strict
     * @return int Amount of removed elements
     */
    public function removeByValue($value, bool $strict = true) : int;

    /**
     * Prepends an element to the collection if the collection has numeric keys the
     * keys will be reordered, for example [0 => 'test', 1=>'test2'] then "unshifting" a value 'test3' will result in:
     * [0 => 'test3', 1=>'test', 2=>'test2']
     *
     * if the unshifted element has a string $key, then the key will be replaced, and the item will be first in the array
     *
     * @param mixed $item
     * @param string|int $key
     * @return CollectionInterface
     * @throws \Exception
     */
    public function unshift($item, $key=null) : CollectionInterface;
}