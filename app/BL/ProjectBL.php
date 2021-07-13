<?php

namespace App\BL;

use App\Models\PersonProfile;
use App\Models\Project;
use App\Models\Company;
use App\Models\ProjectProblem;
use App\Models\ProjectScope;
use App\Models\ProjectSpecificObjetive;
use App\Models\ProjectTool;
use App\Models\ProjectLimitation;
use App\Security\SecurityHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectStatusChanged;
use App\Models\Status;
use App\Models\Period;
use App\Models\ProjectOpportunity;
use App\Models\Solicitud;
use Storage;


class ProjectBL
{
    public static function editProjectCompany(array $data)
    {
        DB::beginTransaction();

        try {
            $project = Project::find($data['projectId']);
            $project->general_problem = $data['generalProblem'];
            $project->general_objetive = $data['generalObjetive'];
            $project->title = $data['projectName'];
            $project->current_status_of_case = $data['caseStatus'];
            $project->project_scopes = $data['pScopes'];
            $project->specific_problems = $data['sProblems'];
            $project->specific_objetives = $data['sObjetives'];
            $project->teleworking = $data['teleworking'];
            $project->period_id = $data['period_id'];
            $project->tools = $data['toolText'];
            $project->tools = $data['toolText'];
            $project->students_quantity = $data['studentQuantity'];
            $project->save();

            DB::commit();

            return true;
        } catch (Exeption $ex) {
            DB::rollback();
            return false;
        }
    }

    public static function editProjectCompanyAdmin(array $data)
    {
        DB::beginTransaction();
        try {
            $project = Project::find($data['projectId']);
            $project->status_id = 2;
            $project->save();

            DB::commit();

            return true;
        } catch (Exeption $ex) {
            DB::rollback();
            return false;
        }
    }

    public static function editProjectCompanyStudents(array $data, $student)
    {

        DB::beginTransaction();
        try {
            $url = DB::table('students')->where('person_profile_id', $student[0]->person_profile_id)->value('curriculum');
            $project->status_id = 11;
            $curriculum = Storage::disk('public')->get($url);
            $project->student_id = $student[0]->person_profile_id;
            $email = DB::table('students')->where('person_profile_id', $student[0]->person_profile_id)->value('personal_email');
            $project->save();
            $company = DB::table('projects')->where('id', $data['projectId'])->value('company_id');
            $sol = DB::table('solicitudes')->orderBy('id', 'desc')->value('id');
            $solicitud = new Solicitud;
            $solicitud->id = $sol + 1;
            $solicitud->person_profile_id = $student[0]->person_profile_id;
            $solicitud->student_curriculum = $curriculum;
            $solicitud->student_personal_email = $email;
            $solicitud->project_id = $data['projectId'];
            $solicitud->company_id = $company;
            $solicitud->save();

            DB::commit();

            return true;
        } catch (Exeption $ex) {
            DB::rollback();
            return false;
        }
    }

    public static function rejectProjectCompanyAdmin($id)
    {
        DB::beginTransaction();
        try {
            $project = Project::find($id);
            $project->status_id = 3;
            $project->save();

            DB::commit();

            return true;
        } catch (Exeption $ex) {
            DB::rollback();
            return false;
        }
    }


    /**
     * Editar Proyecto
     * @param array $data
     * @param $fileData
     * @return bool
     */
    public static function editProject(array $data, $fileData)
    {
        DB::beginTransaction();

        try {
            if ($fileData != null) {
                $file = $fileData->store();
            } else {
                $file = '';
            }

            $project = Project::find($data['projectId']);
            $project->project_type_id = $data['company_type_id'];
            $project->general_problem = $data['generalProblem'];
            $project->general_objetive = $data['generalObjetive'];
            $project->title = $data['projectName'];
            $project->current_status_of_case = $data['caseStatus'];
            $project->status_id = 1;

            if ($fileData != null) {
                $file = $fileData->store();
                $project->file = $file;
            }

            $project->project_scopes = $data['pScopes'];
            $project->specific_problems = $data['sProblems'];
            $project->specific_objetives = $data['sObjetives'];
            $project->limitations = $data['pLimitations'];
            $project->tools = $data['toolText'];
            $project->save();

            $company = Company::find($project->company_id);
            $company->company_type_id = $data['company_type_id'];
            $company->name = $data['companyName'];
            $company->legal_document = $data['legal_document'];
            $company->contact_name = $data['contact_name'];
            $company->contact_phone = $data['contact_phone'];
            $company->contact_email = $data['contact_email'];
            $company->save();

            DB::commit();

            return true;
        } catch (Exeption $ex) {
            DB::rollback();
            return false;
        }
    }

    /**
     * Crear Proyecto
     * @param array $data
     * @param $fileData
     * @return bool
     */
    public static function createProject(array $data, $fileData)
    {
        DB::beginTransaction();

        try {

            $period = Period::where('active', true)->first();
            $student = Student::where('user_id', Auth::user()->id)->first();
            $company = Company::create([
                'company_type_id' => $data['company_type_id'],
                'name' => $data['companyName'],
                'legal_document' => $data['legal_document'],
                'contact_name' => $data['contact_name'],
                'contact_phone' => $data['contact_phone'],
                'contact_email' => $data['contact_email']
            ]);
            //dd($fileData);
            if (!is_null($fileData))
                $file = $fileData->store('public');

            $project = Project::create([
                'student_id' => $student->person_profile_id,
                'project_type_id' => $data['project_type_id'],
                'company_id' => $company->id,
                'general_problem' => $data['generalProblem'],
                'general_objetive' => $data['generalObjetive'],
                'title' => $data['projectName'],
                'current_status_of_case' => $data['caseStatus'],
                'status_id' => 1,
                'file' => $fileData ? str_replace('public/', '', $file) : '',
                'project_scopes' => $data['pScopes'],
                'specific_problems' => $data['sProblems'],
                'specific_objetives' => $data['sObjetives'],
                'limitations' => $data['pLimitations'],
                'tools' => $data['toolText'],
                'process_type_id' => $data['process'],
                'benefits' => isset($data['benefits']) ? $data['benefits'] : '',
                'campus' => isset($data['campus']) ? $data['campus'] : '',
                'students_quantity' => isset($data['students_quantity']) ? $data['students_quantity'] : 0,
                'modality_id' => $data['modality'],
                'period_id' => $period->id
            ]);

            DB::commit();

            return true;
        } catch (\Exeption $ex) {
            DB::rollback();
            return false;
        }
    }


