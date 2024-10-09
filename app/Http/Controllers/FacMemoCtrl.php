<?php

namespace App\Http\Controllers;

use App\Models\FacNotif;
use App\Models\Memo;
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
            FacNotif::create([
                "message" => "New memo added: $request->memo",
                "isNew" => "Y",
                "type" => "MEMO",
                "faculty_id" => $memo->id
            ]);
        }

        return back()->with('success', "Announcement updated successfully");

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
    
            return back()->with('success', "Announcement updated successfully");
    
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
