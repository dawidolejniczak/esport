<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PostRepository
 * @package namespace App\Repositories;
 */
interface PostRepository extends RepositoryInterface
{
    public function all($columns = ['*']);

    public function create(array $attributes);

    public function sync($id, $relation, $attributes, $detaching = true);

    public function findWhere(array $where, $columns = ['*']);

    public function paginate($limit = null, $columns = ['*']);
}
