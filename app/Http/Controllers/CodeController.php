<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCodeRequest;
use App\Http\Requests\UpdateCodeRequest;
use App\Repositories\CodeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CodeController extends AppBaseController
{
    /** @var  CodeRepository */
    private $codeRepository;

    public function __construct(CodeRepository $codeRepo)
    {
        $this->middleware('auth');
        $this->codeRepository = $codeRepo;
    }

    /**
     * Display a listing of the Code.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->codeRepository->pushCriteria(new RequestCriteria($request));
        $codes = $this->codeRepository->all();

        return view('codes.index')
            ->with('codes', $codes);
    }

    /**
     * Show the form for creating a new Code.
     *
     * @return Response
     */
    public function create()
    {
        return view('codes.create');
    }

    /**
     * Store a newly created Code in storage.
     *
     * @param CreateCodeRequest $request
     *
     * @return Response
     */
    public function store(CreateCodeRequest $request)
    {
        $input = $request->all();

        $code = $this->codeRepository->create($input);

        Flash::success('Code saved successfully.');

        return redirect(route('codes.index'));
    }

    /**
     * Display the specified Code.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $code = $this->codeRepository->findWithoutFail($id);

        if (empty($code)) {
            Flash::error('Code not found');

            return redirect(route('codes.index'));
        }

        return view('codes.show')->with('code', $code);
    }

    /**
     * Show the form for editing the specified Code.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $code = $this->codeRepository->findWithoutFail($id);

        if (empty($code)) {
            Flash::error('Code not found');

            return redirect(route('codes.index'));
        }

        return view('codes.edit')->with('code', $code);
    }

    /**
     * Update the specified Code in storage.
     *
     * @param  int              $id
     * @param UpdateCodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCodeRequest $request)
    {
        $code = $this->codeRepository->findWithoutFail($id);

        if (empty($code)) {
            Flash::error('Code not found');

            return redirect(route('codes.index'));
        }

        $code = $this->codeRepository->update($request->all(), $id);

        Flash::success('Code updated successfully.');

        return redirect(route('codes.index'));
    }

    /**
     * Remove the specified Code from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $code = $this->codeRepository->findWithoutFail($id);

        if (empty($code)) {
            Flash::error('Code not found');

            return redirect(route('codes.index'));
        }

        $this->codeRepository->delete($id);

        Flash::success('Code deleted successfully.');

        return redirect(route('codes.index'));
    }
}
