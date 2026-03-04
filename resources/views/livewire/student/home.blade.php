<div class="bg-gray-50 min-h-screen pb-10">
    <div class="bg-indigo-600 p-6 rounded-b-3xl shadow-lg">
        <h1 class="text-white text-2xl font-bold">Welcome, Student! 👋</h1>
        <p class="text-indigo-100 text-sm">Ready to test your knowledge?</p>
    </div>

    <div class="p-4 space-y-4">
        <h2 class="text-gray-800 font-bold text-lg px-2">Available Quizzes</h2>

        @foreach($quizzes as $quiz)
            <div
                class="p-5 mb-4 rounded-3xl border-2 {{ $quiz->results->isNotEmpty() ? 'bg-gray-50 border-gray-100' : 'bg-white border-indigo-50 shadow-sm' }}">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800">{{ $quiz->title }}</h3>
                        <p class="text-xs text-gray-400 uppercase tracking-widest">{{ $quiz->duration_minutes }} Mins</p>
                    </div>

                    @if($quiz->results->isNotEmpty())
                        <div class="text-right">
                            <span
                                class="text-[10px] bg-green-100 text-green-600 px-2 py-1 rounded-full font-bold uppercase">Completed</span>
                            <div class="text-2xl font-black text-indigo-600">
                                {{ $quiz->results->first()->score }}/{{ $quiz->results->first()->total_questions }}
                            </div>
                        </div>
                    @else
                        <a href="{{ route('quiz.play', $quiz->id) }}"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-2xl font-bold shadow-lg active:scale-95 transition">
                            Start
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>