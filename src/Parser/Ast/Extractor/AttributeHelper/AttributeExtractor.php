<?php

namespace PhpAT\Parser\Ast\Extractor\AttributeHelper;

use PhpAT\Parser\Ast\ClassContext;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use PHPStan\BetterReflection\Reflection\ReflectionAttribute;
use PHPStan\BetterReflection\Reflection\ReflectionClass;
use PHPStan\BetterReflection\Reflection\ReflectionMethod;

class AttributeExtractor implements AttributeExtractorInterface
{
    /** @var ClassContext */
    private $context;

    public function __construct(ClassContext $context)
    {
        $this->context = $context;
    }

    public function getFromReflectionClass(ReflectionClass $class): array
    {
        foreach ($class->getAttributes() as $attribute) {
            $result[] = $attribute->getName();
        }

        return $result ?? [];
    }

    public function getFromReflectionMethod(ReflectionMethod $method): array
    {
        /** @var ClassMethod|Function_ $ast */
        $ast = $method->getAst();
        foreach ($ast->attrGroups ?? [] as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                $result[] = (new ReflectionAttribute(
                    $attr->name->toString(),
                    []
                ))->getName();
            }
        }

        return $result ?? [];
    }
}
