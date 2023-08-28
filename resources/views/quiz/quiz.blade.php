@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>{{ $category }} - {{ $difficulty }}</h1>

        <form action="{{ route('submit-quiz') }}" method="post">
            @csrf

            {{-- inputs hidden para poder aceder à categoria e dificuldade no controller --}}
            <input type="hidden" name="category" value="{{ $category }}">
            <input type="hidden" name="difficulty" value="{{ $difficulty }}">

            <button type="submit" class="btn btn-primary mb-3">Submit Answers</button>
            <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Cancel Quiz</a>
        
            {{-- para cada questao na colecao, mostrar a questao --}}
            {{-- nested foreach vai tratar de mostrar as respostas da questao de cada ciclo --}}
            @foreach($questions as $index => $question)
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Question {{ $index + 1 }}:</strong> {{ $question->question }}</p>
                        
                        <div class="form-group">
                            {{-- 
                                guarda numa colecao ($allAnswers) as respostas que pertencem à questao de cada ciclo do foreach.
                                ->shuffle() para que a resposta correta nao seja sempre a primeira opcao
                            --}}
                            @php
                                $allAnswers = collect([$question->correct_answer, $question->incorrect_answer1, $question->incorrect_answer2, $question->incorrect_answer3])->shuffle();
                            @endphp    

                            {{-- para cada resposta da colecao (as 4 respostas de cada pergunta) gerar um input radio --}}
                            @foreach($allAnswers as $answer)
                                <label>
                                    {{-- 
                                        o name contem um array answers[{{ $question->id }}] que vai permitir associar a resposta selecionada pelo utilizador à questao a que pertence, atraves do id da questao.
                                        o value é a string da resposta selecionada pelo utilizador.
                                        desta forma, quando o form for submetido será gerado um array associativo question_id => selected_answer.
                                        é utilizado no inicio do metodo submitQuiz(). ver output do dd()
                                    --}}
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer }}">
                                    {{ $answer }}
                                </label><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary mb-3">Submit Answers</button>
            <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Cancel Quiz</a>
        </form>
    </div>
@endsection
