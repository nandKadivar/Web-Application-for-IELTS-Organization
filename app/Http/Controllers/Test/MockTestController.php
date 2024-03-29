<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test\ListeningTest;
use App\Models\Test\ReadingTest;
use App\Models\Test\WritingTest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MockTestController extends Controller
{
    public function list(Request $request){
        $listeningTests =  ListeningTest::all();
        $readingTests = ReadingTest::all();
        $writingTask1Tests = WritingTest::where('ielts_module','Writing Task 1')->get();
        $writingTask2Tests = WritingTest::where('ielts_module','Writing Task 2')->get();

        // echo $writingTask1Tests;
        return view('admin.pages.mocktests',['listeningTestList' => $listeningTests, 'readingTestList' => $readingTests, 'WritingTask1TestList' => $writingTask1Tests, 'WritingTask2TestList' => $writingTask2Tests]);
    }
    
    public function store(Request $request){
        if($request->module == 'Listening'){
            
            $request->validate([
                'paper' => ['required','mimes:pdf','max:2048'],
                'audio' => ['required','mimes:mp3','max:50000'],
                'answer' => ['required','mimes:pdf','max:2048']
            ]);

            // $paper_name = $request->file('paper')->getClientOriginalName();
            $paper_path = $request->file('paper')->move('ielts-tests/listening/'.$request->id, 'listening_paper_'.$request->id.'.pdf');
            $audio_path = $request->file('audio')->move('ielts-tests/listening/'.$request->id, 'listening_audio_'.$request->id.'.mp3');
            $answer_path = $request->file('answer')->move('ielts-tests/listening/'.$request->id, 'listening_answer_'.$request->id.'.pdf');
            // echo $paper_path;
            
            $test = new ListeningTest();

            $test->id = $request->id;
            $test->ielts_module = $request->module;
            $test->test_desciption = $request->description;
            // $test->test_paper = $request->description;
            // $test->audio_file = $request->description;
            // $test->answer_key = $request->description;

            $test->test_paper = 'ielts-tests/listening/'.$request->id.'/listening_paper_'.$request->id.'.pdf';
            $test->audio_file = 'ielts-tests/listening/'.$request->id.'/listening_audio_'.$request->id.'.mp3';
            $test->answer_key = 'ielts-tests/listening/'.$request->id.'/listening_answer_'.$request->id.'.pdf';

            $test->save();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Created Successfully!');

        }else if($request->module == 'Reading'){
            
            $request->validate([
                'paper' => ['required','mimes:pdf','max:2048'],
                'answer' => ['required','mimes:pdf','max:2048']
            ]);
            
            $paper_path = $request->file('paper')->move('ielts-tests/reading/'.$request->id, 'reading_paper_'.$request->id.'.pdf');
            $answer_path = $request->file('answer')->move('ielts-tests/reading/'.$request->id, 'reading_answer_'.$request->id.'.pdf');
            
            $test = new ReadingTest();

            $test->id = $request->id;
            $test->ielts_module = $request->module;
            $test->test_desciption = $request->description;
            $test->test_paper = 'ielts-tests/reading/'.$request->id.'/reading_paper_'.$request->id.'.pdf';
            $test->answer_key = 'ielts-tests/reading/'.$request->id.'/reading_answer_'.$request->id.'.pdf';

            $test->save();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Created Successfully!');
        
        }else if($request->module == 'Writing Task 1'){
        
            $request->validate([
                'paper' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
                'sample_answer' => ['mimes:jpg,jpeg,png,pdf', 'max:2048']
            ]);

            $test = new WritingTest();

            $test->id = $request->id;
            $test->ielts_module = $request->module;
            $test->test_desciption = $request->description;

            $paper_extension = $request->file('paper')->extension();
            $request->file('paper')->move('ielts-tests/writing/task 1/'.$request->id, 'writing_task1_paper_'.$request->id.'.'.$paper_extension);

            $test->test_paper = 'ielts-tests/writing/task 1/'.$request->id.'/writing_task1_paper_'.$request->id.'.'.$paper_extension;

            if($request->file('sample_answer')){
                $sample_answer_extension = $request->file('sample_answer')->extension();
                $request->file('sample_answer')->move('ielts-tests/writing/task 1/'.$request->id,'writing_task1_sample_answer_'.$request->id.'.'.$sample_answer_extension);
                
                $test->sample_answer = 'ielts-tests/writing/task 1/'.$request->id.'/writing_task1_sample_answer_'.$request->id.'.'.$sample_answer_extension;
            }

            $test->save();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Created Successfully!');

        } else if($request->module == 'Writing Task 2'){
            
            $request->validate([
                'paper' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
                'sample_answer' => ['mimes:jpg,jpeg,png,pdf', 'max:2048']
            ]);

            $test = new WritingTest();

            $test->id = $request->id;
            $test->ielts_module = $request->module;
            $test->test_desciption = $request->description;

            $paper_extension = $request->file('paper')->extension();
            $request->file('paper')->move('ielts-tests/writing/task 2/'.$request->id,'writing_task2_paper_'.$request->id.'.'.$paper_extension);

            $test->test_paper = 'ielts-tests/writing/task 2/'.$request->id.'/writing_task2_paper_'.$request->id.'.'.$paper_extension;

            if($request->file('sample_answer')){
                $sample_answer_extension = $request->file('sample_answer')->extension();
                $request->file('sample_answer')->move('ielts-tests/writing/task 2/'.$request->id,'writing_task2_sample_answer_'.$request->id.'.'.$sample_answer_extension);
                
                $test->sample_answer = 'ielts-tests/writing/task 2/'.$request->id.'/writing_task2_sample_answer_'.$request->id.'.'.$sample_answer_extension;
            }

            $test->save();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Created Successfully!');

        }else{
            echo "Error in detacting module";
        }
    }

    public function update(Request $request) {
        // echo $module;
        if($request->module == 'Listening'){

            $test = ListeningTest::findOrFail($request->id);
            
            $request->validate([
                'paper' => ['mimes:pdf','max:2048'],
                'audio' => ['mimes:mp3','max:50000'],
                'answer' => ['mimes:pdf','max:2048']
            ]);
            
            $test->test_desciption = $request->description;

            if($request->file('paper')){
                $paper_path = $request->file('paper')->move('ielts-tests/listening/'.$request->id, 'listening_paper_'.$request->id.'.pdf');
                $test->test_paper = 'ielts-tests/listening/'.$request->id.'/listening_paper_'.$request->id.'.pdf';
                // echo "1";
            }

            if($request->file('audio')){
                $audio_path = $request->file('audio')->move('ielts-tests/listening/'.$request->id, 'listening_audio_'.$request->id.'.mp3');
                $test->audio_file = 'ielts-tests/listening/'.$request->id.'/listening_audio_'.$request->id.'.mp3';
                // echo "2";
            }

            if($request->file('answer')){
                $answer_path = $request->file('answer')->move('ielts-tests/listening/'.$request->id, 'listening_answer_'.$request->id.'.pdf');
                $test->answer_key = 'ielts-tests/listening/'.$request->id.'/listening_answer_'.$request->id.'.pdf';
                // echo "3";
            }
            
            $test->save();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Updated Successfully!');
            
        }else if($request->module == 'Reading') {
            
            $test = ReadingTest::findOrFail($request->id);
            
            $request->validate([
                'paper' => ['mimes:pdf','max:2048'],
                'answer' => ['mimes:pdf','max:2048']
            ]);
            
            $test->test_desciption = $request->description;

            if($request->file('paper')){
                $paper_path = $request->file('paper')->move('ielts-tests/reading/'.$request->id, 'reading_paper_'.$request->id.'.pdf');
                $test->test_paper = 'ielts-tests/reading/'.$request->id.'/reading_paper_'.$request->id.'.pdf';
            }

            if($request->file('answer')){
                $answer_path = $request->file('answer')->move('ielts-tests/reading/'.$request->id, 'reading_answer_'.$request->id.'.pdf');
                $test->answer_key = 'ielts-tests/reading/'.$request->id.'/reading_answer_'.$request->id.'.pdf';
            }
            
            $test->save();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Updated Successfully!');
            
        }else if($request->module == 'Writing Task 1') {
            
            $test = WritingTest::findOrFail($request->id);
            
            $request->validate([
                'paper' => ['mimes:jpg,jpeg,png','max:2048'],
                'sample_answer' => ['mimes:jpg,jpeg,png,pdf','max:2048']
            ]);
            
            $test->test_desciption = $request->description;

            if($request->file('paper')){
                $paper_extension = $request->file('paper')->extension();
                $request->file('paper')->move('ielts-tests/writing/task 1/'.$request->id, 'writing_task1_paper_'.$request->id.'.'.$paper_extension);
                $test->test_paper = 'ielts-tests/writing/task 1/'.$request->id.'/writing_task1_paper_'.$request->id.'.'.$paper_extension;
            }

            if($request->file('sample_answer')){
                $sample_answer_extension = $request->file('sample_answer')->extension();
                $request->file('sample_answer')->move('ielts-tests/writing/task 1/'.$request->id,'writing_task1_sample_answer_'.$request->id.'.'.$sample_answer_extension);
                $test->sample_answer = 'ielts-tests/writing/task 1/'.$request->id.'/writing_task1_sample_answer_'.$request->id.'.'.$sample_answer_extension;
            }
            
            $test->save();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Updated Successfully!');
    
        }else if($request->module == 'Writing Task 2'){
            
            $test = WritingTest::findOrFail($request->id);
            
            $request->validate([
                'paper' => ['mimes:jpg,jpeg,png','max:2048'],
                'sample_answer' => ['mimes:jpg,jpeg,png,pdf','max:2048']
            ]);
            
            $test->test_desciption = $request->description;

            if($request->file('paper')){
                $paper_extension = $request->file('paper')->extension();
                $request->file('paper')->move('ielts-tests/writing/task 2/'.$request->id, 'writing_task2_paper_'.$request->id.'.'.$paper_extension);
                $test->test_paper = 'ielts-tests/writing/task 2/'.$request->id.'/writing_task2_paper_'.$request->id.'.'.$paper_extension;
            }

            if($request->file('sample_answer')){
                $sample_answer_extension = $request->file('sample_answer')->extension();
                $request->file('sample_answer')->move('ielts-tests/writing/task 2/'.$request->id,'writing_task2_sample_answer_'.$request->id.'.'.$sample_answer_extension);
                $test->sample_answer = 'ielts-tests/writing/task 2/'.$request->id.'/writing_task2_sample_answer_'.$request->id.'.'.$sample_answer_extension;
            }
            
            $test->save();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Updated Successfully!');
        
        }else{
            echo "Error in detacting module";
        }
    }

    public function destroy($id,$module) {
        // echo $module;
        if($module == 'Listening'){
            $test = ListeningTest::findOrFail($id);

            if(File::exists(public_path('ielts-tests/listening/'.$test->id))){
                // echo "Delete";
                File::deleteDirectory(public_path('ielts-tests/listening/'.$test->id));
            }

            $test->delete();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Deleted Successfully!');
        
        }else if($module == 'Reading') {
            $test = ReadingTest::findOrFail($id);

            if(File::exists(public_path('ielts-tests/reading/'.$test->id))){
                // echo "Delete";
                File::deleteDirectory(public_path('ielts-tests/reading/'.$test->id));
            }

            $test->delete();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Deleted Successfully!');

        }else if($module == 'Writing Task 1'){
            $test = WritingTest::findOrFail($id);

            if(File::exists(public_path('ielts-tests/writing/task 1/'.$test->id))){
                // echo "Delete";
                File::deleteDirectory(public_path('ielts-tests/writing/task 1/'.$test->id));
            }

            $test->delete();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Deleted Successfully!');

        }else if($module == 'Writing Task 2'){
            $test = WritingTest::findOrFail($id);

            if(File::exists(public_path('ielts-tests/writing/task 2/'.$test->id))){
                // echo "Delete";
                File::deleteDirectory(public_path('ielts-tests/writing/task 2/'.$test->id));
            }

            $test->delete();

            return redirect()->route('admin.mocktests')->with('status', 'Mock Test Deleted Successfully!');

        }else{
            echo "Error in detacting module";
        }
    }
}
