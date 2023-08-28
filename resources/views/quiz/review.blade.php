@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Review: {{ $category }} - {{ $difficulty }}</h1>
        <h2>Score: {{ $correctCount }}/{{ count($questions) }} ({{ $score }}%) {{ $medal }}</h2>

        {{-- botoes de navegacao --}}
        <a href="{{ route('home') }}" class="btn btn-primary mb-3">Back to Home</a>
        
        <form action="{{ route('start-quiz') }}" method="post" class="d-inline">
            @csrf
            {{-- estes inputs hidden vao permitir recuperar a categoria e dificuldade do quiz anterior se utilizador clicar no botao Retry Quiz--}}
            <input type="hidden" name="category" value="{{ $category }}">
            <input type="hidden" name="difficulty" value="{{ $difficulty }}">
            {{-- <input type="hidden" name="retry" value="1"> --}}
            <button type="submit" class="btn btn-secondary mb-3">Retry Quiz</button>
        </form>

        {{-- $questions, que foi passado para esta view com o submitQuiz(), é a variavel onde foi guardada a session --}}
        {{-- vai permitir mostrar as questoes pela mesma ordem da view anterior --}}
        @foreach($questions as $index => $question)
            <div class="card mb-4">
                <div class="card-body">
                    <p><strong>Question {{ $index + 1 }}:</strong> {{ $question->question }}</p>
                    
                    @php
                        $allAnswers = collect([$question->correct_answer, $question->incorrect_answer1, $question->incorrect_answer2, $question->incorrect_answer3]);
                        
                        // para cada questao vamos buscar a resposta dada pelo utilizador.
                        // descomentar dd($userAnswers) no final do metodo submitQuiz para ver o que contem esta variavel
                        $userAnswer = $userAnswers[$question->id] ?? null;
                    @endphp

                    {{--
                        logica de cores das respostas.
                        - resposta certa será sempre mostrada a verde
                        - se resposta do ciclo corresponder à que o utilizador selecionou, mas nao for a resposta correta, é mostrada a vermelho
                        - se utilizador nao respondeu à questao, todas as respostas ficam a vermelho menos a certa.
                    --}}
                    @foreach($allAnswers as $answer)
                        <p 
                            @if($answer == $question->correct_answer)
                                class="text-success"
                            @elseif($answer == $userAnswer && $answer != $question->correct_answer)
                                class="text-danger"
                            @elseif(!$userAnswer)
                                class="text-danger"
                            @endif
                        >
                            {{ $answer }}
                        </p>
                    @endforeach
                </div>
            </div>
        @endforeach

        {{-- botoes de navegacao --}}
        <a href="{{ route('home') }}" class="btn btn-primary mb-3">Back to Home</a>
        
        <form action="{{ route('start-quiz') }}" method="post" class="d-inline">
            @csrf
            <input type="hidden" name="category" value="{{ $category }}">
            <input type="hidden" name="difficulty" value="{{ $difficulty }}">
            <input type="hidden" name="retry" value="1">
            <button type="submit" class="btn btn-secondary mb-3">Retry Quiz</button>
        </form>
    </div>
@endsection
