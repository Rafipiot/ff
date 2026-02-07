<?php

namespace App\Http\Controllers;

use App\Services\AhpTopsisService;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    protected $ahpTopsisService;

    public function __construct(AhpTopsisService $ahpTopsisService)
    {
        $this->ahpTopsisService = $ahpTopsisService;
    }

    public function index()
    {
        $rankings = $this->ahpTopsisService->process();
        return view('hasil.index', compact('rankings'));
    }
}