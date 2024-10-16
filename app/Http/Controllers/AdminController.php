<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\AcademicRecord;
use App\Models\MedicalRecord;
use App\Models\DisciplinaryRecord;
use App\Models\Faculty; 
use App\Models\Facility; 
use App\Models\UserLog;
use App\Models\FacEvent;   
use App\Models\FacAnnouncement;
use App\Traits\LogUserActivityTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use LogUserActivityTrait;

    public function index()
    {
        // Count the total number of users
        $totalUsers = User::count();
    
        // Count the number of students
        $studentsCount = User::where('userType', 'student')->count();
    
        // Count the number of faculty members
        $facultyCount = User::where('userType', 'faculty')->count();
    
        // Count the number of facilities
        $facilitiesCount = Facility::count();
    
        // Fetch user logs (latest activity) and group them by user
        $userLogs = UserLog::with('user')->orderBy('created_at')->get();
        $activitiesByUser = $userLogs->groupBy('user.username');
    
        // Prepare data for the chart
        $labels = [];
        $datasets = [];
        $colors = []; // Array to hold colors for each user
    
        foreach ($activitiesByUser as $userName => $activities) {
            $dataPoints = [];
            foreach ($activities as $activity) {
                // Use the date as a label
                $date = \Carbon\Carbon::parse($activity->created_at)->format('Y-m-d H:i'); 
                if (!in_array($date, $labels)) {
                    $labels[] = $date; 
                }
                $dataPoints[] = $activity->activity; 
            }
    
            // Generate a unique color for each user
            $color = '#' . substr(md5($userName), 0, 6); 
            $colors[$userName] = $color;
    
            $datasets[] = [
                'label' => $userName,
                'data' => array_count_values($dataPoints), 
                'fill' => false,
                'borderColor' => $color, 
                'tension' => 0.1,
            ];
        }
    
        // Fetch incoming schedules (events) and outgoing announcements
        $incomingSchedules = FacEvent::where('startAt', '>=', now())->get(); 
        $outgoingAnnouncements = FacAnnouncement::latest()->get(); 
    
        // Pass all data to the view
        return view('admin.dashboard', compact(
            'totalUsers',
            'studentsCount',
            'facultyCount',
            'facilitiesCount',
            'incomingSchedules',
            'outgoingAnnouncements',
            'labels',
            'datasets',
            'activitiesByUser', 
            'colors' 
        ));
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

        // Automatically create a user account for the student
         $this->registerStudentUser($student);

        // Log user activity
        $this->logActivity('Added a new student: ' . $student->name);

        return redirect()->back()->with('insert_success', 'Student information saved successfully.');
    }

    # Method to handle the registration of new users for students
    private function registerStudentUser(Student $student)
    {
        # Create a new user for the student
        $userData = [
            'username' => $student->name, // Use student's name as username
            'lrn' => $student->lrn,
            'password' => Hash::make('studentpassword'), // default password
            'userType' => 'student',
        ];

        # Save the new user
        $user = User::create($userData);

        # Log the activity
        $this->logActivity('Registered a new user for student: ' . $user->username);
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

        // Log user activity
        $this->logActivity('Updated student: ' . $student->name);

        return redirect()->back()->with('update_info', 'Student information updated successfully.');
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

        // Log user activity
        $this->logActivity('Deleted student: ' . $student->name);
        
        return redirect()->back()->with('delete_warning', 'Student information deleted successfully.');
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

        // Log user activity
        $this->logActivity('Added academic record for student ID: ' . $studentId);

        return redirect()->back()->with('insert_success', 'Academic record added successfully.');
      
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

         // Log user activity
         $this->logActivity('Added medical record for student ID: ' . $studentId);

        return redirect()->back()->with('insert_success', 'Medical record added successfully.');
       
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

        // Log user activity
        $this->logActivity('Added disciplinary record for student ID: ' . $studentId);

        return redirect()->back()->with('insert_success', 'Disciplinary record added successfully.');
       
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
        // Retrieve all faculties, ordered by updated_at in descending order
        $faculties = Faculty::orderBy('updated_at', 'desc')->get();
        return view('admin.faculty', compact('faculties'));
    }
    
     #to show individual faculty details
     public function showFacultyDetails($id) {
        $faculty = Faculty::findOrFail($id);
        return view('admin.faculty-details', compact('faculty'));
    }

    #to add new record
    public function create() {
        return view('admin.add_faculty'); 
       
    }
    # method to insert faculty record
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
    
        // Log user activity
        $this->logActivity('Added a new faculty member: ' . $faculty->name);
        // Redirect back with success message
        return redirect()->route('admin.faculty')->with('insert_success', 'Faculty record created successfully.');

    }
    #edit page route
    public function editSingleRecord($id) {
        $faculty = Faculty::findOrFail($id);
        return view('admin.edit_faculty', compact('faculty')); 
    
    }

    #to update record
    public function updateSingleFacultyRecord(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:faculties,email,' . $id,
            'faculty_id' => 'required|string|max:20|unique:faculties,faculty_id,' . $id,
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

        $faculty = Faculty::findOrFail($id);
        $faculty->update($request->all());

        // Log user activity
        $this->logActivity('Updated faculty member: ' . $faculty->name);

       // Redirect back with success message
       return redirect()->route('admin.faculty')->with('update_info', 'Faculty record updated successfully.');
    
    }


    // to delete
    public function deleteFacultyRecord($id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();

        // Log user activity
        $this->logActivity('Deleted faculty member: ' . $faculty->name);

        return redirect()->back()->with('delete_warning', 'Faculty record deleted successfully.');
        
    }



    
    #========== END HERE =========================

    public function staff() {
        return view('admin.staff');
    }

    
    public function reports() {
        return view('admin.reports');
    }

    public function settings() {
        return view('admin.settings');
    }

    public function account() {
        $users = User::all(); #Fetch all users
        return view('admin.account', compact('users'));
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
    
       # Save the new user and store the instance in a variable
        $user = User::create($userData);

        # Log the activity
        $this->logActivity('Registered a new user: ' . $user->username);

        
        return redirect()->back()->with('insert_success', 'User registered successfully.');
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

        # Log the activity
        $this->logActivity('Updated user information: ' . $user->username);

        return redirect()->back()->with('update_info', 'User updated successfully.');
    }
    #Method to delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

       # Log the activity before deletion
       $this->logActivity('Deleted user: ' . $user->username);

        return redirect()->back()->with('delete_warning', 'User deleted successfully.');
    }

}
