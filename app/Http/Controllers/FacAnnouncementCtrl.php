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

class FacAnnouncementCtrl extends Controller
{
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

            return back()->with('success', "Announcement updated successfully");

        } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
        } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
        }
    }

    public function destroy(Request $request){
        try{
            FacAnnouncement::find($request->eventId)->delete();
            return back()->with('success', "Announcement deleted successfully");
        }catch(Exception){
            return back()->with('error', "Something went wrong");
        }
    }
}
