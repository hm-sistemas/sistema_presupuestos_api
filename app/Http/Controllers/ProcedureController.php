<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcedureRequest;
use App\Http\Requests\UpdateProcedureRequest;
use App\Http\Resources\ProcedureResource;
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->pagination ?? 25;

        $procedures = Procedure::paginate($paginate);

        return (ProcedureResource::collection($procedures))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Procedimientos han sido cargados.',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProcedureRequest $request)
    {
        $validated = $request->validated();
        $procedure = Procedure::create($validated);

        return (new ProcedureResource($procedure))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Procedimiento ha sido registrado.',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $patient = Procedure::findOrFail($request->id);

        return (new ProcedureResource($patient))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Procedimiento ha sido cargado.',
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureRequest $request)
    {
        $validated = $request->validated();
        $procedure = Procedure::findOrFail($validated['id']);
        $procedure->name = $validated['name'];
        $procedure->save();

        return (new ProcedureResource($procedure))->additional([
            'meta' => [
                'success' => true,
                'message' => 'Procedimiento ha sido actualizado.',
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $procedure = Procedure::findOrFail($request['id']);
        $procedure->delete();

        return response()->json('Procedimiento ha sido eliminado.', 204);
    }
}