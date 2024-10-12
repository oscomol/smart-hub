<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\Enrol;
use App\Models\Faculty;
use App\Models\Grade;
use App\Models\Instruc;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FacGradeCtrl extends Controller
{
    public function index(){
        $grades = Grade::all();

        return view("faculty.sectionXSched", compact('grades'));
    }

    public function store(Request $request){
        try{

            $validated = $request->validate([
                "grade" => 'required',
                "section" => 'required'
            ]);

            $grade = Grade::create($validated);
          
            return back()->with('success', "Grade updated successfully");
    
           } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
           }
    }

    public function edit(Request $request){
        try{

            $validated = $request->validate([
                "grade" => 'required',
                "section" => 'required'
            ]);

            $grade = Grade::find($request->id)->update($validated);
          
            return back()->with('success', "Grade updated successfully");
    
           } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
           }
    }

    public function destroy(Request $request){
        try{
            Grade::find($request->gradeId)->delete();
            return back()->with('success', "Memo deleted successfully");
        }catch(Exception){
            return back()->with('error', "Something went wrong");
        }
    }

    public function shedule(Request $request){
        $grades = Grade::all();

        $faculties = Faculty::all();

        $curId = $request->id;

        $grade = Grade::find($curId);

        $instructor = Instruc::where('grade_id', $curId)->first();

        if($instructor){
            $instructor = Faculty::where('id', $instructor->instructor_id)->first();
        }

        $students = Enrol::where('grade_id', $curId)->get();

        $students = $students->map(function($item){
            $studDetails = Student::where('lrn', $item->student_id)->first();

            return $studDetails;
        });

        $days = [
            ["day" => "Monday", "startAt" => null, "endAt" => null],
            ["day" => "Tuesday", "startAt" => null, "endAt" => null],
            ["day" => "Wednesday", "startAt" => null, "endAt" => null],
            ["day" => "Thursday", "startAt" => null, "endAt" => null],
            ["day" => "Friday", "startAt" => null, "endAt" => null],
        ]; 
        
        $days = array_map(function($day) use ($curId) {
            $sched = ClassSchedule::where('day', $day['day'])
                ->where('grade_id', $curId)
                ->first();
            if ($sched) {
                $day['startAt'] = $sched->startAt;
                $day['endAt'] = $sched->endAt;
            }
        
            return $day;
        }, $days);
        

        return view("faculty.schedules", compact('grades', 'days', 'curId', 'grade', 'faculties', 'instructor', 'students'));
    }

    public function updateSchedule(Request $request){
        try{
            
            $validated = $request->validate([
                "startAt" => 'required',
                "endAt" => 'required'
            ]);

            $isExist = ClassSchedule::where('grade_id', $request->gradeId)
            ->where('day', $request->day)->first();

            $validated['grade_id'] = $request->gradeId;
            $validated['day'] = $request->day;

            if($isExist){
                $isExist->update($validated);
            }else{
                ClassSchedule::create($validated);
            }

            return back()->with('success', "Memo deleted successfully");

        } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
           }
    }

    public function destroySchedule(Request $request){
        try{
            ClassSchedule::where('grade_id', $request->id)
            ->where('day', $request->day)
            ->delete();
            return back()->with('success', "Memo deleted successfully");
        }catch(Exception){
            return back()->with('error', "Something went wrong");
        }
    }

    public function updateInstructor(Request $request){
        try{

            $isExist = Instruc::where('grade_id', $request->id)->first();

            if($isExist){
                $isExist->update(["instructor_id" => $request->instructorId]);
            }else{
                Instruc::create([
                    "grade_id" => $request->id,
                    "instructor_id" => $request->instructorId
                ]);
            }

            return back()->with('success', "Memo deleted successfully");

        }catch(Exception){
            return back()->with('error', "Something went wrong");
        }
    }

    public function studentIndex(){

        $students = Student::all();
        $grades = Grade::all();

        $students = $students->map(function($item){

            $enrol = Enrol::where('student_id', $item->lrn)->first();

            if($enrol){
                $item->grade = Grade::where('id', $enrol->grade_id)->first();
            }

            return $item;
        });

        return view("faculty.students", compact('students', 'grades'));
    }

    public function updateEnroll(Request $request){
        try{
            
            
            $isEnrolled = Enrol::where('student_id', $request->studentId)->first();

            if($isEnrolled){
                if($request->id == "0"){
                    $isEnrolled->delete();
                }else{
                    $isEnrolled->update([
                        "grade_id" => $request->id
                    ]);
                }
            }else{
                Enrol::create([
                    "grade_id" => $request->id, "student_id" => $request->studentId
                ]);
            }

            return back()->with('success', "Success");

        }catch(Exception $err){
            return back()->with('error', "Something went wrong");
        }
    }
}
