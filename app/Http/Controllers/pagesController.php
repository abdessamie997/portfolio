<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Messages;

session_start();

class pagesController extends Controller
{

    public function get_login() {

        if (isset($_SESSION['username'])) {

            return redirect('/admin');

        } else {

            return view('admin.pages.login');
        }
    }

    // ---------------------------

    public function login(request $request) {

        return view('admin.pages.verify_login');
    }

    // ---------------------------

    public function logout() {

        session_unset();

        setcookie('cookie_name', '', time() - 3600, '/');

        session_destroy();

        return redirect('/admin/login');

        exit();
    }

    // ----------------------

    public function dashboard() {

        if (isset($_SESSION['username'])) {

            return view('admin/pages/index');

        } else {

            return redirect('/admin/login');
        }

    }

    // ----------------------

    public function projects() {

        if (isset($_SESSION['username'])) {

            return view('admin/pages/gallery');

        } else {

            return redirect('/admin/login');
        }
    }

    // ---------- interface ----------

    public function home() {

        return view('pages.index');
    }

    // ------

    public function gallery() {

        return view('pages.gallery');
    }

    // ------

    public function about() {

        return view('pages/about');
    }

    // ------

    public function contact() {

        return view('pages/contact');
    }

    public function validForm(request $request) {

        $messages = new Messages;
        $messages->subject = $request->sub;
        $messages->message = $request->msg;
        $messages->email = $request->email;
        $messages->name = $request->name;
        $messages->save();

        return "Your Message has been sent !";
    }

}
