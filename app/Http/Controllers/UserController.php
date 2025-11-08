<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $model;
    
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $this->model->create($data);

        return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function edit(User $user)
    {
        return view('auth.register', compact('user'));
    }

    public function update($id, UserRequest $request)
    {
        $user = $this->model->findOr($id);

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

         return redirect()->route('tarefas.index')
                     ->with('success', 'Usuário atualizado com sucesso!');
    }
}
