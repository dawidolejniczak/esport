<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  GameCreateRequest $request
     *
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $game = $this->repository->find($id);

        return view('games.edit', compact('game'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GameUpdateRequest $request
     * @param  string $id
     *
     * @return Response
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
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
