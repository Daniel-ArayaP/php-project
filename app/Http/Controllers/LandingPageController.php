<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLandingPage()
    {
        return view('LandingPage.landing');
    }

    public function downloads($url)
    {
        $file = $this->file($url);
        if (Storage::disk('public')->has($file))
        {
            return Storage::disk('public')->download($file);
        }else
        {
            return redirect()->route('login')->with('error', 'Error en econtrar el archivo');
        }
    }

    public function file($url)
    {
        $file = "";
        switch ($url) {
            case "Baucher":
                $file = 'infoGeneral.pdf';
                break;
            case "CambioPlan":
                $file = 'cambioPlan.docx';
                break;
            case "ROBOTICO":
                $file = 'tcu.pdf';
                break;
            case "Levantamientos":
                $file = "Levantamientos.pdf";
                break;
            case "Investigacion":
                $file = "Investigacion.pdf";
                break;
            default:
                $file = '';
                break;
        }
        return $file;
    }
}
