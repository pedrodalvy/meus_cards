<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiariaRequest;
use App\Repositories\DiariaRepository;
use App\Services\DiariaService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class DiariaController extends Controller
{
    private $diariaRepository;
    private $diariaService;

    public function __construct(DiariaRepository $diariaRepository, DiariaService $diariaService)
    {
        $this->diariaRepository = $diariaRepository;
        $this->diariaService    = $diariaService;
    }

    public function index(Request $request)
    {
        try {
            $dataAtual = Carbon::now(env('TIME_ZONE'));
            $mes       = intval($request->get('mes', $dataAtual->format('m')));
            $ano       = intval($request->get('ano', $dataAtual->format('Y')));

            return $this->diariaRepository->listarDiarias($mes, $ano);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function store(DiariaRequest $request)
    {
        try {
            return $this->diariaRepository->create($request->all());

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function show(int $diaria)
    {
        try {
            return $this->diariaService->mostrarRegistrosDoDia($diaria);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function update(DiariaRequest $request, int $diaria)
    {
        try {
            if (!$this->diariaRepository->update($request->all(), $diaria)) {
                throw new Exception('Diária não encontrada');
            }

            return response()->noContent();

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function destroy(int $diaria)
    {
        try {
            if (!$this->diariaRepository->delete($diaria)) {
                throw new Exception('Diária não encontrada');
            }

            return response()->noContent();

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }
}
