<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\View\View;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\GameCreateRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Repositories\GameRepository;


class GamesController extends Controller
{

    /**
     * @var GameRepository
     */
    protected $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        $this->repository->pushCriteria(app(RequestCriteria::class));
        $games = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $games,
            ]);
        }

        return view('games.index', compact('games'));
    }

    /**
     * @param GameCreateRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(GameCreateRequest $request)
    {

        $game = $this->repository->create($request->all());

        $response = [
            'message' => 'Game created.',
            'data' => $game->toArray(),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }


        return redirect()->back();
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $game = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $game,
            ]);
        }

        return view('games.show', compact('game'));
    }


    /**
     * @param $id
     * @return View
     */
    public function edit($id): View
    {

        $game = $this->repository->find($id);

        return view('games.edit', compact('game'));
    }


    /**
     * @param GameUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(GameUpdateRequest $request, $id)
    {
        $game = $this->repository->update($request->all(), $id);

        $response = [
            'message' => 'Game updated.',
            'data' => $game->toArray(),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->back();

    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Game deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Game deleted.');
    }
}
