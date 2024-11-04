<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use App\Models\ClassSchedule;
use App\Models\ClassSubject;
use App\Models\DisciplinaryRecord;
use App\Models\Enrol;
use App\Models\EnteredGrade;
use App\Models\FacAnnouncement;
use App\Models\FacNotif;
use App\Models\Faculty;
use App\Models\Grade;
use App\Models\Instruc;
use App\Models\MedicalRecord;
use App\Models\Notification;
use App\Models\Student;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function scheduleIndex() {
        $user = auth()->user();
        $lrn = $user->lrn;
        $userData = Student::where('lrn', $lrn)->first();

        $gradeSection = "";
        $enrol = Enrol::where('student_id', $lrn)->first();
        $isEnrol = false;
        $days = [];
        $subjects = null;
        
        if ($enrol) {
            $isEnrol = true;
            $grade = Grade::where('id', $enrol->grade_id)->first();
            $subject = ClassSubject::where('grade_id', $grade->id)->get();

            $subjects = $subject->map(function($sub) use ($lrn) {
                $grades = EnteredGrade::where('lrn', $lrn)->where('grade_id', $sub->id)->first();
                if ($grades) {
                    $sub->grade = $grades->grade;
                }
                return $sub;
            });

            $gradeSection .= "Grade $grade->grade - $grade->section";
            $curId = $grade->id;

            $days = [
                ["day" => "Monday", "startAt" => null, "endAt" => null, "instructor" => null],
                ["day" => "Tuesday", "startAt" => null, "endAt" => null, "instructor" => null],
                ["day" => "Wednesday", "startAt" => null, "endAt" => null, "instructor" => null],
                ["day" => "Thursday", "startAt" => null, "endAt" => null, "instructor" => null],
                ["day" => "Friday", "startAt" => null, "endAt" => null, "instructor" => null],
            ];

            $instructor = Instruc::where('grade_id', $curId)->first();
            if ($instructor) {
                $instructor = Faculty::where('id', $instructor->instructor_id)->first();
            }

            $days = array_map(function($day) use ($curId, $instructor) {
                $sched = ClassSchedule::where('day', $day['day'])
                    ->where('grade_id', $curId)
                    ->first();

                $subjects = ClassSubject::where('grade_id', $curId)->where('day', $day['day'])->get();
                if ($subjects->count() > 0) {
                    $day['subjects'] = $subjects;
                }
                
                if ($sched) {
                    $day['startAt'] = $sched->startAt;
                    $day['endAt'] = $sched->endAt;
                }

                if (isset($instructor)) {
                    $day['instructor'] = $instructor->name; 
                }

                return $day;
            }, $days);
        }
    
        $title = "$userData->name $gradeSection";

        return view('parents.schedule', compact('days', 'isEnrol', 'title', 'gradeSection', 'user', 'subjects'));
    }

    public function announcementIndex() {
        $user = auth()->user();
        $announcements = FacAnnouncement::all()->map(function($ann) {
            $ann->created_at = Carbon::parse($ann->created_at->toString())->format('F d, Y h:i');
            $ann->previewAnn = strlen($ann->announcement) > 30 ? substr($ann->announcement, 0, 30) . "..." : $ann->announcement;
            return $ann;
        });

        return view('parents.announcement', compact('announcements', 'user'));
    }

    public function notificationIndex() {
        $userId = auth()->user()->id;
        $notification = Notification::where('user_id', $userId)->orderBy('id', 'desc')->get();

        $notifData = $notification->map(function($notif) {
            $data = FacNotif::where('id', $notif->notification_id)->first();
            $data->isNew = $notif->isRead == "N";
            $data->previewMessage = strlen($data->message) > 30 ? substr($data->message, 0, 30) . "..." : $data->message;
            return $data;
        });

        foreach ($notification as $notif) {
            if ($notif->isRead == "N") {
                Notification::where('user_id', $userId)
                    ->where('isRead', "N")->first()->update([
                    "isRead" => "Y"
                ]);
            }
        }
        
        return view('parents.notification', compact('notifData', 'user'));
    }

    public function getNotif() {
        $userId = auth()->user()->id;
        $notificationCount = Notification::where('user_id', $userId)
            ->where('isRead', "N")->count();
        return response()->json($notificationCount);
    }

    public function show() {
        try {
            $user = auth()->user();
            $student = Student::with('guardian')->where('lrn', $user->lrn)->first();
            $academicRecords = AcademicRecord::where('student_id', $student->id)->get();
            $medicalRecords = MedicalRecord::where('student_id', $student->id)->get();
            $disciplinaryRecords = DisciplinaryRecord::where('student_id', $student->id)->get();

            return view('parents.info', compact('student', 'academicRecords', 'medicalRecords', 'disciplinaryRecords', 'user'));
        } catch (Exception $err) {
            return back()->with('error', 'An error occurred');
        }
    }
}
