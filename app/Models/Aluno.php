<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    protected $fillable = ['RA', 'Nome', 'Email', 'CPF'];

    public function rules(){
        return [
            'RA' => 'required|unique:alunos,RA,'.$this->id.'',
            'Nome' => 'required',
            //'Email' => 'required|unique:alunos,email'.$this->id.'',
            'Email' => 'required|unique:alunos,email',
            'CPF' => 'required|unique:alunos,cpf'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'Aluno cadastrado',
            'email.unique' => 'Email cadastrado',
            'cpf' => 'CPF cadastrado'
        ];
    }


}
