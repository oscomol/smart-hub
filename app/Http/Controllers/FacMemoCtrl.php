<?php

namespace App\Http\Controllers;

use App\Models\FacNotif;
use App\Models\Memo;
use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FacMemoCtrl extends Controller
{
    public function index(){
        $memos = Memo::all();

        return view('faculty.memo', compact('memos'));
    }

    public function store(Request $request){
       try{

        $validated = $request->validate([
            "memo" => 'required'
        ]);

        $memo = Memo::create($validated);

        if($memo){
            $notification = FacNotif::create([
                "message" => "New announcement: $request->announcement",
                "isNew" => "Y",
                "type" => "ANNOUNCEMENT",
                "faculty_id" => $memo->id
            ]);

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
    
            return back()->with('success', "Memo updated successfully");
    
           } catch (ValidationException $e) {
            return back()->with('error', "Form validation failed");
            } catch (Exception $e) {
            return back()->with('error', "Something went wrong");
           }
    }

    public function destroy(Request $request){
        try{
            Memo::find($request->memoId)->delete();
            return back()->with('success', "Memo deleted successfully");
        }catch(Exception){
            return back()->with('error', "Something went wrong");
        }
    }
}
