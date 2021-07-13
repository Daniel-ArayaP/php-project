<?php

namespace App\Http\Controllers;

use HttpRequestException;
use Illuminate\Http\Request;
use App\Models\ContenidoCarrera;
use App\Models\CarreraUlatina;
use App\Models\Universidad;
use App\Http\Requests\ValidarCarreraUlatina;
use App\Http\Requests\ValidarUniversidad;
use App\Models\ContenidoUniversidad;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;



class ExcelController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {

        return view('import/import');
    }

    public function storeCarreraUlatina(ValidarCarreraUlatina $request)
    {
        try {

            if (DB::table('ulatina_carreras')->where('id_carreras_ulatina','=',$request->IdCarrerasUlatina)->first())
                return back()->with('errors','El Codigo de la carrera ya existe intentelo nuevamente');


            $carreraUlatina = new CarreraUlatina();
            $carreraUlatina->id_carreras_ulatina = request()->IdCarrerasUlatina;
            $carreraUlatina->nombre_carreras_ulatina = request()->NombreCarreraUlatina;

            $carreraUlatina->save();
            return back()->with('sucess', 'Datos guardados correctamente.');

        } catch (HttpRequestException $ex) {
            return $ex;
        }

    }



//Aqui mse encuentra la logica para guardar las materias en la tabla ContenidoCarreras, de una forma manual

public function storeMateriaUlatina(Request $request)
{
    try {
        $MateriaExistentes = DB::table('contenido_carreras')->get();

        if (DB::table('contenido_carreras')->where('id_contenido_carreras','=',$request->id_contenido_carreras)->first())
            return back()->with('error','El Codigo de la materia ingresado se encuentra en el sistema, intentelo nuevamente');


        if (!DB::table('ulatina_carreras')->where('id_carreras_ulatina','=',$request->ulatina_carreras_id_carreras_ulatina)->exists())
            return back()->with('error','El codigo de la carrera ingresada no existe en el sistema, intentelo nuevamente');

        $Materias = new ContenidoCarrera();
        $Materias->id_contenido_carreras = request()->id_contenido_carreras;
        $Materias->nombre_contenido_carreras = request()->nombre_contenido_carreras;
        $Materias->creditos_contenido_carreras = request()->creditos_contenido_carreras;
        $Materias->ulatina_carreras_id_carreras_ulatina = request()->ulatina_carreras_id_carreras_ulatina;
        $Materias->save();
        return back()->with('success','La materia se guardo correctamente, Gracias revisar aca');

    } catch (Exception $ex) {

        return $ex;
    }

}

    //Aqui esta la logica para poder guardar un documento csv en la base de datos,para ser mas especifico en la tabla ContenidoCarreras
    public function storeCSV()
    {   
        try {
        

            if (Input::file('upload-file')) {
                $path = request()->file('upload-file')->getRealPath();
                if (($handle = fopen($path, 'r')) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        $csv_data = new ContenidoCarrera ();
                        $csv_data->id_contenido_carreras = utf8_encode($data[0]);
                        $csv_data->nombre_contenido_carreras = $data[1];
                        $csv_data->creditos_contenido_carreras = $data[2];
                        $csv_data->ulatina_carreras_id_carreras_ulatina = $data[3];
                        $csv_data->sensibilidad = $data[4];
                        $csv_data->save();

                    }
                    fclose($handle);
                }
                return back()->with('sucess', 'Datos guardados correctamente.');
            } else {

                return redirect()->back()->with('error', 'No selecciono ningun documento');

            }
        } catch (\Exception $ex) {

            return $ex;

        }
    }

  


}


    







