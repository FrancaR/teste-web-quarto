<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property as PropertyRequest;
use App\Repositories\PropertyRepository as Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    protected $property;

    /**
     * Create a new controller instance.
     */
    public function __construct(Property $property)
    {
        $this->middleware('auth');
        $this->property = $property;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('manager.properties.index', [
            'properties' => $this->property->owned()->paginate(12),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Property as PropertyRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $property = $this->property->create($request->only($this->property->getModel()->fillable));

        return redirect()
            ->route('manager.properties.show', $property->id)
            ->with('success', 'Anúncio criado com sucesso!')
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorizeAction($id);

        return view('manager.properties.show', [
            'property' => $this->property->show($id, true),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorizeAction($id);

        return view('manager.properties.edit', [
            'properties' => $this->property->show($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $this->authorizeAction($id);

        $property = $this->property->update($request->only($this->property->getModel()->fillable), $id);

        return redirect()
            ->route('manager.properties.edit', [
                'properties' => $property->id,
            ])->with('success', 'Anúncio atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorizeAction($id);

        $this->property->delete($id);

        return redirect()
            ->route('manager.properties.index')
            ->with('success', 'Anúncio removido com sucesso!')
        ;
    }

    /**
     * Authorize user to make action.
     *
     * @return mixed
     */
    private function authorizeAction(int $id)
    {
        if (!$this->property->isOwner($id)) {
            abort(403, 'Oops! Você não tem acesso a esse recurso');
        }
    }
}