    /**
     * Función para crear proyectos nuevos (Empresas)
     *
     * @param array $data
     * @return bool
     */
    public static function createProjectCompany(array $data)
    {
        DB::beginTransaction();
        try {
            //$period = Period::where('active', true)->first();
            $company = Company::where('contact_email', $data['contact_email'])->first();

            if ($data['studentQuantity'] == 0)
                $data['studentQuantity'] = 1;

            $project = Project::create([
                'student_id' => 4,  //Nota: Se debe especificar un 'student_id' existente en la base de datos.
                'project_type_id' => 1, //Nota: Se debe especificar un 'project_type_id' existente en la base de datos.
                'company_id' => $company->id,
                'general_problem' => $data['generalProblem'],
                'general_objetive' => $data['generalObjetive'],
                'title' => $data['projectName'],
                'current_status_of_case' => $data['caseStatus'],
                'file' => 'ninguno.pdf',
                'status_id' => 1,
                'project_scopes' => $data['pScopes'],
                'specific_problems' => $data['sProblems'],
                'specific_objetives' => $data['sObjetives'],
                'limitations' => $data['pLimitations'],
                'tools' => $data['toolText'],
                'process_type_id' => 1, //Nota: Se debe especificar un 'process_type_id' existente en la base de datos.
                'modality_id' => 1, //Nota: Se debe especificar un 'modality_id' existente en la base de datos.
                //'period_id' => $period->id,
                'period_id' => $data['period_id'],
                'grade' => 100,
                'teleworking' => $data['teleworking'],
                'benefits' => '',
                'campus' => '',
                'students_quantity' => $data['studentQuantity']
            ]);

            DB::commit();

            return true;
        } catch (\Exeption $ex) {
            DB::rollback();
            return false;
        }
    }




    public static function acceptRejectProject($id, $statusId)
    {
        try {
            $project = Project::find($id);
            $status = Status::find($statusId);

            if ($project->status_id != 1) {
                return false;
            }

            $project->status_id = $statusId;
            $project->save();

            return true;
        } catch (\Exeption $ex) {
            return false;
        }
    }

    public static function changeProjectStatus($id, $statusId)
    {
        try {
            $project = Project::find($id);

            $project->status_id = $statusId;
            $project->save();

           // Mail::to($project->student->personal_email)->send(new ProjectStatusChanged($project->status->name, $project->title));

            return true;
        } catch (\Exeption $ex) {
            return false;
        }
    }

    public static function setProjectGrade($id, $grade)
    {
        try {
            $project = Project::find($id);
            $project->grade = $grade;

            if ($grade >= 80) {
                $project->status_id = 6;
            } else {
                $project->status_id = 7;
            }

            $project->save();
            return true;
        } catch (\Exeption $ex) {
            return false;
        }
    }

    public static function searchOportunity(array $data)
    {
        $searchResult = ProjectOpportunity::where('project_name', 'like', '%' . $data['name'] . '%');

        if (isset($data['period'])) {
            $searchResult->where('period_id', '=', $data['period']);
        }

        return $searchResult;
    }

    public static function createOportunity(array $data)
    {
        try {
            $period = Period::where('active', true)->first();

            ProjectOpportunity::create([
                'project_name' => isset($data['projectName']) ? $data['projectName'] : '',
                'project_description' => isset($data['generalProblem']) ? $data['generalProblem'] : '',
                'process_types_id' => $data['process'],
                'owner_name' => isset($data['contact_name']) ? $data['contact_name'] : '',
                'owner_email' => isset($data['contact_email']) ? $data['contact_email'] : '',
                'owner_phone' => isset($data['contact_phone']) ? $data['contact_phone'] : '',

                'period_id' => $period->id
            ]);

            return true;
        } catch (\Exeption $ex) {
            return false;
        }
    }

    public static function editOportunity(array $data)
    {
        try {
            $period = Period::where('active', true)->first();

            $oportunity = ProjectOpportunity::find($data['id']);
            $oportunity->project_name = $data['name'];
            $oportunity->project_description = $data['desc'];
            $oportunity->process_types_id = $data['process'];
            $oportunity->owner_name = $data['ownerName'];
            $oportunity->owner_email = $data['ownerEmail'];
            $oportunity->owner_phone = $data['ownerPhone'];
            $oportunity->save();

            return true;
        } catch (\Exeption $ex) {
            return false;
        }
    }

    public static function deleteOportunity($oportunity)
    {
        DB::beginTransaction();

        try {
            $oportunity = ProjectOpportunity::find($oportunity);
            $oportunity->delete();

            DB::commit();

            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            return false;
        }
    }

    public static function deleteProject($project)
    {
        DB::beginTransaction();

        try {
            $project = Project::find($project);
            $project->forceDelete();
//            dd($project);

            DB::commit();

            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            return false;
        }
    }
}
