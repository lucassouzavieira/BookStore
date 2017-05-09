<?php

namespace App\Collections;

use Respect\Validation\Validator;

class Book extends ArangoCollectionRepository
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
