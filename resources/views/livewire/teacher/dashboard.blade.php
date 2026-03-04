<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-3xl font-black text-gray-800 mb-8">Teacher Control Panel</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('teacher.questions') }}" class="group p-8 bg-white border-2 border-indigo-50 rounded-3xl shadow-sm hover:border-indigo-500 transition-all duration-300">
            <div class="h-14 w-14 bg-indigo-100 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Manage Questions</h2>
            <p class="text-gray-500 mt-2">Add, edit or delete MCQs for different subjects.</p>
        </a>

        <a href="{{ route('teacher.quizzes') }}" class="group p-8 bg-white border-2 border-indigo-50 rounded-3xl shadow-sm hover:border-indigo-500 transition-all duration-300">
            <div class="h-14 w-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Manage Quizzes</h2>
            <p class="text-gray-500 mt-2">Create new quizzes and set time limits.</p>
        </a>
    </div>
</div>