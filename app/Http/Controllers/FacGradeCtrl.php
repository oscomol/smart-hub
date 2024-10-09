<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\Grade;
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


        $curId = $request->id;

        $grade = Grade::find($curId);

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
        

        return view("faculty.schedules", compact('grades', 'days', 'curId', 'grade'));
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
}
