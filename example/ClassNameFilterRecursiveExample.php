<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Type\Collection\Types\String\Validator\StringValidator;

class ClassNameFilterExample extends ObjectCollection
{

}

class Test1 extends ObjectCollection
{

}

class Test2 extends ObjectCollection
{

}

class Test3 extends AbstractCollection implements HasValueValidatorChainInterface
{
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new StringValidator(false));
    }
}

$test1 = new Test1();
$test2 = new Test2();
$test3 = new Test3();

$test3->append('1');
$test3->append('2');
$test3->append('3');
$test2->append($test3);
$test1->append($test2);

echo "Create collection instance\n";

$collection = new ClassNameFilterExample();
$collection->append($test1);

echo "Filter collection by class Test3\n";

foreach($collection->filterByClassRecursive(Test3::class) as $item){
    echo get_class($item)."\n";
}