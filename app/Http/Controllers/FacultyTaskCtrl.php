<?php

namespace App\Http\Controllers;

use App\Models\EventAtt;
use App\Models\FacEvent;
use App\Models\FacNotif;
use App\Models\Notification;
use App\Models\Student;
use App\Models\User;
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
                    $notification = FacNotif::create([
                        "message" => "New announcement: $request->announcement",
                        "isNew" => "Y",
                        "type" => "ANNOUNCEMENT",
                        "faculty_id" => $event->id
                    ]);
    
                    if ($notification) {
                        $userIds = User::whereIn('userType', ['student', 'administrator'])->pluck('id');
                    
                        if ($userIds->isNotEmpty()) {
                            $notifications = $userIds->map(function ($userId) use ($notification) {
                                return [
                                    "user_id" => $userId,
                                    "notification_id" => $notification->id,
                                ];
                            });
                    
                            Notification::insert($notifications->toArray());
                        }
                    }
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
                return back()->with('success', "Event deleted successfully");
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

        public function eventAttendance(Request $request){

            $eventId = $request->id;

            $event = FacEvent::where('id', $eventId)->first();

            $students = Student::all();

            $students = $students->map(function($student)use($eventId) {

                $user = User::where('lrn', $student->lrn)->first();

                $attendanceIn = EventAtt::where('student_id', $user->id)
                ->where('event_id', $eventId)
                ->where('type', "IN")
                ->first();

                $attendanceOut = EventAtt::where('student_id', $user->id)
                ->where('event_id', $eventId)
                ->where('type', "OUT")
                ->first();

                if($attendanceIn){
                    $student->in = $attendanceIn->time;
                }

                if($attendanceOut){
                    $student->out = $attendanceOut->time;
                }


                $user = User::where("id", $student->lrn)->first();

                
                return $student;
            });

            return view("faculty.eventAttendance", compact('event', 'students'));
        }
}
