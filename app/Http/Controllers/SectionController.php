<?php

namespace App\Http\Controllers;

use App\Models\Section;
// use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Models\User;
use App\Notifications\Invoice;
use Exception;
use Illuminate\Support\Facades\Notification;



class SectionController extends Controller
{

    public function index()
    {

        $sections =  Section::get();

        return view('Section.sections', compact('sections'));
    }
    public function store_section(SectionRequest $request)
    {
        try {
            $section = Section::create([


                'section_name' => $request->section_name,
                'description' => $request->description
            ]);

            //-----------------

            //
            $users = User::get();
            Notification::send($users, new Invoice($section));

            //------------
            return redirect()->back()->with('m_s_section', "تم اضافه القسم بنجاح");
        } catch (Exception  $e) {

            return redirect()->back()->with('m_s_section', $e->getMessage());
        }
    }
    public function update_section(SectionRequest $request)
    {

        Section::find($request->id)->update([

            'section_name' => $request->section_name,
            'description' => $request->description
        ]);
        return redirect()->back()->with('m_s_section', "تم تعديل القسم بنجاح");
    }
    public function delete_section(SectionRequest $request)
    {

        Section::find($request->id)->delete();
        return redirect()->back()->with('m_s_section', "تم حذف القسم بنجاح");
    }
}
