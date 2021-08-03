<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{

    public function __construct(Aluno $aluno) {
        $this->aluno = $aluno;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$aluno = Aluno::all();
        $aluno = $this->aluno->all();
        return response()->json($aluno, 200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$aluno = Aluno::create($request->all());
        //RA
        //Nome
        //Email
        //CPF

       

        $request->validate($this->aluno->rules(), $this->aluno->feedback());



        $aluno = $this->aluno->create($request->all());
        return response()->json($aluno, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = $this->aluno->find($id);
        if ($aluno === null) {
            return response()->json(['erro' => 'Registro inexistente.'], 404); //json
        }

        return response()->json($aluno, 200);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // $aluno->update($request->all());
       $aluno = $this->aluno->find($id);

        if ($aluno === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O registro solicitado não existe.'], 404);
        }

        //$request->validate($aluno->rules(), $aluno->feedback());
        $aluno->update($request->all());
        return response()->json($aluno, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = $this->aluno->find($id);

        if ($aluno === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O registro solicitado não existe.'], 404);
        }
        $aluno->delete();
        return response()->json(['msg' => 'Aluno removido com sucesso.'], 200);
    }
}
