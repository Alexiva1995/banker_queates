<?php

namespace App\Http\Controllers;

use App\Services\MinApiService;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;

class HomeController extends Controller
{
    /**
     * The Min Api service
     * @var App\Services\MinApiService
     */
    protected $minApiService;
    public function __construct(MinApiService $minApiService)
    {
        $this->minApiService = $minApiService;
    }

    public function index()
    {
        $pageConfigs = ['blankPage' => true];
        //criptobar
        //$cryptos = $this->minApiService->get10Cryptos();

        return view('home.welcome', ['pageConfigs' => $pageConfigs]);
    }
    public function terminos()
    {
        return view('home.terminos');
    }
    public function politicas()
    {
        return view('home.politicas');
    }
}
