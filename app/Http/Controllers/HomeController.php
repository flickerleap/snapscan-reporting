<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MerchantRepository;
use App\Repositories\CodeRepository;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /** @var  MerchantRepository */
    private $merchantRepository;

    /** @var  CodeRepository */
    private $codeRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MerchantRepository $merchantRepo, CodeRepository $codeRepository)
    {
        $this->middleware('auth');
        $this->merchantRepository = $merchantRepo;
        $this->codeRepository = $codeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post') && $request->has('code_id')) {
            $code = $this->codeRepository->find($request->input('code_id'));
            $merchant = $this->merchantRepository->find($code->merchant_id);

            $payments = $this->getSnapscanPayments($request, $code, $merchant);

            return view('home')
                ->with('payments', $payments);
        } elseif ($request->isMethod('post') && $request->has('merchant_id')) {
            $codes = $this->codeRepository->all()
                ->where('merchant_id', $request->input('merchant_id'))
                ->pluck('name', 'id');

            return view('home')
                ->with('codes', $codes);
        } else {
            $user_merchants = \App\Models\User::find(\Auth::user()->id)->merchants()->pluck('id')->toArray();
            $merchants = $this->merchantRepository->all()->whereIn('id', $user_merchants)->pluck('name', 'id');

            return view('home')
                ->with('merchants', $merchants);
        }
        return view('home');
    }

    public function getSnapscanPayments($request, $code, $merchant)
    {
        $from = date('c', mktime(
            $request->input('start_date_hour'),
            $request->input('start_date_min'),
            00,
            $request->input('start_date_month'),
            $request->input('start_date_day'),
            $request->input('start_date_year')
        ));
        $to = date('c', mktime(
            $request->input('end_date_hour'),
            $request->input('end_date_min'),
            00,
            $request->input('end_date_month'),
            $request->input('end_date_day'),
            $request->input('end_date_year')
        ));

        $url = 'https://pos.snapscan.io/merchant/api/v1/payments?page=1&perPage=100&startDate='
            .$from
            .'&endDate='
            .$to
            .'&snapCode='
            .$code->reference;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_USERNAME, $merchant->api_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        // grab URL and pass it to the browser
        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header_data = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        // close cURL resource, and free up system resources
        curl_close($ch);

        $header_data = explode("\n", $header_data);

        $header['status']=$header_data[0];

        array_shift($header_data);

        foreach ($header_data as $part) {
            $middle=explode(":", $part);
            if (isset($middle[1])) {
                $header[ trim($middle[0]) ] = trim($middle[1]);
            }
        }

        $payments = json_decode($body);

        if (isset($header['X-Total-Pages']) && $header['X-Total-Pages'] > 1) {
            for ($i = 2; $i <= $header['X-Total-Pages']; $i++) {
                $url = 'https://pos.snapscan.io/merchant/api/v1/payments?page='
                    .$i
                    .'&perPage=100&startDate='
                    .$from
                    .'&endDate='
                    .$to
                    .'&snapCode='
                    .$code->reference;

                //Log::info('Curl Request: curl -u ' . $merchant->api_key . ': "' . $url . '"');

                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_USERNAME, $merchant->api_key);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 1);

                // grab URL and pass it to the browser
                $response = curl_exec($ch);

                $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $header_data = substr($response, 0, $header_size);
                $body = substr($response, $header_size);

                // close cURL resource, and free up system resources
                curl_close($ch);

                if (empty(json_decode($body))) {
                    break;
                }

                $payments = array_merge((array)json_decode($body), (array)$payments);
            }
        }

        return $payments;
    }
}
