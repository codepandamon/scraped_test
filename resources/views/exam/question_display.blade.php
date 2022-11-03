@extends('user.master')
@section('index')






<style>
.check {

    margin: 10px 30px;


}

.options {
    display: block;

}

.exam_card {
    border: 1px solid;
    border-color: coral;
    margin: 20px;
}

.time {


    margin-left: 1353px;

}
</style>
@php
$alphabet = range('A', 'Z');
$count_answer = count($exam['correct_answers']);
$correct_options=[];
print_r($exam['correct_answers']);
print_r(Session::get('question_count'));


@endphp
<div class="resultDisplay">CurrentResult: {{Session::get('results')}}</div>
<div class="time"></div>
<form action="{{route('testSession')}}" method="post">
    @csrf
    <section class="text-gray-600 body-font overflow-hidden exam_card">
        <div class="container px-5 py-24 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                        <span class="font-semibold title-font text-gray-700">
                            Question no:
                            {{Session::get('question_count')}}
                        </span>


                    </div>
                    <div class="md:flex-grow">
                        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{$exam['question']}}</h2>
                        <p class="leading-relaxed"></p>
                        <div class="demo-checkbox">
                            @foreach($exam['options'] as $key=>$option)
                            @php
                            array_push($exam['correct_answers'],"");
                            if($exam['correct_answers'][$key]!=null){
                            $correct_options[$key] = array_search($exam['correct_answers'][$key], $alphabet);
                            }
                            else{
                            $correct_options[$key]=null;
                            }

                            @endphp
                            <div class="options">


                                <input class="check" type="checkbox" id="md_checkbox_{{$key}}" name="selected_options[]"
                                    class="chk-col-primary" value="{{$key}}">
                                <label for="md_checkbox_{{$key}}">{{$option}}</label>
                                <input type="hidden" name="correct_answer[]" value="{{$correct_options[$key]}}">
                            </div>


                            @endforeach
                        </div>
                        <button type=submit class="text-indigo-500 inline-flex items-center mt-4">Next Question
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>
</form>
<script>
let timer_session = setInterval(timer_local, 1000);

function timer_local() {
    let test = 100;
    let timer;
    if (localStorage.getItem("timer") == null) {
        localStorage.setItem("timer", test);


    }
    timer = localStorage.getItem("timer");
    timer = timer - 1;
    localStorage.setItem("timer", timer);

    if (localStorage.getItem("timer") <= 0 || localStorage.getItem("timer") == null) {
        clearInterval(timer_session);
        localStorage.clear();
        window.location.href = "{{ route('finishSession')}}"

    }
    document.querySelector(".time").innerHTML = "Time Left:" + localStorage.getItem('timer');


}
</script>



@endsection