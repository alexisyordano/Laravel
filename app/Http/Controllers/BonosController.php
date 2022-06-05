<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bonos;
use Illuminate\Support\Facades\DB;

class BonosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            return view('bonos.bonosregister');
        }
        else
        {   
            return redirect()->to('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $messages=[
            'b_name.unique' => 'Este bono ya existe',
        ];

        $validator  = $request->validate([
            'b_name' => 'required|unique:bonos',
        ],$messages);

        $marca = request('check_cicles');
        if($marca != 1)
        {
            $marca = 0;
        }
        $bonos = Bonos::create([
            'b_name' => request('b_name'),
            'days' => request('days'),
            'interests' => request('interests'),
            'cicles' => request('cicles'),
            'marca' => $marca,
        ]);
        
        return redirect()->to('bonosregister')->with('success','El bono fue creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        date_default_timezone_set('America/Lima');
        if(Auth::check())
        {
            $bonos = Bonos::all();
            return view('bonos.bonoshow', compact('bonos'));
        }
        else
        {   
            return redirect()->to('login');
        }
    }


    public function edit($id)
    {
        date_default_timezone_set('America/Lima');
        if(Auth::check())
        {
            $bono = Bonos::select('*')->where('id_bono', $id)->first();
            return view('bonos.edit', compact('bono'));
        }
        else
        {   
            return redirect()->to('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('America/Lima');
        $name = $request->input('b_name');
        $days = $request->input('days');
        $interests = $request->input('interests');
        DB::update('update bonos set b_name = ?,days=?,interests= ? where id_bono = ?',[$name,$days,$interests,$id]);
        return redirect()->to('bonos')->with('success', 'Bono Actualizado');
    }

    public function delete($id)
    {
        date_default_timezone_set('America/Lima');
        $bono = Bonos::select('*')->where('id_bono', $id)->first();
        return view('bonos.delete', compact('bono'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set('America/Lima');
        $bono = Bonos::where('id_bono', $id)->delete();
        return redirect()->to('bonos')->with('success', 'Bono Eliminado');
    }
}
