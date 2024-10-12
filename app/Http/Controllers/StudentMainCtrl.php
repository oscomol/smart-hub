<?php

namespace App\Http\Controllers;

use App\Models\EventAtt;
use App\Models\FacAnnouncement;
use App\Models\FacEvent;
use App\Models\FacNotif;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentMainCtrl extends Controller
{

    public function eventIndex()
{
    $events = FacEvent::all();
    $userId = auth()->user()->id;

    $currentTime = Carbon::now('Asia/Manila');

    $events = $events->map(function($event) use ($userId, $currentTime) {
        $startAt = Carbon::createFromFormat('Y-m-d\TH:i', $event->startAt, 'Asia/Manila');
        $endAt = Carbon::createFromFormat('Y-m-d\TH:i', $event->endAt, 'Asia/Manila');

        $event->starting = $currentTime->gt($startAt);
        $event->end = $currentTime->lt($endAt);
        
        if($event->starting){
            $timeIn = EventAtt::where('student_id',  $userId)
            ->where('event_id', $event->id)
            ->where('type', "IN")
            ->first();
            if($timeIn){
                $dateTime = Carbon::createFromFormat('Y-m-d\TH:i', $timeIn->time);
                $formattedDateTime = $dateTime->format('F d, Y - H:i');
                $event->timeInTime = $formattedDateTime;
            }
        }

        if($event->end){
            $timeOut = EventAtt::where('student_id',  $userId)
            ->where('event_id', $event->id)
            ->where('type', "OUT")
            ->first();
            if($timeOut){
                $dateTime = Carbon::createFromFormat('Y-m-d\TH:i', $timeOut->time);
                $formattedDateTime = $dateTime->format('F d, Y - H:i');
                $event->timeOutTime = $formattedDateTime;
            }
        }

        $eventStartAt =  Carbon::createFromFormat('Y-m-d\TH:i', $event->startAt);
        $event->startAt =  $eventStartAt->format('F d, Y - H:i');

        $eventEndAt =  Carbon::createFromFormat('Y-m-d\TH:i', $event->endAt);
        $event->endAt =  $eventEndAt->format('F d, Y - H:i');


        return $event;
    });

    return view('student.event', compact('events'));
}


    public function eventIn(Request $request){
        try{
            $userId = auth()->user()->id;

            $time = Carbon::now('Asia/Manila')->format('Y-m-d\TH:i');
            $type = $request->type;

            EventAtt::create([
                "event_id" => $request->id, 
                "student_id" => $userId, 
                "time" => $time,  
                "type" => $type,
            ]);

            return back()->with('success', "$type: $time");
           

        }catch(\Exception $err){
            return back()->with('error', "Something weknknt wrong");
        }
    }

    public function announcementIndex(){

        $announcements = FacAnnouncement::all();

        $announcements = $announcements->map(function($ann){
            
            $ann->created_at = Carbon::parse( $ann->created_at->toString())->format('F d, Y h:i');

            if (strlen($ann->announcement) > 30) {
                $ann->previewAnn = substr($ann->announcement, 0, 30) . "...";
            }
            
            return $ann;
        });

        return view('student.announcement', compact('announcements'));

    }

    public function notificationIndex(){

        $userId = auth()->user()->id;

        $notification = Notification::where('user_id', $userId)->get();

        $notifData = $notification->map(function($notif){
            $data = FacNotif::where('id', $notif->notification_id)->first();

            if($notif->isRead == "N"){
                $data->isNew = true;
            }else{
                $data->isNew = false;
            }

            if (strlen($data->message) > 30) {
                $data->previewMessage = substr($data->message, 0, 30) . "...";
            }
        
            return $data;
        });

        foreach($notification as $notif){
           if($notif->isRead == "N"){
                Notification::where('user_id', $userId)
                ->where('isRead', "N")->first()->update([
                    "isRead" => "Y"
                ]);
           }
        }
        
        return view('student.notification', compact('notifData'));
    }

    public function getNotif(){
        $userId = auth()->user()->id;

        $notification = Notification::where('user_id', $userId)
        ->where('isRead', "N")->count();

        return response()->json($notification);
    }
}