<?php

declare(strict_types=1);

namespace App\Form;

class MyRandomForm
{
    public function isSubmitted(): bool
    {
        return filter_has_var(INPUT_POST, "text") &&
               filter_has_var(INPUT_POST, "integer") &&
               filter_has_var(INPUT_POST, "date") &&
               filter_has_var(INPUT_POST, "url") &&
               filter_has_var(INPUT_POST, "choice") &&
               filter_has_var(INPUT_POST, "range");
    }
}
