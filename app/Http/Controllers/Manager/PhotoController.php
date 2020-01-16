<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo as PhotoRequest;
use App\Repositories\PhotoRepository as Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    protected $photo;

    /**
     * Create a new controller instance.
     */
    public function __construct(Photo $photo)
    {
        $this->middleware('auth');
        $this->photo = $photo;
    }

    /**
     * Store photos in storage.
     *
     * @param \App\Models\Property int                 $id
     * @param \App\Http\Requests\Photo as PhotoRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(int $id, Request $request)
    {
        foreach ($request->photos as $photo) {
            $filename = Str::random(10).'.'.$photo->extension();

            $path = $photo->storeAs('public/images', $filename);

            $photo = $this->photo->create([
                'url' => config('app.url').'/storage/images/'.$filename,
                'property_id' => $id,
            ]);
        }

        return back()
            ->with('success', 'Foto(s) anexada(s) com sucesso!')
        ;
    }
}
