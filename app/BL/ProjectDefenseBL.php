<?php

namespace App\BL;

use Illuminate\Support\Facades\DB;
use App\Enums\SaveResult;
use App\Models\Project;
use App\Models\ProjectDefense;
use App\Models\Period;
use App\Mail\DefenseCreation;
use App\Models\AcademicRepresentative;
use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Support\Facades\Mail;
use App\Mail\DefenseEditation;

class ProjectDefenseBL 
{
    public static function createDefense(array $data)
    {
        try
        {
            $period = Period::where('active', true)->first();
            $project = Project::where('student_id', '=', $data['student_id'])
                                ->where('status_id', '=', 2)
                                ->first();

            if ($project === null) {
                return false;
            }

            $date = date('Y-m-d', strtotime($data['defense_date']));
            $time = date("H:i", strtotime($data['defense_time']));

            $defense = ProjectDefense::create([
                'student_id' => $data['student_id'],
                'defense_time' => $time,
                'defense_date' => $date,
                'classroom' => $data['classroom'],
                'academic_representative_id' => ($data['academic_representative_id'] === 0 ? null : $data['academic_representative_id']),
                'project_id' => $project->id,
                'reader_id' => ($data['reader_id'] === 0 ? null : $data['reader_id']),
                'period_id' => $period->id
            ]);

            $readerName = (isset($defense->reader_id)?$defense->reader->getFullNameAttribute():null);

            //Mail::to($defense->academicRepresentative['email'])->send(new DefenseCreation($defense->academicRepresentative->getFullNameAttribute(), $readerName, $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
           // Mail::to($defense->student['personal_email'])->send(new DefenseCreation($defense->academicRepresentative->getFullNameAttribute(), $readerName, $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
            //Mail::to($defense->student['university_email'])->send(new DefenseCreation($defense->academicRepresentative->getFullNameAttribute(), $readerName, $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
            
            $tutor = $defense->student->tutors()->where('student_tutor.period_id', '=', $period->id)->first();
//            Mail::to($tutor->email)->send(new DefenseCreation($defense->academicRepresentative->getFullNameAttribute(), $readerName, $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
            
            if (isset($defense->reader_id)) {
                //Mail::to($defense->reader['email'])->send(new DefenseCreation($defense->academicRepresentative->getFullNameAttribute(), $defense->reader->getFullNameAttribute(), $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
                return true;
            }

            return false;
        }
        catch(Exception $ex)
		{
			return false;
		}
    }

    public static function editDefense(array $data)
    {
        try
        {
            $period = Period::where('active', true)->first();
            $date = date('Y-m-d', strtotime($data['defense_date']));
            $time = date("H:i", strtotime($data['defense_time']));

            $defense = ProjectDefense::find($data['id']);
            $defense->academic_representative_id = $data['academic_representative_id'];
            $defense->reader_id = ($data['reader_id'] == 0 ? null : $data['reader_id']);
            $defense->defense_date = $date;
            $defense->defense_time = $time;
            $defense->classroom = $data['classroom'];
            $defense->save();

            $readerName = (isset($defense->reader_id)?$defense->reader->getFullNameAttribute():null);

            Mail::to($defense->academicRepresentative['email'])->send(new DefenseEditation($defense->academicRepresentative->getFullNameAttribute(), $readerName, $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
            Mail::to($defense->student['personal_email'])->send(new DefenseEditation($defense->academicRepresentative->getFullNameAttribute(), $readerName, $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
            Mail::to($defense->student['university_email'])->send(new DefenseEditation($defense->academicRepresentative->getFullNameAttribute(), $readerName, $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
            
            $tutor = $defense->student->tutors()->where('student_tutor.period_id', '=', $period->id)->first();
//            Mail::to($tutor->email)->send(new DefenseEditation($defense->academicRepresentative->getFullNameAttribute(), $readerName, $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
            
            if (isset($defense->reader_id)) {
                Mail::to($defense->reader['email'])->send(new DefenseEditation($defense->academicRepresentative->getFullNameAttribute(), $defense->reader->getFullNameAttribute(), $defense->getDate(), $defense->getTime(),$defense->classroom, $defense->student->getFullNameAttribute()));
            }

            return true;
        }
        catch(Exception $ex)
		{
			return false;
		}
    }

    public static function searchDefense(array $data)
    {
        $period = Period::where('active', true)->first();
        $searchResult = ProjectDefense::where('project_defenses.period_id', '=', $period->id);

        $searchResult = $searchResult->join('students', function ($join) {
            $join->on('project_defenses.student_id', '=', 'students.person_profile_id');
        });
        $searchResult = $searchResult->join('person_profiles', function ($join) {
            $join->on('students.person_profile_id', '=', 'person_profiles.id');
        });

        $searchResult = $searchResult->where(function($query) use ($data) {
            $query->where('person_profiles.first_name', 'like', '%' . $data['name'] . '%')
            ->orWhere('person_profiles.last_name1', 'like', '%' . $data['name'] . '%');
        });
        //dd($searchResult->get());
        return $searchResult;
    }
}