<?php

namespace App\Http\Controllers;

use App\Models\Paslon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaslonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            return view('daftar.index')->with([
                'paslon' => paslon::all(),
            ]);
            
            // $data=paslon::all();
            // return view('paslon',compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paslon.create');
        //return view('create.input');
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
            'gambar'=> 'required|image:png,jpg|max:4080'
        ]);


        $gambar =$request->gambar;
        $slug = Str::slug($gambar->getClientOriginalName());
        $new_gambar = time() .'_'. $slug;
        $gambar->move('uploads/paslon/', $new_gambar);


        $paslon = new Paslon;
        $paslon->no= $request->no;
        $paslon->nama = $request->nama;
        $paslon->fraksi = $request->fraksi;
        $paslon->dapil = $request->dapil;
        $paslon->agama = $request->agama;
        $paslon->r_pen = $request->r_pen;
        $paslon->r_pek = $request->r_pek;
        $paslon->gambar= 'upload/paslon/'.$new_gambar;
        if($paslon->save())
        {
            return redirect('daftar/create')->with('status','Data berhasil di simpan');
        }else{
            return redirect('daftar/create')->with('status','Data gagak di simpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paslon  $paslon
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
       //return "<h1> Saya siswa $id </h1>";
        //$data ['data']= Paslon::where('id',$id);
        //return view('/show')->with('data', $data);

        { $data = Paslon::find($id); 
        return view('profile')->with('data', $data); }

        //$data = Paslon::find($id);
        //return view('/show')->with('data', $data);
       
      // $data = Paslon::find($id);
       //return view('show',compact('data'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paslon  $paslon
     * @return \Illuminate\Http\Response
     */
    public function edit(Paslon $paslon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paslon  $paslon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paslon $paslon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paslon  $paslon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paslon $paslon)
    {
        //
    }

    
}
