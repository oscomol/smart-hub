<?php

namespace App\Http\Controllers;

use App\Models\FacEvent;
use App\Models\FacNotif;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FacultyTaskCtrl extends Controller
{
    public function index(){
        $events = FacEvent::all();

        return view("faculty.task", compact('events'));
    }

    protected $fillable = [
        "message",
        "isNew",
        "type",
        "faculty_id"
    ];

    public function store(Request $request)
        {
            try {
                $validated = $request->validate([
                    "eventName" => 'required',
                    "startAt" => 'required',
                    "endAt" => 'required',
                    "eventDescription" => 'required',
                ]);

                $event = FacEvent::create($validated);

                if($event){
                    FacNotif::create([
                        "message" => "New event created: $request->eventName",
                        "isNew" => "Y",
                        "type" => "EVENT",
                        "faculty_id" => $event->id
                    ]);
                }

                return back()->with('success', "Event created successfully");

            } catch (ValidationException $e) {
                return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
                return back()->with('error', "Something went wrong");
            }
        }

        public function destroy(Request $request){
            try{
                FacEvent::find($request->eventId)->delete();
                return back()->with('success', "Event created successfully");
            }catch(Exception){
                return back()->with('error', "Something went wrong");
            }
        }
        
        public function edit(Request $request){
            try {
                $validated = $request->validate([
                    "eventName" => 'required',
                    "startAt" => 'required',
                    "endAt" => 'required',
                    "eventDescription" => 'required',
                ]);

                $event = FacEvent::find($request->id);

                $event->update($validated);

                return back()->with('success', "Event updated successfully");

            } catch (ValidationException $e) {
                return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
                return back()->with('error', "Something went wrong");
            }
        }
}
