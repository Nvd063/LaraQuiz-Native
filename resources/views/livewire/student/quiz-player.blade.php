<div class="min-h-screen bg-white flex flex-col">
    <div class="min-h-screen bg-white flex flex-col" wire:poll.1s="decrementTimer">
    @if(!$showResult)
        <div class="p-6 bg-indigo-600 text-white rounded-b-3xl shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <a href="/" class="text-white/80 hover:text-white font-bold">✕ Close</a>
                <div class="bg-white/20 px-4 py-1 rounded-full font-mono text-sm">
                    ⏱ {{ floor($timeLeft / 60) }}:{{ str_pad($timeLeft % 60, 2, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            
            <div class="w-full bg-white/20 h-2 rounded-full overflow-hidden">
                @php 
                    $total = count($questions);
                    $current = $currentStep + 1;
                    $percent = ($total > 0) ? ($current / $total) * 100 : 0;
                @endphp
                <div class="bg-white h-full transition-all duration-500" style="width: {{ $percent }}%"></div>
            </div>
            <p class="text-xs mt-2 opacity-80 text-center uppercase tracking-widest">Question {{ $currentStep + 1 }} of {{ $total }}</p>
        </div>

        <div class="p-6 flex-1">
            <div class="bg-gray-50 p-6 rounded-3xl mb-8 border border-gray-100 shadow-sm">
                <h2 class="text-xl font-bold text-gray-800 leading-snug">
                    {{ $questions[$currentStep]->question_text }}
                </h2>
            </div>

            <div class="space-y-4">
                @foreach(['a', 'b', 'c', 'd'] as $opt)
                    @php $optionField = "option_" . $opt; @endphp
                    <button wire:click="selectOption({{ $questions[$currentStep]->id }}, '{{ $opt }}')"
                        class="w-full p-4 rounded-2xl border-2 text-left transition active:scale-95 flex items-center
                        {{ (isset($answers[$questions[$currentStep]->id]) && $answers[$questions[$currentStep]->id] == $opt) 
                            ? 'border-indigo-600 bg-indigo-50 shadow-md ring-1 ring-indigo-200' 
                            : 'border-gray-100 bg-white hover:border-indigo-200' }}">
                        
                        <span class="h-8 w-8 rounded-lg bg-gray-100 flex items-center justify-center font-bold mr-4 uppercase text-xs text-gray-500">
                            {{ $opt }}
                        </span>
                        <span class="font-medium text-gray-700">{{ $questions[$currentStep]->$optionField }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="p-6">
            @if($currentStep == count($questions) - 1)
                <button wire:click="submitQuiz" class="w-full bg-green-600 text-white font-bold py-4 rounded-2xl shadow-xl hover:bg-green-700 transition active:scale-95">
                    Finish Quiz 🏆
                </button>
            @endif
        </div>

    @else
        <div class="min-h-screen flex flex-col items-center justify-center p-6 bg-gradient-to-br from-indigo-600 to-purple-700 text-white text-center">
            <div class="bg-white text-gray-900 w-full rounded-[40px] p-10 shadow-2xl">
                <div class="text-6xl mb-4">🎉</div>
                <h1 class="text-2xl font-black">All Done!</h1>
                
                <div class="my-8 py-6 bg-gray-50 rounded-3xl border border-gray-100">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-2">Final Score</p>
                    <div class="text-6xl font-black text-indigo-600">
                        {{ $score }}<span class="text-2xl text-gray-300">/{{ count($questions) }}</span>
                    </div>
                </div>

                <a href="/" class="block w-full bg-indigo-600 text-white font-bold py-4 rounded-2xl shadow-lg hover:bg-indigo-700">
                    Exit to Menu
                </a>
            </div>
        </div>
    @endif
    </div>
</div>