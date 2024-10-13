<?php

namespace App\Http\Controllers;

use App\Models\FacAnnouncement;
use App\Models\FacEvent;
use App\Models\FacNotif;
use App\Models\Notification;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use App\Traits\LogUserActivityTrait;

class FacAnnouncementCtrl extends Controller
{

    use LogUserActivityTrait;
    public function index(){
        $announcements = FacAnnouncement::all();
        return view("faculty.announcement", compact('announcements'));
    }

    public function store(Request $request){
        try {
            $validated = $request->validate([
                "title" => 'required',
                "announcement" => 'required'
            ]);

            $event = FacAnnouncement::create($validated);

            if($event){
                $notification = FacNotif::create([
                    "message" => "New announcement: $request->announcement",
                    "isNew" => "Y",
                    "type" => "ANNOUNCEMENT",
                    "faculty_id" => $event->id
                ]);

                $this->logActivity("Added a new announcment: $request->announcement ");


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

            return back()->with('success', "Announcement created successfully");

        } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
        } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
        }
    }

    public function edit(Request $request){
        try {
            $validated = $request->validate([
                "title" => 'required',
                "announcement" => 'required'
            ]);

            $announcement = FacAnnouncement::find($request->id)->update($validated);

            $this->logActivity("Updated announcment: $request->announcement ");

            return back()->with('success', "Announcement updated successfully");

        } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
        } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
        }
    }

    public function destroy(Request $request){
        try{
            $ann = FacAnnouncement::find($request->eventId);
            $this->logActivity("Updated announcment: $ann->announcement ");
            $ann->delete();
            return back()->with('success', "Announcement deleted successfully");
        }catch(Exception){
            return back()->with('error', "Something went wrong");
        }
    }
}
