<?php

namespace App\Http\Controllers;

use App\Models\profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::latest()->paginate(5);

        return view('profil.index',compact('profils'))
        ->with('i', (Request()->input('page',1)-1) *5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profils.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jepg,png,jpg,gif,svg|max:2048',

        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        profil::create($input);

        return redirect()->route('profil.index')
        ->with('success','Profil Created succesfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function show(profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function edit(profil $profil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, profil $profil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function destroy(profil $profil)
    {
        //
    }
}
