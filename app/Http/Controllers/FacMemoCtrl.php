<?php

namespace App\Http\Controllers;

use App\Models\FacNotif;
use App\Models\Memo;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\LogUserActivityTrait;

class FacMemoCtrl extends Controller
{

    use LogUserActivityTrait;
    public function index(){
        $memos = Memo::all();

        return view('faculty.memo', compact('memos'));
    }

    public function store(Request $request){
       try{

        $user = auth()->user();

        $validated = $request->validate([
            "memo" => 'required'
        ]);

        $memo = Memo::create($validated);

        if($memo){
            $notification = FacNotif::create([
                "message" => "New memo: $request->memo",
                "isNew" => "Y",
                "type" => "Memo",
                "faculty_id" => $memo->id
            ]);

            $this->logActivity("Added a new memo: $request->memo ");

            if ($notification) {
                $userIds = User::where('userType', 'administrator')->pluck('id');
            
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

        return back()->with('success', "Memo added successfully");

       } catch (ValidationException $e) {
        return back()->with('error', "Form validation failed");
        } catch (Exception $e) {
        return back()->with('error', "Something went wrong");
       }
    }

    public function edit(Request $request){
        try{

            $validated = $request->validate([
                "memo" => 'required'
            ]);
    
            $memo = Memo::find($request->id)->update($validated);

            $this->logActivity("Updated memo: $request->memo ");
    
            return back()->with('success', "Memo updated successfully");
    
           } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
           }
    }

    public function destroy(Request $request){
        try{
           $memo = Memo::find($request->memoId);

            $this->logActivity("Deleted memo: $memo->memo ");

            $memo->delete();

            return back()->with('success', "Memo deleted successfully");
        }catch(Exception){
            return back()->with('error', "Something went wrong");
        }
    }
}
