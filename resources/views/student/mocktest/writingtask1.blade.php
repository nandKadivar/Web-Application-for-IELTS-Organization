@extends('layouts.app')

@section('title')
Writing Task 1
@endsection

@section('content')
    <main class="row col-md-12" onload="startTimer()">
        <div class="col-md-8" style="background-color: #fff">
            <div class="d-flex col-md-12 flex-row align-items-center" style="padding: 20px">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard" style="color: #333">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('student.mocktest.dashboard')}}" style="color: #333">Mock Test</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Writing Task 1</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12" style="padding: 20px">
                <form id="writing-task1-test" action="">
                    @csrf
                    <textarea class="text-editor" cols="10" rows="10" placeholder="Write your response here ..."></textarea>
                    <div class="d-flex flex-row align-items-center justify-content-between col-md-12">
                        <div class="d-flex flex-row align-items-center col-md-4" style="background-color: #ececec; border-radius: 5px; padding: 10px; padding-left: 15px;">
                            <i class="fas fa-upload" style="color: #333; font-size: 20px;"></i>                      
                            <input id="file-upload" class="file-upload" type="file" name="fileUpload" />
                        </div>
                        <input class="btn btn-primary" style="background-color: #1F3BB3;" type="submit" value="Hand over">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column align-items-center" style="background-color: #f5f5f5">
            <div class="col-md-10 d-flex flex-row align-items-center justify-content-between" style="padding-top: 20px">
                <div class="menu-btn active" id="1" onclick="showQuestion()">
                    <span class="menu-btn-text">Question</span>
                </div>
                <div class="menu-btn" id="2" onclick="showResult()">
                    <span class="menu-btn-text">Result & Feedback</span>
                </div>
                <div class="menu-btn">
                    <span class="menu-btn-text" id="min">25</span>
                    <span class="menu-btn-text" id="timer">:</span>
                    <span class="menu-btn-text" id="sec">00</span>
                </div>
            </div>
            <div class="col-md-10 question-card" id="div1" style="margin-top: 20px">
                <div class="instruction-container">
                    <p class="instruction">
                        You should spend about 20 minutes on this task. Write about the chart/table below. You should write at least 150 words.
                    </p>
                </div>
                <div class="question-container">
                    <p class="question">
                        The two pie charts below show the online shopping sales for retail sectors in Canada in 2005 and 2010. Summarise the information by selecting and reporting the main features, and make comparisons where relevant. <br> Write at least 150 words.
                    </p>
                </div>
                <div class="question-image-container">
                    <img src="/{{request()->p}}" class="question-image" style="width: 100%;height:100%" />
                </div>
            </div>

            <div id="div2" style="result-container">
                
            </div>
        </div>
    </main>

    <script>
        // function startTimer(){
            var m = document.getElementById('min').innerHTML;
            var s = document.getElementById('sec').innerHTML;
            // alert(m);
            setInterval(function(){
                if(s==00 && m==00){
                    alert('Time up');
                    document.getElementById("writing-task1-test").submit();
                }
                else if(s==00 && m>=01){
                    s=59;
                    m-=1;
                    document.getElementById('min').innerHTML = m.toString().padStart(2,"0"); 
                    document.getElementById('sec').innerHTML = s.toString().padStart(2,"0"); 
                }
                else{
                    s-=1;
                    document.getElementById('sec').innerHTML = s.toString().padStart(2,"0"); 
                }
            },1000)
        // }
    </script>
@endsection