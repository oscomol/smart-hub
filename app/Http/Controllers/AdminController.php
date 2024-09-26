<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\AcademicRecord;
use App\Models\MedicalRecord;
use App\Models\DisciplinaryRecord;
use App\Models\Faculty; 
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

    #store academic records
    public function storeAcademic(Request $request, $studentId)
    {
        $request->validate([
            'preschool_name' => 'required|string|max:255',
            'preschool_year_graduated' => 'required|string|max:255',
            'preschool_awards' => 'nullable|string|max:255',
            'elementary_school_name' => 'required|string|max:255',
            'elementary_year_graduated' => 'required|string|max:255',
            'elementary_awards' => 'nullable|string|max:255',
        ]);

        $academicRecord = new AcademicRecord();
        $academicRecord->student_id = $studentId;
        $academicRecord->preschool_name = $request->preschool_name;
        $academicRecord->preschool_year_graduated = $request->preschool_year_graduated;
        $academicRecord->preschool_awards = $request->preschool_awards;
        $academicRecord->elementary_school_name = $request->elementary_school_name;
        $academicRecord->elementary_year_graduated = $request->elementary_year_graduated;
        $academicRecord->elementary_awards = $request->elementary_awards;
        $academicRecord->save();

        return redirect()->back()->with('success', 'Academic record added successfully.');
      
    }

    #Store Medical Record
    public function storeMedical(Request $request, $studentId)
    {
        $request->validate([
            'allergies' => 'required|string|max:255',
            'medical_conditions' => 'required|string|max:255',
            'current_medication' => 'required|string|max:255',
            'physician_name' => 'required|string|max:255',
            'physician_contact_number' => 'required|string|max:255',
        ]);

        $medicalRecord = new MedicalRecord();
        $medicalRecord->student_id = $studentId;
        $medicalRecord->allergies = $request->allergies;
        $medicalRecord->medical_conditions = $request->medical_conditions;
        $medicalRecord->current_medication = $request->current_medication;
        $medicalRecord->physician_name = $request->physician_name;
        $medicalRecord->physician_contact_number = $request->physician_contact_number;
        $medicalRecord->save();

        return redirect()->back()->with('success', 'Medical record added successfully.');
       
    }

    #Store Disciplinary Record
    public function storeDisciplinary(Request $request, $studentId)
    {
        $request->validate([
            'incident_date' => 'required|date',
            'incident_description' => 'required|string',
            'action_taken' => 'required|string',
        ]);

        $disciplinaryRecord = new DisciplinaryRecord();
        $disciplinaryRecord->student_id = $studentId;
        $disciplinaryRecord->incident_date = $request->incident_date;
        $disciplinaryRecord->incident_description = $request->incident_description;
        $disciplinaryRecord->action_taken = $request->action_taken;
        $disciplinaryRecord->save();

        return redirect()->back()->with('success', 'Disciplinary record added successfully.');
       
    }

    #Show records for a student
    public function show($id) {
        // Fetch the student with guardian info
        $student = Student::with('guardian')->findOrFail($id);
    
        // Fetch the related records
        $academicRecords = AcademicRecord::where('student_id', $id)->get();
        $medicalRecords = MedicalRecord::where('student_id', $id)->get();
        $disciplinaryRecords = DisciplinaryRecord::where('student_id', $id)->get();
    
        // Pass all records to the view
        return view('admin.student_show', compact('student', 'academicRecords', 'medicalRecords', 'disciplinaryRecords'));
    }
    
    #======= FACULTY MAMANAGEMENT  ==============
    public function faculty() {
        $faculties = Faculty::all();
        return view('admin.faculty', compact('faculties'));
    }
     #to show individual faculty details
     public function showFacultyDetails($id) {
        $faculty = Faculty::findOrFail($id);
        return view('admin.faculty-details', compact('faculty'));
    }

    # store new faculty record
    public function storeNewFaculty(Request $request) {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:faculties,email|max:255',
            'faculty_id' => 'required|string|unique:faculties,faculty_id|max:20',
            'degree' => 'required|string|max:100',
            'specialization' => 'required|string|max:100',
            'university' => 'required|string|max:100',
            'graduation_year' => 'required|integer|min:1900|max:2100',
            'certification' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'employment_date' => 'required|date',
            'current_position' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'employment_type' => 'required|string|max:50',
            'experience' => 'nullable|string',
            'development_activities' => 'nullable|string',
            'workshops' => 'nullable|string',
            'conferences' => 'nullable|string',
            'research' => 'nullable|string',
            'awards' => 'nullable|string',
        ], [
            'email.unique' => 'The email has already been taken. Please use a different email.',
            'faculty_id.unique' => 'The Faculty ID has already been taken. Please use a different Faculty ID.',
        ]);
    
        // Create a new Faculty instance and fill it with the request data
        $faculty = new Faculty();
        $faculty->fill($request->all());
        $faculty->save();
    
        // Redirect back with success message
        return redirect()->route('admin.faculty')->with('success', 'Faculty record created successfully.');

    }

    
    

    public function create()
    {
        // Return the view for adding a new faculty
        return view('admin.add_faculty'); // Adjust this to your actual view file
    
    }


    
    #========== END HERE =========================

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
