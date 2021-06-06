<?php

namespace App\Http\Controllers;

use App\Experiences;
use Illuminate\Http\Request;

use App\Skills;

class aboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();

        if(isset($_SESSION['user_id'])) {

            return view("admin.pages.about");
        } else {
            return redirect("./admin/login");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->skill)) {

            $skills = new Skills;
            $skills->skill = $request->skill;
            $skills->degree = $request->degree;
            $skills->save();

            return redirect()->to($_SERVER['HTTP_REFERER'])->send();
        }

        if(isset($request->title_exp)) {

            $experience = new Experiences;
            $experience->title       = $request->title_exp;
            $experience->description = $request->desc_exp;
            $experience->from        = $request->start_date;
            $experience->to          = $request->end_date;
            $experience->save();

            return redirect()->to($_SERVER['HTTP_REFERER'])->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        if(isset($request->exp)) {

            Experiences::where('id', $id)->delete();

            redirect()->to('./admin/about')->send();

        } else {

            Skills::where('id', $id)->delete();

            redirect()->to('./admin/about')->send();
        }
    }
}
