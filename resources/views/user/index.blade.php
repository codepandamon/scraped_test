@extends('user.master')
@section('index')
<style>
#exams {
    width: 400px;
    margin: 0px 550px;
}

#countries {
    width: 400px;
    margin-top: 50px;
    margin-left: 550px;
}
</style>
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
            <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1">Welcome</h2>
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Test Your Aptitude
            </h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">We have a variety of tests</p>
        </div>
        <div class="flex flex-wrap">
            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">IELTS</h2>
                <p class="leading-relaxed text-base mb-4">IELTS is developed to provide a fair and accurate assessment
                    of English language proficiency. Test questions are developed by language specialists from
                    Australia, Canada, New Zealand, the UK and the USA. The test covers four sections: Listening,
                    Reading, Writing and Speaking.</p>
                <a target="_blank" href="https://www.ielts.org/" class="text-indigo-500 inline-flex items-center">Learn
                    More
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">TOEFL</h2>
                <p class="leading-relaxed text-base mb-4">The TOEFL iBT test helps you stand out confidently in English.
                    It's the only test that measures all four academic English skills — reading, listening, speaking and
                    writing — the way they are actually used in a classroom, so you can be confident you'll stand out to
                    universities where it counts.</p>
                <a target="_blank" href="https://www.ets.org/toefl/score-users/ibt/about.html"
                    class="text-indigo-500 inline-flex items-center">Learn More
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">GRE</h2>
                <p class="leading-relaxed text-base mb-4">What is GRE exam used for?
                    The GRE General Test is a standardized test created and administered by the Educational Testing
                    Service, commonly known as ETS, that is designed to measure overall academic readiness for graduate
                    school.</p>
                <a target="_blank" href="https://www.ets.org/gre/test-takers/general-test/about.html"
                    class="text-indigo-500 inline-flex items-center">Learn More
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">SAT</h2>
                <p class="leading-relaxed text-base mb-4">SAT is a standardized test administered by the College Board
                    and is required to be taken by students seeking admission to undergraduate schools. The full form of
                    SAT is the Scholastic Assessment Test, which was earlier known as the Scholastic Aptitude Test.</p>
                <a target="_blank"
                    href="https://studyabroad.shiksha.com/exams/sat#:~:text=SAT%20is%20a%20standardized%20test,as%20the%20Scholastic%20Aptitude%20Test."
                    class="text-indigo-500 inline-flex items-center">Learn More
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>


        <form action="{{route('testSession')}}" method="post">
            @csrf

            <label for="countries" id="countries"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select a test
                type
            </label>
            <select id="exams" name="examType"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected="" disabled>Choose a test</option>
                <option value="ielts" disabled>IELTS</option>
                <option value="toefl" disabled>TOEFL</option>
                <option value="gre">GRE</option>
                <option value="sat" disabled>SAT</option>
            </select>

            <input type="hidden" name="no_of_questions" value="0">
            <input type="hidden" name="question_count" value="start">
            <button type=submit
                class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Start
                Test</button>
        </form>

    </div>
</section>
@endsection