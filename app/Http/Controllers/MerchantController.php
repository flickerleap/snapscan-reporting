<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Repositories\MerchantRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MerchantController extends AppBaseController
{
    /** @var  MerchantRepository */
    private $merchantRepository;

    public function __construct(MerchantRepository $merchantRepo)
    {
        $this->merchantRepository = $merchantRepo;
    }

    /**
     * Display a listing of the Merchant.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->merchantRepository->pushCriteria(new RequestCriteria($request));
        $merchants = $this->merchantRepository->all();

        return view('merchants.index')
            ->with('merchants', $merchants);
    }

    /**
     * Show the form for creating a new Merchant.
     *
     * @return Response
     */
    public function create()
    {
        return view('merchants.create');
    }

    /**
     * Store a newly created Merchant in storage.
     *
     * @param CreateMerchantRequest $request
     *
     * @return Response
     */
    public function store(CreateMerchantRequest $request)
    {
        $input = $request->all();

        $merchant = $this->merchantRepository->create($input);

        Flash::success('Merchant saved successfully.');

        return redirect(route('merchants.index'));
    }

    /**
     * Display the specified Merchant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $merchant = $this->merchantRepository->findWithoutFail($id);

        if (empty($merchant)) {
            Flash::error('Merchant not found');

            return redirect(route('merchants.index'));
        }

        return view('merchants.show')->with('merchant', $merchant);
    }

    /**
     * Show the form for editing the specified Merchant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $merchant = $this->merchantRepository->findWithoutFail($id);

        if (empty($merchant)) {
            Flash::error('Merchant not found');

            return redirect(route('merchants.index'));
        }

        return view('merchants.edit')->with('merchant', $merchant);
    }

    /**
     * Update the specified Merchant in storage.
     *
     * @param  int              $id
     * @param UpdateMerchantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMerchantRequest $request)
    {
        $merchant = $this->merchantRepository->findWithoutFail($id);

        if (empty($merchant)) {
            Flash::error('Merchant not found');

            return redirect(route('merchants.index'));
        }

        $merchant = $this->merchantRepository->update($request->all(), $id);

        Flash::success('Merchant updated successfully.');

        return redirect(route('merchants.index'));
    }

    /**
     * Remove the specified Merchant from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $merchant = $this->merchantRepository->findWithoutFail($id);

        if (empty($merchant)) {
            Flash::error('Merchant not found');

            return redirect(route('merchants.index'));
        }

        $this->merchantRepository->delete($id);

        Flash::success('Merchant deleted successfully.');

        return redirect(route('merchants.index'));
    }
}
