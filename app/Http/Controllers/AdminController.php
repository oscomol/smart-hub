<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index() { #function to view dasboard
        return view('admin.dashboard'); 
    }

    #== STUDENT MANAGEMENT START HERE
    public function student() {
        $students = Student::with('guardian')->get();
        return view('admin.student', compact('students'));
    }

    #Function to insert data to students table and Guardians
    public function store(Request $request)
    { #validate first before inserting
        $validator = Validator::make($request->all(), [
            'lrn' => 'required|string|max:12|unique:students',
            'name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'birth_date' => 'required|date',
            'mother_tongue' => 'required|string|max:255',
            'ip_ethnic_group' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'learning_modality' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        #Create Guardian record
        $guardian = Guardian::create([
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'relationship' => $request->relationship,
        ]);

        #Create Student record
        $student = Student::create([
            'lrn' => $request->lrn,
            'name' => $request->name,
            'sex' => $request->sex,
            'birth_date' => $request->birth_date,
            'mother_tongue' => $request->mother_tongue,
            'ip_ethnic_group' => $request->ip_ethnic_group,
            'religion' => $request->religion,
            'barangay' => $request->barangay,
            'municipality' => $request->municipality,
            'guardian_id' => $guardian->id, #Set the foreign key
            'contact_number' => $request->contact_number,
            'learning_modality' => $request->learning_modality,
            'remarks' => $request->remarks,
        ]);

        return redirect()->back()->with('success', 'Student information saved successfully.');
    }

    #Funtion to Update the tables
    public function updateStudent(Request $request, $id)
    {
        #Validate the request data
        $validator = Validator::make($request->all(), [
            'lrn' => 'required|string|max:12|unique:students,lrn,' . $id,
            'name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'birth_date' => 'required|date',
            'mother_tongue' => 'required|string|max:255',
            'ip_ethnic_group' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'learning_modality' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        #Update the student and guardian data
        $student = Student::findOrFail($id);
        $student->update($request->only([
            'lrn', 'name', 'sex', 'birth_date', 'mother_tongue', 'ip_ethnic_group', 
            'religion', 'barangay', 'municipality', 'contact_number', 
            'learning_modality', 'remarks'
        ]));

        #Update Guardian data
        $guardian = Guardian::findOrFail($student->guardian_id);
        $guardian->update($request->only([
            'father_name', 'mother_name', 'relationship'
        ]));

        return redirect()->back()->with('success', 'Student information updated successfully.');
    }

    #fucntion to delete specific data
    public function destroyStudent($id)
    {
        #Find the student and related guardian
        $student = Student::findOrFail($id);
        $guardian = Guardian::findOrFail($student->guardian_id);
        
        #Delete the records
        $student->delete();
        $guardian->delete();

        return redirect()->back()->with('success', 'Student information deleted successfully.');
    }


    #show function for viewing student info
    public function show($id) {
        $student = Student::with('guardian')->findOrFail($id); #Fetch the student with guardian info
        return view('admin.student_show', compact('student'));
    }
    
    public function faculty() {
        return view('admin.faculty');
    }

    public function staff() {
        return view('admin.staff');
    }

    public function account() {
        $users = User::all(); #Fetch all users
        return view('admin.account', compact('users'));
    }

    public function reports() {
        return view('admin.reports');
    }

    public function settings() {
        return view('admin.settings');
    }


    #Method to handle the registration of new users
    public function register(Request $request)
    {
        #Validate the request
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'lrn' => 'nullable|numeric', // Only for student type
            'password' => 'required|string|min:6|confirmed',
            'userType' => 'required|string|in:administrator,faculty,staff,student,parents',
        ]);
    
        #Create a new user
        $userData = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'userType' => $request->userType,
        ];
    
        #Include 'lrn' only if the userType is 'student'
        if ($request->userType === 'student') {
            $userData['lrn'] = $request->lrn;
        }
    
        User::create($userData);
    
        return redirect()->back()->with('success', 'User registered successfully.');
    }
      #Method to show edit user form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    #Method to update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        #Validate the request
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'lrn' => 'nullable|numeric',
            'password' => 'nullable|string|min:6|confirmed',
            'userType' => 'required|string|in:admin,faculty,staff,student,parents',
        ]);

        # Update user data
        $user->username = $request->username;
        $user->lrn = $request->lrn;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->userType = $request->userType;

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }
    #Method to delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    
}
