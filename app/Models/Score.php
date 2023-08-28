<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    // uma score pertence a um utilizador.
    // vai permitir fazer queries à tabela scores indo buscar tambem dados da tabela users.
    // relacao entre as tabelas é feita atraves da coluna user_id da tabela scores
    public function user() {
        return $this->belongsTo(User::class);
    }
}
