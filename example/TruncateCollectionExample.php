<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\KeyValidatorChainTrait;
use LDL\Type\Collection\Types\Lockable\Validator\LockingValidator;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Type\Collection\Validator\RegexValidator;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;

class TruncateCollectionExample extends AbstractCollection implements HasKeyValidatorChainInterface, LockableObjectInterface
{
    use KeyValidatorChainTrait;
    use LockableObjectInterfaceTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getKeyValidatorChain()
            ->append(new RegexValidator('#[0-9]#', $strict=true))
            ->append(new UniqueValidator($strict=true))
            ->append(new LockingValidator())
            ->lock();
    }
}

echo "Create collection instance\n";

$collection = new TruncateCollectionExample();

echo "Add element test with key 123\n";

$collection->append('test', '123');

echo "Add element test2 with key 456\n";

$collection->append('test2', '456');

echo "Iterate through elements:\n";

foreach($collection as $key => $value){
    echo "Item $key: $value"."\n";
}

echo "Truncate collection\n";

$collection->truncate();

echo "Add element test with key 111\n";

$collection->append('test', '111');

echo "Add element test2 with key 333\n";

$collection->append('test2', '333');

echo "Lock collection\n";

$collection->lock();

echo "Try to truncate collection, (now the collection is LOCKED so an exception must be thrown)\n";

try{

    $collection->truncate();

}catch(LockingException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

echo "Iterate through elements:\n";

foreach($collection as $key => $value){
    echo "Item $key: $value"."\n";
}