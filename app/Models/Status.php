<?php

namespace App\Models;

use App\Models\Tarefa;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'tarefa_status';
    
    protected $fillable = [
        'nome'
    ];

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class, 'status_id');
    }
}
