<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GameRepository;
use App\Entities\Game;
use App\Validators\GameValidator;

/**
 * Class GameRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GameRepositoryEloquent extends BaseRepository implements GameRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Game::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GameValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
