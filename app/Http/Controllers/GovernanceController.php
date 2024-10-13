<?php

namespace App\Http\Controllers;

use App\Models\Governance;
use Illuminate\Http\Request;
use App\Traits\LogUserActivityTrait;

class GovernanceController extends Controller
{
    use LogUserActivityTrait;

   public function index()
   {
       $governances = Governance::all();
       return view('governance.index', compact('governances'));
   }

 
   public function create()
   {
       return view('governance.create');
   }


   public function store(Request $request)
   {
       $request->validate([
           'chairman' => 'required',
           'd_chairman' => 'required',
           'a_chairman' => 'required',
           'hod_science' => 'required',
           'hod_mathematics' => 'required',
           'hod_english' => 'required',
           'hod_filipino' => 'required',
           'hod_araling_panlipunan' => 'required',
           'hod_values_education' => 'required',
           'hod_mapeh' => 'required',
           'hod_tle' => 'required',
       ]);

       $governance = Governance::create($request->all());


       $this->logActivity('Added governance record: ' . $governance->chairman);

       return redirect()->route('governance.index')
                        ->with('success', 'Governance record added successfully.');
   }

   
   public function edit($id)
   {
       $governance= Governance::findOrFail($id);
       return view('governance.edit', compact('governance'));
   }

 
   public function update(Request $request,$id)
   {
       $request->validate([
           'chairman' => 'required',
           'd_chairman' => 'required',
           'a_chairman' => 'required',
           'hod_science' => 'required',
           'hod_mathematics' => 'required',
           'hod_english' => 'required',
           'hod_filipino' => 'required',
           'hod_araling_panlipunan' => 'required',
           'hod_values_education' => 'required',
           'hod_mapeh' => 'required',
           'hod_tle' => 'required',
       ]);

       $governance= Governance::findOrFail($id);
       $oldChairman = $governance->chairman; 
       $governance->update($request->all());

     
       $this->logActivity('Updated governance record from ' . $oldChairman . ' to ' . $governance->chairman);

       return redirect()->route('governance.index')
                        ->with('info', 'Governance record updated successfully.');
   }


   public function destroy(Governance $governance)
   {
       
       $governance->delete();

     
       $this->logActivity('Deleted governance record: ' . $governance->chairman);

       return redirect()->route('governance.index')
                        ->with('warning', 'Governance record deleted successfully.');
   }
}
