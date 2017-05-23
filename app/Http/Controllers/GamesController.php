<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GameCreateRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Repositories\GameRepository;
use App\Validators\GameValidator;


class GamesController extends Controller
{

    /**
     * @var GameRepository
     */
    protected $repository;

    /**
     * @var GameValidator
     */
    protected $validator;

    public function __construct(GameRepository $repository, GameValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
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

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $game = $this->repository->create($request->all());

            $response = [
                'message' => 'Game created.',
                'data'    => $game->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
     * @param  string            $id
     *
     * @return Response
     */
    public function update(GameUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $game = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Game updated.',
                'data'    => $game->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
