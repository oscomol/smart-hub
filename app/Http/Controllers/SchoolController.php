<?php
namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Facility;
use App\Models\Procedure;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Traits\LogUserActivityTrait;

class SchoolController extends Controller
{
    use LogUserActivityTrait;
 
    public function index()
    {
        $schools = School::all();
        return view('schools.index', compact('schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'type' => 'required',
            'principal_name' => 'required',
            'year_established' => 'required|numeric|digits:4',
        ]);

        $school = School::create($request->all());

        $this->logActivity('Added a school information: ' . $school->name);

        return redirect()->route('schools.index')
                         ->with('insert_success', 'School information added successfully');
    }

    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'type' => 'required',
            'principal_name' => 'required',
            'year_established' => 'required|numeric|digits:4',
        ]);

        $oldName = $school->name; 
        $school->update($request->all());

        $this->logActivity('Updated school from ' . $oldName . ' to ' . $school->name);

        return redirect()->route('schools.index')
                         ->with('update_info', 'School information updated successfully');
    }

   
    public function destroy(School $school)
    {
        $schoolName = $school->name; 
        $school->delete();

      
        $this->logActivity('Deleted school: ' . $schoolName);

       
        return redirect()->route('schools.index')->with('delete_warning', 'School deleted successfully!');
    }
    public function facilities()
    {
        $facilities = Facility::all();
        return view('schools.facilities', compact('facilities'));
    }

    public function create()
    {
        return view('schools.create-faci'); 
    }

    public function editFacilities($id)
    {
        $facility = Facility::findOrFail($id);
        return view('schools.edit-faci', compact('facility')); 
    }

    public function storeFacility(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'number' => 'required|integer',
        ]);

        $facility = Facility::create($request->all());

      
        $this->logActivity('Added new facility information: ' . $facility->name);

        return redirect()->route('facilities.index')->with('insert_success', 'Facility added successfully.');
    }

 
    public function updateFacilities(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'number' => 'required|integer',
        ]);

        $facility = Facility::findOrFail($id);
        $facility->update($request->all());

        $this->logActivity('Updated facility information: ' . $facility->name);
        return redirect()->route('facilities.index')->with('update_info', 'Facility updated successfully.');
    }

    
    public function destroyFacilities($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();
        $this->logActivity('Deleted facility information: ' . $facility->name);
        return redirect()->route('facilities.index')->with('delete_warning', 'Facility deleted successfully.');
    }

    #procedures
    public function Procedures()
    {
        $procedures = Procedure::all();
        return view('schools.procedures', compact('procedures'));

    }

    public function storeProcedure(Request $request) 
    {
        $request->validate([

            'school_time' => 'required|string|max:255',
            'office_hours' => 'required|string|max:255',
            'fee_structure' => 'required|string|max:255',
            'fb' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'meetings' => 'required|string|max:255',
            
        ]);

        $procedure = Procedure::create($request->all());

    
        $this->logActivity('Added new administrative procedure: ' . $procedure->name);

        return redirect()->route('procedures.index')->with('insert_success', 'New Procedure added successfully.');
    }

    public function createProcedure()
    {
        return view('schools.cprocedure'); 
    }

    public function editProcedure($id)
    {
        $procedure = Procedure::findOrFail($id);
        return view('schools.eprocedure', compact('procedure')); 
    }
    

    public function updateProcedure(Request $request, $id) 
    {
        $request->validate([

            'school_time' => 'required|string|max:255',
            'office_hours' => 'required|string|max:255',
            'fee_structure' => 'required|string|max:255',
            'fb' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'meetings' => 'required|string|max:255',
            
        ]);

        $procedure = Procedure::findOrFail($id);
        $procedure->update($request->all());

       
        $this->logActivity('Old procedure has been updated: ' . $procedure->name);

        return redirect()->route('procedures.index')->with('update_info', 'Updated successfully.');
    }

    public function destroyProcedure($id)
    {
        $procedure = Procedure::findOrFail($id);
        $procedure->delete();
        $this->logActivity('Deleted procedure information: ' . $procedure->name);
        
        return redirect()->route('procedures.index')->with('delete_warning', 'Procedure deleted successfully.');
    }
    
    #policy
    public function Policies()
    {
        $policies = Policy::all();
        return view('schools.policy', compact('policies'));
    }

    public function editPolicies($id)
    {
     
        $policy = Policy::findOrFail($id);
        return view('schools.epolicy', compact('policy')); 
    }
    
    
    public function createPolicies()
    {
        return view('schools.apolicy');
    }

    public function storePolicies(Request $request)
    {
        $request->validate([
            'attendance_policy' => 'required|string|max:255',
            'disciplinary_policy' => 'required|string|max:255',
            'examination_policy' => 'required|string|max:255',   
        ]);
    
      
        $policy = Policy::create($request->all());
    
      
        $this->logActivity('New policy has been added: Attendance - ' . $policy->attendance_policy . 
                            ', Disciplinary - ' . $policy->disciplinary_policy . 
                            ', Examination - ' . $policy->examination_policy);
    
        return redirect()->route('policies.index')->with('insert_success', 'New Policy added successfully.');
    }

    public function updatePolicies(Request $request, $id)
    {
        $request->validate([
            'attendance_policy' => 'required|string|max:255',
            'disciplinary_policy' => 'required|string|max:255',
            'examination_policy' => 'required|string|max:255',   
        ]);
    
        $policy = Policy::findOrFail($id);
        
  
        $this->logActivity('Old policy has been updated: Attendance - ' . $policy->attendance_policy . 
                            ', Disciplinary - ' . $policy->disciplinary_policy . 
                            ', Examination - ' . $policy->examination_policy);
    
      
        $policy->update($request->all());
    
        return redirect()->route('policies.index')->with('update_info', 'Old Policy updated successfully.');
    }

    public function destroyPolicies($id)
    {
        $policy = Policy::findOrFail($id);
        
      
        $this->logActivity('Deleted policy: Attendance - ' . $policy->attendance_policy . 
                           ', Disciplinary - ' . $policy->disciplinary_policy . 
                           ', Examination - ' . $policy->examination_policy);
    
        $policy->delete();
    
        return redirect()->route('policies.index')->with('delete_info', 'Policy deleted successfully.');
    }
    
    
}