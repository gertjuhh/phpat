<?php

namespace PhpAT\Parser\Relation;

use PhpAT\Parser\Ast\FullClassName;

class Dependency extends AbstractRelation
{
    public function __construct(FullClassName $relatedClass, int $startLine, int $endLine)
    {
        parent::__construct($relatedClass, $startLine, $endLine);
    }
}
