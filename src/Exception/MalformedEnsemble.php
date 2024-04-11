<?php

namespace Bluspark\DgfipDatamatrix\Exception;

class MalformedEnsemble extends DatamatrixException
{
    public static function create(string $ensemble, string $ensembleIdentifier): self
    {
        return new static("The ensemble $ensembleIdentifier as $ensemble is malformed.");
    }
}
