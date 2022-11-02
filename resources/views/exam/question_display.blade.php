@extends('user.master')
@section('index')
<div class="content-wrapper">
    <div class="container-full">
        @php
        $alphabet = range('A', 'Z');
        $count_answer = count($exam['correct_answers']);
        $correct_options=[];
        print_r($exam['correct_answers']);
        print_r(Session::get('question_count'));
        echo "results::::::";
        print_r(Session::get('results'));
        @endphp
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Test</h4>
                    </div>
                    <div class="box-body">

                        <form action="{{route('testSession')}}" method="post">
                            @csrf

                            <div class="form-check">
                                <label for="exampleFormControlTextarea1" disabled
                                    class="form-label">{{$exam['question']}}</label>

                            </div>

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


                                <input type="checkbox" id="md_checkbox_{{$key}}" name="selected_options[]"
                                    class="chk-col-primary" value="{{$key}}">
                                <label for="md_checkbox_{{$key}}">{{$option}}</label>
                                <input type="hidden" name="correct_answer[]" value="{{$correct_options[$key]}}">


                                @endforeach
                            </div>



                            <button class="btn btn-success mb-5" type=submit>Next Question</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>




@endsection


<div class="flex justify-center">
    <div class="rounded-lg shadow-lg bg-white max-w-sm">
        <a href="#!">
            <img class="rounded-t-lg" src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" alt="" />
        </a>
        <div class="p-6">
            <h5 class="text-gray-900 text-xl font-medium mb-2">Card title</h5>
            <p class="text-gray-700 text-base mb-4">
                Some quick example text to build on the card title and make up the bulk of the card's
                content.
            </p>
            <button type="button"
                class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Button</button>
        </div>
    </div>
</div>