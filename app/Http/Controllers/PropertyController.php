<?php

namespace App\Http\Controllers;

use App\Repositories\PropertyRepository as Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    protected $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->map) {
            $properties = $this->property->all()->map(function ($property) {
                return ['position' => $property->positions, 'infoText' => '<h5 class="mb-2">'.$property->title.'</h5><h6 class="text-muted mb-2 pb-0">'.$property->price.'</h6><p>'.$property->address.'</p><a href="'.route('properties.show', $property->id).'" class="btn btn-sm btn-primary">Saiba mais</a>'];
            });

            return view('properties.map', [
                'properties' => $properties->all(),
            ]);
        }

        return view('properties.index', [
            'properties' => $this->property->paginate(12),
        ]);
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
        return view('properties.show', [
            'property' => $this->property->show($id),
        ]);
    }
}
