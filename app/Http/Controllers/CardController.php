<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    public function index()
    {
        try {
            return $this->cardService->listarCards();

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $card)
    {
        //
    }

    public function update(Request $request, int $card)
    {
        //
    }

    public function destroy(int $card)
    {
        //
    }
}
