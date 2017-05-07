<?php

namespace App\Collections;

use App\Collections\Validation\Validation;
use App\Providers\Arango\Collection;
use Respect\Validation\Validator;

class Book extends Collection implements Validation
{
    public $collection = 'books';

    public function validate(array $input): bool
    {
        $result[] = Validator::notEmpty()->validate($input['title']);
        $result[] = Validator::notEmpty()->validate($input['author']);
        $result[] = Validator::between(1, 50)->validate($input['edition']);

        foreach ($result as $key => $item) {
            if (!$item) {
                return false;
            }
        }

        return true;
    }
}
