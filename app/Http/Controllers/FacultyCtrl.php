<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Qualification;
use App\Models\Student;
use App\Models\TeachingAssign;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FacultyCtrl extends Controller
{
    public function index(){
        $user = auth()->user();
        $faculties = Faculty::all();

        return view("faculty.faculty", compact('user', 'faculties'));
    }

    public function show(Request $request){
        $user = auth()->user();
        $faculty = Faculty::find($request->id);

        return view("faculty.singFaculty", compact('user', 'faculty'));
    }
    public function editView(Request $request){
        $user = auth()->user();
        $faculty = Faculty::find($request->id);

        return view("faculty.editFaculty", compact('user', 'faculty'));
    }

    public function update(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required',
                'birth' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'phone' => 'required|string|max:15',
                'email' => 'required|email',
                'faculty_id' => 'required',
                'degree' => 'required',
                'specialization' => 'required',
                'university' => 'required',
                'graduation_year' => 'required|integer|min:1900|max:2100',
                'certification' => 'nullable',
                'language' => 'nullable',
                'employment_date' => 'required|date',
                'current_position' => 'required',
                'department' => 'required',
                'employment_type' => 'required|string|max:50',
                'experience' => 'nullable|string',
                'development_activities' => 'nullable|string',
                'workshops' => 'nullable|string',
                'conferences' => 'nullable|string',
                'research' => 'nullable|string',
                'awards' => 'nullable|string',
            ]);

            $faculty = Faculty::find($request->id);
             if($faculty){
                $faculty->update($validated);
             }

             return redirect('/faculty/' . $request->id)->with('success', 'Update success');

        } catch (ValidationException) {
            return back()->with("error", "Some fields may not be valid");
        } catch (Exception){
            return back()->with("error", "Server error. Unable to update!");
        }
    }

    public function qualificationShow(Request $request){
        $faculty = Faculty::find($request->id);
        $qualifications = Qualification::where("faculty_id", $request->id)->get();
        return view("faculty.manageQualification", compact("qualifications", "faculty"));
    }

    public function addQualification(Request $request){
        if($request->qualification){
            $qualification = Qualification::create([
                "faculty_id" => $request->faculty_id,
                "qualification" => $request->qualification
            ]);
            if($qualification){
                return back()->with("success", "Qualification added");
            }
            return back()->with("error", "Server error");
        }else{
            return back()->with("error", "Some fields may not be valid");
        }
    }

    public function deleteQualification(Request $request){
        try {
           Qualification::find($request->qualification_id)->delete();
           return back()->with("success", "Qualification deleted");
        } catch (Exception $err) {
            return back()->with("error", "Server error");
        }
    }

    public function updateQualification(Request $request){
       try {
        Qualification::find($request->qualification_id)->update(["qualification" => $request->qualification]);
        return back()->with("success", "Qualification updated");
       } catch (Exception $err) {
        return back()->with("error", "Server error");
       }
    }

    public function teachingAssignShow(Request $request){
        $faculty = Faculty::find($request->id);
        $assingments = TeachingAssign::where("faculty_id", $request->id)->get();
        return view("faculty.manageTAssignment", compact("assingments", "faculty"));
    }

    public function addAssignment(Request $request){
       try {
        TeachingAssign::create(["faculty_id" => $request->faculty_id, "assignment" => $request->assignment]);
        return back()->with("success", "Qualification updated");
       } catch (Exception $err) {
        return back()->with("error", "Server error");
       }
    }

    public function deleteAssignment(Request $request){
        try {
            TeachingAssign::find($request->assignment_id)->delete();
            return back()->with("success", "Assignment deleted");
        } catch (Exception $err) {
            return back()->with("error", "Server error");
        }
    }

    public function updateAssignment(Request $request){
        try {
         TeachingAssign::find($request->assignment_id)->update(["assignment" => $request->assignment]);
         return back()->with("success", "assignment updated");
        } catch (Exception $err) {
         return back()->with("error", "Server error");
        }
     }

     public function facultyDash(Request $request){
        $facultyCount = User::where("userType", "faculty")->count();
        $studentCount = User::where("userType", "student")->count();
        $parentsCount = User::where("userType", "parents")->count();
        $staffCount = User::where("userType", "staff")->count();

        $recentFaculty = Faculty::latest()->limit(10)->get();
        $recentStudent = Student::latest()->limit(8)->get();

        return view("faculty.dashboard", compact('facultyCount', 'studentCount', 'parentsCount', 'staffCount', 'recentFaculty', 'recentStudent'));
     }
}
