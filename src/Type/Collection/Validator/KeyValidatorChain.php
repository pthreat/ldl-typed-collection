<?php declare(strict_types=1);

/**
 * This type of validation is a combined validation, basically it's a collection of different validators
 * which are validated in a chain like fashion.
 *
 * This collection also implements the FilterByInterface interface, which makes it possible to filter the validators
 * appended in this collection.
 */

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;

final class KeyValidatorChain extends AbstractValidatorChain
{
    public function __construct(iterable $items = null)
    {
        parent::__construct(KeyValidatorInterface::class, $items);
    }
}
