<?php

namespace App\Http\Controllers;

use App\Interfaces\QuoteRepositoryInterface;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    private QuoteRepositoryInterface $quoteRepo;

    public function __construct(QuoteRepositoryInterface $quoteRepo)
    {
        $this->quoteRepo = $quoteRepo;
    }

    public function index() {
        $status = 'success';
        $message = 'Data retrieved successfully';
        $data = $this->quoteRepo->getQuote();

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}
