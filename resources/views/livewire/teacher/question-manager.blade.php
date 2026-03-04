<div class="max-w-2xl mx-auto bg-white p-8 shadow-lg rounded-xl mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Add New MCQ</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4 shadow">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveQuestion">
        <div class="mb-4">
            <label class="block font-bold">Subject</label>
            <select wire:model="subject_id" class="w-full border-2 p-2 rounded-lg">
                <option value="">Choose...</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold">Question</label>
            <textarea wire:model="question_text" class="w-full border-2 p-2 rounded-lg"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="text" wire:model="option_a" placeholder="Option A" class="border-2 p-2 rounded-lg">
            <input type="text" wire:model="option_b" placeholder="Option B" class="border-2 p-2 rounded-lg">
            <input type="text" wire:model="option_c" placeholder="Option C" class="border-2 p-2 rounded-lg">
            <input type="text" wire:model="option_d" placeholder="Option D" class="border-2 p-2 rounded-lg">
        </div>

        <div class="mb-6">
            <label class="block font-bold">Correct Answer</label>
            <select wire:model="correct_option" class="w-full border-2 p-2 rounded-lg">
                <option value="">Select...</option>
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-800 transition">
            Save Question
        </button>
    </form>
    <div class="mt-10 bg-white p-6 shadow-md rounded-lg">
        <h3 class="text-xl font-bold mb-4">Manage Questions Bank</h3>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-2">Question</th>
                    <th class="p-2">Subject</th>
                    <th class="p-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $q)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-2 text-sm">{{ Str::limit($q->question_text, 50) }}</td>
                        <td class="p-2">
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded">
                                {{ $q->subject->name }}
                            </span>
                        </td>
                        <td class="p-2 text-center space-x-3">
                            {{-- Edit Button --}}
                            <button wire:click="editQuestion({{ $q->id }})"
                                class="text-indigo-600 hover:text-indigo-800 font-bold">
                                Edit
                            </button>

                            {{-- Delete Button --}}
                            <button wire:click="deleteQuestion({{ $q->id }})"
                                wire:confirm="Are you sure you want to delete this?"
                                class="text-red-500 hover:text-red-700 font-bold">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex gap-2">
            <button type="submit"
                class="flex-1 {{ $editing_id ? 'bg-orange-500 hover:bg-orange-600' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white font-bold py-3 rounded-lg transition">
                {{ $editing_id ? 'Update Question ✨' : 'Add Question to Pool 🚀' }}
            </button>

            @if($editing_id)
                <button type="button" wire:click="cancelEdit"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition">
                    Cancel
                </button>
            @endif
        </div>
    </div>
</div>

