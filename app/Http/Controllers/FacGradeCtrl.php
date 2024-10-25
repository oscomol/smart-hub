<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\ClassSubject;
use App\Models\Enrol;
use App\Models\EnteredGrade;
use App\Models\Faculty;
use App\Models\Grade;
use App\Models\Instruc;
use App\Models\Student;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\LogUserActivityTrait;
use Illuminate\Support\Facades\Log;


class FacGradeCtrl extends Controller
{
    use LogUserActivityTrait;
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

            $this->logActivity("Added a new grade and section: Grade $request->grade - $request->section");
          
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

            $this->logActivity("Updated grade and section: Grade $request->grade - $request->section");
          
            return back()->with('success', "Grade updated successfully");
    
           } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
           }
    }

    public function destroy(Request $request){
        try{
            $grade = Grade::find($request->gradeId);
            $this->logActivity("Added a new grade and section: Grade $grade->grade - $grade->section");
            $grade->delete();
            return back()->with('success', "Success");
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

        $students = $students->map(function($item) use($curId){
            
            $studDetails = Student::where('lrn', $item->student_id)->first();

            $subjects = ClassSubject::where('grade_id', $curId)->get();

            $subjects = $subjects->map(function($sub)use($item){

                $grade = EnteredGrade::where('lrn', $item->student_id)
                ->where('grade_id', $sub->id)->first();

                if($grade){
                    $sub->grade = $grade;
                }

                return $sub;
            });

            $studDetails->subject = $subjects;

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
            $subjects = ClassSubject::where('grade_id', $curId)
            ->where('day', $day)->get();
            if($subjects->count() > 0){
                $day['subjects'] = $subjects;
            }
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
                "endAt" => 'required',
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

            return back()->with('success', "Success");

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
            return back()->with('success', "Success");
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

            return back()->with('success', "Success");

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

    public function updateEnroll(Request $request)
    {
        try {
           
            $isEnrolled = Enrol::where('student_id', $request->studentId)->first();
    
            if ($isEnrolled) {
             
                if ($request->id == "0") {
                    $isEnrolled->delete();
                } else {
                 
                    $isEnrolled->update([
                        "grade_id" => $request->id
                    ]);
                }
            } else {
             
                Enrol::create([
                    "grade_id" => $request->id,
                    "student_id" => $request->studentId
                ]);
            }
    
            return back()->with('success', "Success");
    
        } catch (Exception $err) {
            // Log the error message for debugging
            Log::error('Error in updateEnroll: ' . $err->getMessage());
            
      
            return back()->with('error', $err->getMessage());
        }
    }
    

    public function addSubject(Request $request){
        try{

            $validated = $request->validate([
                "subject" => 'required',
                "startTime" => 'required',
                "endTime" => 'required'
            ]);

            $validated["day"] = $request->day;
            $validated["grade_id"] = $request->id;

            ClassSubject::create($validated);

            return back()->with('success', "Success");

        } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
           }
    }

    public function destroySubject(Request $request){
        try{
            ClassSubject::find($request->id)->delete();
            return back()->with('success', "Success");

        }catch (Exception $e) {
            return back()->with('error', "Something went wrong");
           }
    }

    public function addGrade(Request $request){
        try{


            $isExist = EnteredGrade::where('grade_id', $request->subjectId)
            ->where('lrn', $request->studentId)->first();

            if($isExist){
                if($request->grade){
                    $isExist->update([
                        'grade' => $request->grade
                    ]);
                }else{
                    $isExist = EnteredGrade::where('grade_id', $request->subjectId)
                    ->where('lrn', $request->studentId)->first();
    
                    if($isExist){
                        $isExist->delete();
                    }else{
                        return back()->with('error', "Something went wrong");
                    }
                }
            }else{
                EnteredGrade::create([
                    "grade_id" => $request->subjectId,
                    "lrn" => $request->studentId,
                    "grade" => $request->grade
                ]);
            }

            
            return back()->with('success', "Success");
         
        }catch(Exception $err){
            return back()->with('error', "Something went wrong");
        }
    }
}
