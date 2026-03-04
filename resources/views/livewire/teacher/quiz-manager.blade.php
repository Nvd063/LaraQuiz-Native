<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white p-8 shadow-lg rounded-xl mb-8">
        <h2 class="text-2xl font-bold mb-6 text-indigo-700">Configure New Quiz</h2>

        @if (session()->has('message'))
            <div class="bg-indigo-100 text-indigo-700 p-3 rounded mb-4">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="saveQuiz" class="grid grid-cols-2 gap-6">
            <div class="col-span-2">
                <label class="block font-bold">Quiz Title</label>
                <input type="text" wire:model="title" placeholder="e.g. Final Term Exam"
                    class="w-full border-2 p-2 rounded-lg">
            </div>

            <div>
                <label class="block font-bold">Select Subject</label>
                <select wire:model="subject_id" class="w-full border-2 p-2 rounded-lg">
                    <option value="">Choose Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold">Questions to Pick (Randomly)</label>
                <input type="number" wire:model="total_questions" class="w-full border-2 p-2 rounded-lg">
            </div>

            <div>
                <label class="block font-bold">Duration (Minutes)</label>
                <input type="number" wire:model="duration_minutes" class="w-full border-2 p-2 rounded-lg">
            </div>

            <div class="col-span-2">
                <button type="submit"
                    class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition">
                    Create & Activate Quiz
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-8 shadow-lg rounded-xl">
        <h3 class="text-xl font-bold mb-4">Existing Quizzes</h3>
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Title</th>
                    <th>Subject</th>
                    <th>Questions</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizzes as $quiz)
                    <tr class="border-b">
                        <td class="py-2">{{ $quiz->title }}</td>
                        <td>{{ $quiz->subject->name }}</td>
                        <td>{{ $quiz->total_questions }}</td>
                        <td>{{ $quiz->duration_minutes }}m</td>
                        <td class="py-2">
                            <button wire:click="toggleStatus({{ $quiz->id }})"
                                class="px-2 py-1 rounded text-xs {{ $quiz->is_active ? 'bg-green-500' : 'bg-gray-500' }} text-white">
                                {{ $quiz->is_active ? 'Active' : 'Inactive' }}
                            </button>

                            <button wire:click="deleteQuiz({{ $quiz->id }})" wire:confirm="Delete this quiz configuration?"
                                class="ml-2 text-red-600 hover:underline text-xs font-bold">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>