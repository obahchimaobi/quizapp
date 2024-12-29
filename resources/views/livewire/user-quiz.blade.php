<div>
    {{-- quizSetupInProgress form Starts here --}}

    @if ($quizSetupInProgress)
        <div class="grid grid-cols-1 gap-4 2xl:grid-cols-2 lg:gap-8">
            <div class="rounded-lg">
                <form wire:submit.prevent="initializeQuiz">
                    {{ $this->preQuizForm }}
                    <x-filament-actions::modals />
                </form>
            </div>
        </div>
    @endif
    {{-- quizSetupInProgress form Ends here --}}

    {{-- quizInProgress form Starts here --}}
    @if ($quizInProgress)

        <div class="px-4 -py-3 sm:px-6 ">
            <div class="flex max-w-auto justify-between p-10">
                <h1 class="text-sm leading-6 font-medium text-gray-900">
                    <span class="text-gray-400 font-extrabold p-1">Quiz User</span>
                    <span
                        class="font-bold p-1 leading-loose bg-blue-500 text-white rounded-lg">{{ Auth::user()->name }}</span>
                </h1>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    <span class="text-gray-400 font-extrabold p-1">Quiz Progress </span>
                    <span
                        class="font-bold p-3 leading-loose bg-blue-500 text-white rounded-full">{{ $quizQuestionCounter . '/' . $currentQuizSize }}</span>
                </p>
            </div>
        </div>
        <div class=" shadow overflow-hidden sm:rounded-lg mt-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 mb-2 font-medium text-gray-900">
                    <span class="mr-2 font-extrabold"> {{ $quizQuestionCounter }}</span> {!! nl2br(e($currentQuestion->question)) !!}
                    @if ($learningMode)
                        <x-explanation>
                            {!! nl2br(e($currentQuestion->explanation)) !!}
                        </x-explanation>
                    @endif
                </h3>
                @if ($currentQuestion->getMedia('questions')->first())
                    <x-displayImage>
                        <img alt="Section Image" src="{{ $currentQuestion->getMedia('questions')->first()->getUrl() }}"
                            class="h-full w-full rounded-xl object-cover shadow-xl transition group-hover:grayscale-[50%]" />
                    </x-displayImage>
                @endif
            </div>

            <div class="p-10">
                <form wire:submit.prevent="startQuiz">
                    {{ $this->quizForm }}
                    <div class="mt-10">
                        <x-filament::button type="submit" size="lg">
                            Next Question
                        </x-filament::button>
                    </div>
                </form>
                <x-filament-actions::modals />
            </div>
        </div>

    @endif
    {{-- quizInProgress form Ends here --}}

    {{-- quizHasEnded form Starts here --}}
    @if ($quizHasEnded)
        <section class="text-gray-600 body-font">
            <div class="bg-white border-2 border-gray-300 shadow overflow-hidden sm:rounded-lg">
                <div class="container px-5 py-5 mx-auto">
                    <div class="text-center mb-5 justify-center">
                        <h1 class=" sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">Quiz
                            Result</h1>
                        <p class="text-md mt-10"> Dear <span class="font-extrabold text-blue-600 mr-2">
                                {{ Auth::user()->name . '!' }} </span> You have secured <a
                                class="bg-green-300 px-2 mx-2 hover:green-400 rounded-lg underline"
                                href="{{ route('filament.member.pages.quiz-detail-page', ['record' => $currentquizHeader->id]) }}">Show
                                quiz details</a></p>
                        <div>
                            <span id="ProgressLabel" class="sr-only">Loading</span>

                            <span role="progressbar" aria-labelledby="ProgressLabel"
                                aria-valuenow="{{ $quizPecentage }}" class="block rounded-full bg-gray-200">
                                <span class="block h-4 rounded-full bg-indigo-600 text-center text-[10px]/4"
                                    style="width: {{ $quizPecentage }}%">
                                    <span class="rounded-sm bg-white px-0.5 font-bold text-indigo-600">
                                        {{ $quizPecentage }}%
                                    </span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
                        <div class="p-2 sm:w-1/2 w-full">
                            <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                <svg fill=" none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4"
                                    viewBox="0 0 24 24">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                    <path d="M22 4L12 14.01l-3-3"></path>
                                </svg>
                                <span class="title-font font-medium mr-5 text-purple-700">Correct Answers</span><span
                                    class="title-font font-medium">{{ $currectQuizAnswers }}</span>
                            </div>
                        </div>
                        <div class="p-2 sm:w-1/2 w-full">
                            <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4"
                                    viewBox="0 0 24 24">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                    <path d="M22 4L12 14.01l-3-3"></path>
                                </svg>
                                <span class="title-font font-medium mr-5 text-purple-700">Total Questions</span><span
                                    class="title-font font-medium">{{ $totalQuizQuestions }}</span>
                            </div>
                        </div>
                        <div class="p-2 sm:w-1/2 w-full">
                            <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="3"
                                    class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                    <path d="M22 4L12 14.01l-3-3"></path>
                                </svg>
                                <span class="title-font font-medium mr-5 text-purple-700">Percentage Scored</span><span
                                    class="title-font font-medium">{{ $quizPecentage . '%' }}</span>
                            </div>
                        </div>
                        <div class="p-2 sm:w-1/2 w-full">
                            <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="3"
                                    class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                    <path d="M22 4L12 14.01l-3-3"></path>
                                </svg>
                                <span class="title-font font-medium mr-5 text-purple-700">Quiz Status</span><span
                                    class="title-font font-medium">{{ $quizPecentage > 70 ? 'Pass' : 'Fail' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto min-w-full p-2 md:flex m-2 justify-between">
                        <a href="{{ route('filament.member.pages.quiz-detail-page', ['record' => $currentquizHeader->id]) }}"
                            class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">See
                            Quizzes Details</a>
                        <a href="{{ route('filament.member.resources.my-quizzes.index') }}"
                            class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">See
                            All Your Quizzes</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{-- quizHasEnded form Ends here --}}

</div>
