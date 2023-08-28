<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    public function getUserScores(Request $request)
    {
        // aceder à categoria e dificuldade selecionadas pelo utilizador no dropdown de filtragem
        $category = $request->input('category');
        $difficulty = $request->input('difficulty');

        // iniciar a query à tabela scores
        $query = Score::query();

        // se a categoria e a dificuldade selecionadas nao forem o default (all categories),
        // adicionar clausula where à query com as opcoes que o utilizador selecionou
        if ($category && $category != 'All') {
            $query->where('category', $category);
        }

        if ($difficulty && $difficulty != 'All') {
            $query->where('difficulty', $difficulty);
        }

        // apresentar apenas os resultados do utilizador que está autenticado
        $query->where('user_id', auth()->id());

        // ordenar descendentemente pela coluna score e aceder apenas aos primeiros 20 registos (top 20 scores) 
        $scores = $query->orderBy('score', 'desc')
                    ->take(20)
                    ->get();

        // passar as scores, categoria e dificuldade para a view, onde serao apresentadas na tabela
        return view('score.my_scores', [
            'scores' => $scores,
            'category' => $category,
            'difficulty' => $difficulty
        ]);
    }

    public function getLeaderboard(Request $request)
    {
        // aceder à categoria e dificuldade selecionadas pelo utilizador no dropdown de filtragem
        $category = $request->input('category');
        $difficulty = $request->input('difficulty');

        // iniciar a query à tabela scores
        // with('user') permite aceder tambem aos dados do utilizador associado a cada score
        // 'user' é o metodo que está no model Score. nesse metodo é declarada a relacao entre as duas tabelas
        $query = Score::with('user');

        // se a categoria e a dificuldade selecionadas nao forem o default (all categories),
        // adicionar clausula where à query com as opcoes que o utilizador selecionou
        if ($category && $category != 'All') {
            $query->where('category', $category);
        }
        
        if ($difficulty && $difficulty != 'All') {
            $query->where('difficulty', $difficulty);
        }

        // ordenar descendentemente pela coluna score e aceder apenas aos primeiros 20 registos (top 20 scores) 
        $scores = $query->orderBy('score', 'desc')
                    ->take(20)
                    ->get();
        
        // passar as scores, categoria e dificuldade para a view, onde serao apresentadas na tabela
        return view('score.leaderboard', [
            'scores' => $scores,
            'category' => $category,
            'difficulty' => $difficulty
        ]);
    }
}
