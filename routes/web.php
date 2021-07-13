<?php

Route::group(['middleware' => 'guest'], function () {
    //Landing Page
    Route::get('', 'LandingPageController@showLandingPage');

    Route::get('unauth/', 'LandingPageController@showLandingPage')->name('login');

    Route::get('download/{file}', 'LandingPageController@downloads')->name('download'); // Descarga simplificada, revisar Switch

    Route::get('test/', function(){
        //Mail::to('jorge.vasquez@ulatina.cr')->send(new ActivateNewStudent(10));
        return redirect()
        ->route('login')
        ->with('sucess', 'Para finalizar el registro por favor valide el usuario vía email.');
    });

    Route::post('loadingLogin/', 'Auth\LoginController@login')->name('loginForm');

    //Se usa luego de un registro.

    // Password Reset Routes. -> Landing Page.
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    // Registration Routes...
    //Student
    Route::get('registro/estudiante', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('registro/create/estudiantes', 'Auth\RegisterController@registroEstudiante')->name('createEstudiantes');
    Route::get('registro/estudiante/verificar/{id}', 'Auth\RegisterController@activarEstudiante')->name('activarEstudiante');
   

    //Registro
    Route::get('registro/academicos', 'Auth\RegisterController@showRegisterRegistrationForm')->name('registerRegistro');
    Route::post('registro/create/academicos', 'Auth\RegisterController@registerRegistro')->name('createAcademicos');

    Route::get('registerSelect', 'Auth\RegisterController@registerSelect')->name('registerSelect');

    //Company
    Route::get('registro/empresas', 'Auth\RegisterController@showCompanyRegistrationForm')->name('registerCompany');
    Route::post('registro/create/empresas', 'Auth\RegisterController@registerCompany')->name('createCompany');
    Route::get('emails/NewCompanyCreated','Auth\RegisterController@NotificationCompanyEmail')->name('sendNotificationC');
    Route::get('registro/empresa/verificar/{id}', 'Auth\RegisterController@activarEmpresa')->name('activarEmpresa');

    //Administrator
    Route::get('registro/admin', 'Auth\RegisterController@showAdminRegistrationForm');
    Route::post('registro/admin/create', 'Auth\RegisterController@registerAdmin')->name('registerAdmin');

    //Professor
    Route::get('registerProfessor', 'Auth\RegisterController@showProfessorRegistrationForm')->name('registerProfessor');
    Route::post('registerProfessor', 'Auth\RegisterController@registerProfessor');

    //Instituto
    Route::get('registerInstitute', 'Auth\RegisterController@showRegisterInstituteForm')->name('registerInstitute');
    Route::post('registerInstitute', 'Auth\RegisterController@registerInstitute');
});

Route::group(['middleware' => 'auth'], function () {
    /// Modulo Investigacion y Extension 

   Route::get('ModuloIE/Proyecto','ModuloIEController@index')->name('mostrarProyecto');
   Route::get('ModuloIE/Proyecto/create', 'ModuloIEController@create');
   Route::get('consultarUsuario/','ModuloIEController@consultarUsuario');


Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/PlanTrabajo/{plan_proyecto_id}/ObjetivosPlanTrabajo/create','ModuloIEController@createObjetivoPlanTrabajo');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/PlanTrabajo/{plan_proyecto_id}/ObjetivosPlanTrabajo/{objetivo_plan_proyecto_id}/edit','ModuloIEController@editObjetivoPlanTrabajo');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/PlanTrabajo/{plan_proyecto_id}/ObjetivosPlanTrabajo/{objetivo_plan_proyecto_id}/ver','ModuloIEController@verObjetivoPlanTrabajo');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/PlanTrabajo/create','ModuloIEController@createPlanTrabajo');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/PlanTrabajo/{plan_proyecto_id}/edit','ModuloIEController@editPlanTrabajo');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/PlanTrabajo/{plan_proyecto_id}/ver','ModuloIEController@verPlanTrabajo');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/PlanTrabajo/{plan_proyecto_id}/ObjetivosPlanTrabajo','ModuloIEController@indexObjetivosPlanTrabajo');

Route::get('myProject/','ModuloIEController@myProject');

Route::get('allProject/','ModuloIEController@allProject');

Route::get('guardarProyecto/','ModuloIEController@guardarProyecto');

Route::get('guardarPlanTrabajo/','ModuloIEController@guardarPlanTrabajo');

Route::get('guardarObjetivoPlan/','ModuloIEController@guardarObjetivoPlan');

Route::get('guardarEncargadoAsignado/','ModuloIEController@guardarEncargadoAsignado');

Route::get('modificarPlanTrabajo/','ModuloIEController@modificarPlanTrabajo');

Route::get('modificarProyecto/','ModuloIEController@modificarProyecto');

Route::get('modificarObjetivoPlan/','ModuloIEController@modificarObjetivoPlan');

Route::get('searchProject/','ModuloIEController@searchProject');

Route::get('searchProjectAll/','ModuloIEController@searchProjectAll');

Route::get('guardarUsuarioProyecto/','ModuloIEController@guardarUsuarioProyecto');

Route::get('guardarUsuarioProyectoProfeAdmin/','ModuloIEController@guardarUsuarioProyectoProfeAdmin');

Route::get('modificarResponsableProyectoProfeAdmin/','ModuloIEController@modificarResponsableProyectoProfeAdmin');

Route::get('guardarColaborador/','ModuloIEController@guardarColaborador');

Route::get('eliminarColaborador/','ModuloIEController@eliminarColaborador');

Route::get('eliminarUsuarioAsignado/','ModuloIEController@eliminarUsuarioAsignado');

Route::get('guardarObservaciones/','ModuloIEController@guardarObservaciones');

Route::get('guardarObservacionesObjetivo/','ModuloIEController@guardarObservacionesObjetivo');

Route::get('modificarObservaciones/','ModuloIEController@modificarObservaciones');

Route::get('modificarObservacionesObjetivo/','ModuloIEController@modificarObservacionesObjetivo');

Route::get('eliminarObservacion/','ModuloIEController@eliminarObservacion');

Route::get('eliminarObservacionObjetivo/','ModuloIEController@eliminarObservacionObjetivo');

Route::get('guardarObjetivoGeneral/','ModuloIEController@guardarObjetivoGeneral');

Route::get('modificarObjetivoGeneral/','ModuloIEController@modificarObjetivoGeneral');

Route::get('guardarObjetivoEspecifico/','ModuloIEController@guardarObjetivoEspecifico');

Route::get('modificarObjetivoEspecifico/','ModuloIEController@modificarObjetivoEspecifico');

Route::get('eliminarObjetivoEspecifico/','ModuloIEController@eliminarObjetivoEspecifico');

Route::get('eliminarObjetivosPlan/','ModuloIEController@eliminarObjetivosPlan');

Route::get('eliminarPlan/','ModuloIEController@eliminarPlan');

Route::get('validarUsuarioPro/','ModuloIEController@validarUsuarioPro');

Route::get('consultarPlan/','ModuloIEController@consultarPlan');

Route::get('consultarCantidadEstudiantes/','ModuloIEController@consultarCantidadEstudiantes');

Route::get('guardarEncargado/','ModuloIEController@guardarEncargado');

Route::get('buscarID/','ModuloIEController@buscarID');

Route::get('buscarEmail/','ModuloIEController@buscarEmail');

Route::get('buscarName/','ModuloIEController@buscarName');

Route::get('ModuloIE/Proyecto/redirectUser/', 'ModuloIEController@redirectUserP');

Route::get('redirect/','ModuloIEController@redirect');

Route::get('cargarPlanTrabajo/','ModuloIEController@cargarPlanTrabajo');

Route::get('cargarObjetivosPlan/','ModuloIEController@cargarObjetivosPlan');





//Route::resource('AcercaDeNosotros','AcerdaDeNosotrosController');

//Route::resource('ModuloIE/Proyecto/createProject', 'ModuloIEController@createProject');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/PlanTrabajo','ModuloIEController@indexPlanTrabajo');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/edit', 'ModuloIEController@edit');

Route::get('ModuloIE/Proyecto/{proyecto_investigacion_id}/participar', 'ModuloIEController@participar');

Route::patch('ModuloIE/Proyecto/{proyecto_investigacion_id}','ModuloIEController@update')->name('updateProyecto');

Route::delete('ModuloIE/Proyecto/{proyecto_investigacion_id}','ModuloIEController@destroy');

Route::get('ModuloIE/Proyecto/Excel/{DESCRIPCION}', 'SedeController@excel')->name('export_excel');

Route::get('ModuloIE/Proyecto/CSV/{DESCRIPCION}', 'SedeController@csvFormat')->name('export_csv');

Route::get('ModuloIE/Proyecto/PDF/{DESCRIPCION}', 'SedeController@exportPDF')->name('export_pdf');
























    //Descargar PDF  y Enviar Convalidaciones
    Route::get('/convalidacionPdf/{id}', 'ConvalidacionController@DownloadPdfConvalidacion');
    Route::post('/sendEmailPdfConvalidacion', 'ConvalidacionController@SendEmailConvalidacion')->name('sendEmailPdfConvalidacion');
    Route::get('/sendEmailPreConvalidacion/{id}', 'ConvalidacionController@SendEmailPreConvalidacion');


    Route::get('studentHome', 'StudentController@index')->name('studentHome');

    Route::get('rincon/inicio', 'rinconController@index')->name('rinconAcademico');
    Route::get('entorno/inicio', 'entornoController@index')->name('entornoColaborativo');

    Route::get('entorno/reportes', 'entornoController@reportes_index')->name('entorno.reportes.index');
    Route::post('entorno/reportes/filtro', 'entornoController@reportes_filtro')->name('entorno.reportes.filtro');
    Route::get('entorno/reportes/reporte', 'entornoController@generarPDFReporte')->name('entorno.reportes.reporte');
    Route::post('entorno/reportes/email', 'entornoController@enviarReportePorCorreo')->name('entorno.reportes.email');

    Route::post('logout/outlook', 'OutlookController@logout')->name('logoutOutlook');

    Route::get('index/', 'WebPageController@index')->name('webPage');
    Route::get('', 'WebPageController@index')->name('webPage');

    Route::get('forum', 'ForumController@index')->name('forum');
    Route::get('/forum/{catid}/titles', 'ForumController@showTitles')->name('showTitles');
    Route::get('/forum/{tid}/generateForumPost', 'ForumController@generateForumPost')->name('generateForumPost');
    Route::post('/forum/createForumPost', 'ForumController@createForumPost')->name('createForumPost');
    Route::get('/forum/{pid}/replies', 'ForumController@generateForumReplies')->name('generateForumReplies');
    Route::post('/forum/addReply', 'ForumController@createForumReply')->name('createForumReply');
    Route::get('/forum/download/{file}', 'ForumController@downloadFiles')->name('downloadFileForum');

    Route::get('/forum/{id}/editPost', 'ForumController@editForumPost')->name('editForumPost');
    Route::patch('/forum/{id}/updatePost', 'ForumController@updateForumPost')->name('updateForumPost');
    Route::patch('/forum/{id}/download', 'ForumController@downloadFile');

    Route::get('forum/search/', 'ForumController@indexSearch');

    Route::post('chat/insert','ForumController@insertNewChat')->name('newChat');

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('oportunities/index', 'ProjectOportunityController@index')->name('oportunities');
    Route::post('oportunities/index', 'ProjectOportunityController@index')->name('oportunities');
    Route::get('oportunities/show/{id}', 'ProjectOportunityController@show')->name('showOportunities');

    Route::get('oportunities/show/{id}', 'ProjectOportunityController@show')->name('showOportunities');

    Route::get('project', 'ProjectController@index')->name('project');

    Route::get('project/{id}/edit', 'ProjectController@edit')->name('editProject');
    Route::get('project/{id}/destroy', 'ProjectController@destroy')->name('destroyProject');
    Route::patch('project/{id}/update', 'ProjectController@update')->name('updateProject');

    Route::get('project/download/{file}', 'ProjectController@download')->name('downloadFile');

    Route::get('courses/todos/index', 'CourseController@index')->name('courses');
    Route::post('courses/index', 'CourseController@index')->name('courses');
    Route::post('courses/todos/index', 'CourseController@index')->name('courses');
    Route::get('courses/todos/index', 'CourseController@index')->name('courses');
    Route::post('courses/todos/index', 'CourseController@index')->name('courses');
    Route::get('courses/todos/create', 'CourseController@create')->name('createCourses');
    Route::post('courses/todos/createCourse', 'CourseController@createCourse')->name('createCourse');
    Route::post('courses/todos/createSchedule', 'CourseController@createSchedule')->name('createSchedule');
    Route::post('courses/todos/createTheme', 'CourseController@createTheme')->name('createTheme');
    Route::post('courses/todos/createThemeEdit', 'CourseController@createThemeEdit')->name('createThemeEdit');
    Route::post('courses/todos/createUniversityStudentTable', 'CourseController@createUniversityStudentTable')->name('createUNIStudentTable');
    Route::post('courses/todos/updateUniversityStudentTable', 'CourseController@updateUniversityStudentTable')->name('updateUniversityStudentTable');
    Route::post('courses/todos/createInstituteStudentTable', 'CourseController@createInstituteStudentTable')->name('createINSStudentTable');
    Route::post('courses/todos/updateInstituteStudentTable', 'CourseController@updateInstituteStudentTable')->name('updateInstituteStudentTable');
    Route::post('courses/mis_cursos/updateInstituteStudentTable_for_details', 'CourseController@createInstituteStudentTable_for_details')->name('createINSStudentTable_for_details');
    Route::post('courses/todos/comments', 'CourseController@comments')->name('courseComments');
    Route::post('courses/todos/updatecomments', 'CourseController@updateComments')->name('updateComments');
    Route::post('courses/mis_cursos/comments_for_details', 'CourseController@comments_for_details')->name('comments_for_details');
    Route::get('courses/todos/edit/{id}', 'CourseController@course')->name('editCourse');
    Route::post('courses/todos/edit/updateCourse', 'CourseController@updateCourse')->name('updateCourse');
    Route::get('courses/todos/edit/theme/{idCourse}/{idTheme}', 'CourseThemeController@theme')->name('editTheme');
    Route::post('courses/todos/edit/theme', 'CourseThemeController@updateTheme')->name('updateTheme');
    Route::get('courses/todos/destroyCourse/{id}', 'CourseController@destroyCourse')->name('destroyCourse');
    Route::get('courses/todos/destroyCourseTheme/{id}', 'CourseController@destroyCourseTheme')->name('destroyCourseTheme');
    Route::post('courses/todos/edit/deleteSchedule', 'CourseController@deleteSchedule')->name('deleteSchedule');
    Route::post('courses/todos/edit/updateSchedule', 'CourseController@updateSchedule')->name('updateSchedule');
    Route::match(['get','post'],'courses/mis_cursos/index', 'CourseController@index_my_courses')->name('my_courses');
    Route::get('courses/mis_cursos/detalle/{id}', 'CourseController@my_course')->name('detalle_curso');
    Route::get('courses/mis_cursos/detalle/solicitar/{id}', 'CourseController@solicitar_curso')->name('solicitar_curso');
    Route::get('courses/mis_cursos/detalle/eliminar_solicitud/{id}', 'CourseController@eliminar_solicitud_curso')->name('eliminar_solicitud_curso');
    Route::get('courses/mis_cursos/detalle/inscripcion/{id}', 'CourseController@inscripcion')->name('inscripcion');
    Route::get('courses/mis_cursos/detalle/eliminar_inscripcion/{id}', 'CourseController@eliminar_inscripcion')->name('eliminar_inscripcion');
    Route::get('courses/proceso/index', 'CourseController@proceso_curso_estudiante_universidad')->name('proceso_curso_estudiante_universidad');
    Route::post('courses/proceso/index', 'CourseController@proceso_curso_estudiante_universidad')->name('proceso_curso_estudiante_universidad');
    Route::get('courses/todos/archivo_poliza/{id}', 'CourseController@showPolicy')->name('showPolicy');
    Route::get('courses/todos/archivo_autorizacion/{id}', 'CourseController@showAuthorizationLetter')->name('showAuthorizationLetter');

    Route::get('investigation/index','InvestigationController@index')->name('showInvestigations');
    Route::get('investigation/myInvest','InvestigationController@myInvest')->name('myInvest');

    Route::get('investigation/idInvest/{id}','InvestigationController@participar')->name('idInvest');

    Route::get('courses/{id}/corequisites', 'LevantamientoController@getCorequisites')->name('getCorequisites');

    //
    Route::get('training/report', 'TrainingController@coursesReport')->name('coursesReport');
    Route::get('training/pdf/{id_training_course}', 'TrainingController@getreport')->name('getreport');
   
    //
    Route::get('training/create', 'TrainingController@trainingCreateView')->name('trainingCreateView');
    Route::post('training/save', 'TrainingController@trainingCreate')->name('trainingSave');
    Route::post('/vote/save', 'TrainingController@trainingVoteCreate')->name('trainingVoteCreate');
    Route::get('training/edit/{id}', 'TrainingController@trainingEditView')->name('trainingEditView');
    Route::post('training/edit', 'TrainingController@trainingEdit')->name('trainingEdit');
    Route::post('/training/delete' , 'TrainingController@trainingDelete')->name('trainingDelete');
    Route::post('/vote/delete' , 'TrainingController@deleteVote')->name('deleteVote');
    Route::post('/vote/delete2' , 'TrainingController@deleteVote2')->name('deleteVote2');
    Route::get('training/list', 'TrainingController@trainingList')->name('trainingList');
    Route::get('/admin/detail/{id_training_course}', 'TrainingController@trainingDetail');
    Route::get('/tutor/{id_training_course}', 'TrainingController@trainingCourseTutor')->name('trainingCourseTutor');
    Route::get('/tutorVote/{id_training_course}', 'TrainingController@trainingCourseTutorVote')->name('trainingCourseTutorVote');
    Route::get('/tutorVoteNew/{id_training_course}', 'TrainingController@trainingCourseTutorVoteNew')->name('trainingCourseTutorVoteNew');
    Route::get('/tutorVoteNewAdd/{id_training_course}', 'TrainingController@trainingCourseTutorVoteNewAdd')->name('trainingCourseTutorVoteNewAdd');
    Route::get('/matriculate/list/{id_training_course}', 'TrainingController@trainingCourseMatriculate')->name('trainingCourseMatriculate');   
    Route::post('/tutor/postulate', 'TrainingController@trainingPostulate')->name('trainingPostulate');
    Route::post('/tutor/cv', 'TrainingController@createTutorCV')->name('createTutorCV');
    Route::get('/tutor/cv/{user_id}', 'TrainingController@getTutorCv')->name('EditTutorCV');
    Route::get('download/cv/{id_training_tutor_cv}' , 'TrainingController@downloadFile')->name('downloadCv');
    Route::post('/training/cv/file/delete' , 'TrainingController@deleteCVFile')->name('deleteCVFile');
    Route::get('mycv' , 'TrainingController@myCV')->name('myCv');
    Route::post('mycv/edit' , 'TrainingController@editCV')->name('myCVEdit');
    Route::get('training/list/applications' , 'TrainingController@myApplications')->name('myApplications');
    Route::post('training/list/applications/delete' , 'TrainingController@deleteMyApplications')->name('deleteMyApplications');
    Route::get('training/admin' , 'TrainingController@adminTraining')->name('adminTraining');
    Route::post('tutor/condition/update' , 'TrainingController@updateTutorCondition')->name('updateTutorCondition');
    Route::post('course/condition/update' , 'TrainingController@updateCourseCondition')->name('updateCourseCondition');
    Route::post('/training/vote/update' , 'TrainingController@updateVote')->name('updateVote');
    Route::post('/training/vote/update2' , 'TrainingController@updateVote2')->name('updateVote2');
    Route::get('training/matriculate' , 'TrainingController@trainingMatriculate')->name('trainingMatriculate');
    Route::get('training/detail/{id_training_course}' , 'TrainingController@trainingCourseDetail');
    Route::post('training/matriculate/course' , 'TrainingController@trainingMatriculateCourse')->name('trainingMatriculateCourse');
    Route::get('/matriculate/list' , 'TrainingController@matriculateCourseList')->name('matriculateCourseList');
    Route::get('/training/votes' , 'TrainingController@myVoteList')->name('myVoteList');
    Route::post('/matriculate/delete' , 'TrainingController@matriculateDelete')->name('matriculateDelete');
    
    Route::get('/signin/outlook', 'AuthController@signin')->name('outlookSignin');
    Route::get('/authorize', 'AuthController@gettoken');
    Route::get('/mail/index', 'OutlookController@mail')->name('mail');
    Route::get('/calendar/index', 'OutlookController@calendar')->name('calendarIndex');
    Route::post('/calendar', 'OutlookController@saveCalendar')->name('saveCalendar');
    Route::post('/calendar/delete', 'OutlookController@deleteCalendar')->name('deleteCalendar');
    Route::post('/mail/delete', 'OutlookController@deleteMail')->name('deleteMail');
    Route::post('/library/search', 'OutlookController@searchLibrary')->name('searchLibrary');
    Route::post('/library/delete', 'OutlookController@deleteLibrary')->name('deleteLibrary');
    Route::get('/events/list', 'OutlookController@listEvents')->name('listEvents');
    Route::get('/library/list','OutlookController@listLibrary')->name('listLibrary');
    Route::get('/library/save/{id_calendar}','OutlookController@saveCalendarLibrary')->name('saveCalendarLibrary');
    Route::get('/events/list/next', 'OutlookController@listEventsNext')->name('listEventsNext');
    Route::get('/events/list/accomplished', 'OutlookController@listEventsAccomplished')->name('listEventsAccomplished');
    Route::get('/resository/{id_calendar}', 'OutlookController@repository');
    Route::post('/search/event/','OutlookController@searchEvent')->name('searchEvent');
    Route::post('/resository/create', 'OutlookController@reporitorySave')->name('reporitorySave');
    Route::get('/repository/list/{id_calendar}', 'OutlookController@repositoryList');
    Route::get('/download/{id_repository}' , 'OutlookController@downloadRepositoryFile');
    Route::post('/delete/repository' , 'OutlookController@deleteRepository')->name('deleteRepository');
    Route::get('/edit/repository/view/{id_repository}' , 'OutlookController@editRepositoryView');
    Route::post('/resository/edit' , 'OutlookController@editRepository')->name('editRepository');
    Route::post('/delete/event' , 'OutlookController@deleteEvent')->name('deleteEvent');
    Route::post('/resository/file/delete' , 'OutlookController@deleteFile')->name('deleteFile');
});

Route::group(['middleware' => 'student'], function () {
    // Student User Routes...
    Route::get('project', 'ProjectController@index')->name('project');
    Route::get('createproject', 'ProjectController@create')->name('createProject');
    Route::post('storeProject', 'ProjectController@store')->name('storeProject');
    Route::get('student/profile', 'StudentController@profile')->name('studentProfile');
    Route::post('student/editProfile', 'StudentController@editProfile')->name('editStudentProfile');
    Route::post('student/changePassword', 'StudentController@changePassword')->name('editPassword');

//    Ruta para agregar curriculum
    Route::post('student/addCurriculum/{idProject}', 'StudentController@addCurriculum')->name('addCurriculum');

//    Ruta para descargar curriculum
    Route::get('student/downloadCurriculum', 'StudentController@downloadCurriculum')->name('downloadCurriculum');

//    Ruta para agregar tutor
    Route::post('student/addtutor/{idProject}', 'StudentController@addtutor')->name('addTutor');


//    Ruta para aceptar Invitacion de participación a un proyecto
    Route::post('aceptarInvitacion/{id}','ProjectController@aceptarInvitacion')->name('aceptarInvitacion');

    Route::get('oportunities/show/{id}', 'ProjectOportunityController@show')->name('showOportunities');



    Route::get('reports/companiesReportStudents', 'ReportsController@companiesReportStudents')->name('companiesReportStudents');
    Route::post('reports/companiesReportStudents', 'ReportsController@companiesReportStudents')->name('companiesReportStudents');
    Route::get('reports/solicitudesreportstudents', 'ReportsController@solicitudeReportStudents')->name('solicitudesreportstudents');

    Route::get('reports/studentsreport', 'ReportsController@reportStudentPerformance')->name('studentsreport');

    Route::get('reports/projectReportstudents','ReportsController@projectinReportStudents')->name('participantesreportstudents');


    Route::get('project/{id}/showstudentProjectCompany','ProjectController@showCompanyProjectStudents')->name('showcompanyProjectStudent');


    Route::get('project/{id}/editCompanyProjectStudents', 'ProjectController@editCompanyProjectStudents')->name('editCompanyProjectStudents');
    Route::patch('project/{id}/updateCompanyProjectStudents', 'ProjectController@updateCompanyProjectStudents')->name('updateCompanyProjectStudents');
    Route::get('emails/SolicitudEnviada/{id}','ProjectController@notificacionsolicitud')->name('notificacionsolicitud');
    Route::get('deleteSolicitud/{id}','ProjectController@deleteSolicitud')->name('deleteSolicitud');

    Route::get('schedules/show/{id}', 'ScheduleController@show')->name('showSchedules');


  /* RUTAS PARA CONSULTAR LOS REQUISITOS DEL LOS CURSOS DE LA CARRERA */
  Route::get('consultar-planes', 'LevantamientoController@consultar_plan_get')->name('consultar-plan-get');
  Route::get('obtener-plan/{id}','LevantamientoController@obtener_plan')->name('obtener_plan');
  Route::match(['get','post'],'consultar-planes/ver_planes','LevantamientoController@ver_planes')->name('ver_planes');
  Route::get('obtener-requisitos','LevantamientoController@getCorequisitesConsulta')->name('getCorequisitesConsulta');

  Route::get('consultar-cursos-carreras/{id}', 'LevantamientoController@obtener_cursos_carrera')->name('consultar-cursos-carreras');
  Route::get('obtener-correquisitos-curso/{id}', 'LevantamientoController@getCorequisitesConsulta')->name('obtener-correquisitos-curso');
  //Levantamiento de Requisitos
  Route::get('levantamientos/crear', 'LevantamientoController@crearSolicitudLevantamiento')->name('crearSolicitudLevantamiento');
  Route::post('levantamientos/crear', 'LevantamientoController@store')->name('storeSolicitud');
  Route::get('levantamientos/edit/{id}', 'LevantamientoController@edit')->name('editSolicitud');
  Route::get('levantamientos/consultar', 'LevantamientoController@showConsultarSolicitudes')->name('consultarSolicitudes');
  Route::post('levantamientos/consultar', 'LevantamientoController@consultarSolicitudes')->name('misSolicitudes');
  Route::get('courses/{id}/corequisites', 'LevantamientoController@getCorequisites')->name('getCorequisitesStudent');


});

Route::group(['middleware' => 'institute'], function () {
    // Institute User Routes...
    Route::get('instituteHome', 'InstituteController@index')->name('instituteHome');
    Route::get('institute/profile', 'InstituteController@profile')->name('instituteProfile');
    Route::post('institute/editProfile', 'InstituteController@editInstituteProfile')->name('editInstituteProfile');
    Route::post('institute/changeInstitutePassword', 'InstituteController@changeInstitutePassword')->name('editInstitutePassword');
});

Route::group(['middleware' => 'companyadmin'], function () {
    // Institute User Routes...
    Route::get('oportunities/create', 'ProjectOportunityController@create')->name('createOportunities');
    Route::post('oportunities/store', 'ProjectOportunityController@store')->name('storeOportunities');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('project', 'ProjectController@index')->name('project');
    Route::post('project/{id}/changeStatus', 'ProjectController@changeStatus')->name('statusProject');

    Route::get('adminForumCategroies', 'ForumController@adminCategories')->name('adminForumCategroies');
    Route::get('adminForumTitles', 'ForumController@adminTitles')->name('adminForumTitles');

    Route::get('/forum/admincreateCategory', 'ForumController@adminCreateCategories')->name('adminCreateCategories');
    Route::get('/forum/{id}/editCategory', 'ForumController@editForumCategroies')->name('editForumCategroies');
    Route::post('/forum/createForumCategory', 'ForumController@createForumCategory')->name('createForumCategory');
    Route::patch('/forum/{cat}/updateCategory', 'ForumController@updateForumCategory')->name('updateAdminForumCategory');
    Route::get('/forum/{cat}/eliminarCategory', 'ForumController@deleteForumCategroies')->name('deleteForumCategroies');

    Route::patch('/forum/{title}/updateForumTitle', 'ForumController@updateForumTitle')->name('updateForumTitle');
    Route::get('/forum/{id}/editTitle', 'ForumController@editForumTitles')->name('editForumTitles');
    Route::get('/forum/admincreateTitle', 'ForumController@admincreateTitle')->name('admincreateTitle');
    Route::post('/forum/createForumTitle', 'ForumController@createForumTitle')->name('createForumTitle');
    Route::get('/forum/{title}/deleteForumTitle', 'ForumController@deleteForumTitle')->name('deleteForumTitle');
    Route::get('/forum/{pid}/deleteForumPost', 'ForumController@deleteForumPost')->name('deleteForumPost');

    //Levantamiento de Requisitos
    Route::get('levantamientos/solicitudes', 'LevantamientoController@solicitudesAdmin')->name('consultarAdmin');
    Route::get('obtener-planA/{id}','LevantamientoController@obtener_planA')->name('obtener_planA');
    Route::post('levantamientos/solicitudes', 'LevantamientoController@postSolicitudesAdmin')->name('postConsultarAdmin');
    Route::get('levantamientos/solicitudes/{period}/{career}/{sede}', 'LevantamientoController@showSolicitudes')->name('showSolicitudes');
    Route::get('levantamientos/solicitudes/{solicitud}', 'LevantamientoController@showSolicitudIndividual')->name('showSolicitudIndividual');
    Route::post('levantamientos/solicitudes/{solicitud}', 'LevantamientoController@updateSolicitud')->name('updateSolicitud');
    Route::get('obtener-planes/{id}','LevantamientoController@obtener_planes')->name('obtener_planes');
    Route::post('levantamientos/solicitudes/{solicitud}/sent', 'LevantamientoController@enviarARegistro')->name('enviarLevantamientoARegistro');
    Route::get('levantamientos/plan', 'LevantamientoController@showPlanEstudios')->name('showPlanEstudios');
    Route::get('levantamientos/plans', 'LevantamientoController@getPlanEstudio')->name('getPlanEstudios');
    Route::get('levantamientos/plans/lastUpdate', 'LevantamientoController@getLastUpdatePlan')->name('getLastUpdatePlan');
    Route::get('levantamientos/plans/{id}/edit', 'LevantamientoController@editPlanEstudios')->name('editPlanEstudios');
    Route::get('levantamientos/plans/{id}/addCourse', 'ContenidoCarreraController@create')->name('createContenidoCarrera');
    Route::post('levantamientos/plans/{id}/storeContenidoCarrera', 'ContenidoCarreraController@store')->name('storeContenidoCarrera');
    Route::post('levantamientos/plans/{id}/storeExistingContenidoCarrera', 'ContenidoCarreraController@storeExisting')->name('storeExistingContenidoCarrera');
    Route::get('levantamientos/plans/{idPlan}/editCourse/{idCourse}', 'ContenidoCarreraController@edit')->name('editContenidoCarrera');
    Route::post('levantamientos/plans/{idPlan}/editCourse/{idCourse}', 'ContenidoCarreraController@update')->name('updateContenidoCarrera');
    Route::post('levantamientos/plans/{idPlan}/removeCourse', 'ContenidoCarreraController@destroy')->name('destroyContenidoCarrera');
    Route::get('levantamientos/admin', 'LevantamientoController@consulta_Ad')->name('consulta_Ad');
    Route::match(['get','post'],'levantamiento/admin/ver_plan_Ad', 'LevantamientoController@ver_plan_Ad')->name('ver_plan_Ad');
    Route::match(['get','post'],'levantamientos/create', 'LevantamientoController@create_plans')->name('create_plans');
    Route::post('levantamientos/crearPlan', 'LevantamientoController@crearPlan')->name('crearPlan');
    Route::match(['get','post'],'levantamientos/create_planes', 'LevantamientoController@create_planes')->name('create_planes');
    Route::get('levantamientos/edit', 'LevantamientoController@edit_plans')->name('edit_plans');
    Route::get('levantamientos/eliminate', 'LevantamientoController@eliminate_plans')->name('eliminate_plans');
    Route::post('levantamientos/destroy', 'LevantamientoController@destroy')->name('destroy');

    Route::get('admin/courses/{id}/corequisites', 'LevantamientoController@getCorequisites')->name('getCorequisitesAdmin');

    Route::get('admin/home', 'AdminController@index')->name('adminHome');
    Route::post('admin/filter-students', 'AdminController@filterStudents')->name('filterStudents');
    Route::post('admin/home', 'AdminController@index')->name('adminHome');
    Route::get('admin/profile', 'AdminController@profile')->name('adminProfile');
    Route::post('admin/editProfile', 'AdminController@editProfile')->name('editAdminProfile');
    Route::post('admin/changePassword', 'AdminController@changePassword')->name('editAdminPassword');

    Route::get('admin/adminCompanies', 'AdminController@indexCompanies')->name('adminCompanies');
    Route::post('admin/adminCompanies', 'AdminController@indexCompanies')->name('adminCompanies');

    Route::get('admin/adminProjects', 'AdminController@adminProjects')->name('adminProjects');
    Route::post('admin/adminProjects', 'AdminController@adminProjects')->name('adminProjects');


    Route::get('period/index', 'PeriodController@index')->name('periods');
    Route::post('period/index', 'PeriodController@index')->name('periods');
    Route::get('period/create', 'PeriodController@create')->name('createPeriod');
    Route::post('period/store', 'PeriodController@store')->name('storePeriod');
    Route::get('period/edit/{id}', 'PeriodController@edit')->name('editPeriod');


    Route::get('tutors/index', 'TutorController@index')->name('tutors');
    Route::post('tutors/index', 'TutorController@index')->name('tutors');
    Route::get('tutor/create', 'TutorController@create')->name('createTutor');
    Route::post('tutor/store', 'TutorController@store')->name('storeTutor');
    Route::get('tutor/edit/{id}', 'TutorController@edit')->name('editTutor');
    Route::get('tutor/destroy/{id}', 'TutorController@destroy')->name('destroyTutor');
    Route::get('tutor/show/{id}', 'TutorController@show')->name('showTutor');
    Route::post('tutor/addStudent', 'TutorController@addStudent')->name('addStudent');
    Route::get('tutor/{tutor}/removeStudent/{student}', 'TutorController@removeStudent')->name('removeStudent');
    Route::get('tutor/sendNotification/{tutor}', 'TutorController@sendNotification')->name('sendNotification');

    Route::get('academicrep/index', 'AcademicRepController@index')->name('acadRepresentatives');
    Route::post('academicrep/index', 'AcademicRepController@index')->name('acadRepresentatives');
    Route::get('academicrep/create', 'AcademicRepController@create')->name('acadRepCreate');
    Route::get('academicrep/edit/{id}', 'AcademicRepController@edit')->name('editAcadRep');
    Route::post('academicrep/store', 'AcademicRepController@store')->name('storeAcadRep');
    Route::get('academicrep/destroy/{id}', 'AcademicRepController@destroy')->name('destroyAcadRep');

    Route::get('studentsview/index/{id}', 'UserViewController@index')->name('usersView');
    Route::post('studentsview/registerProcess', 'UserViewController@registerProcess')->name('registerProcess');

    Route::get('companiesView/indexCompanies/{id}', 'UserViewController@indexCompanies')->name('companiesView');
    Route::post('companiesview/activateCompany', 'UserViewController@activateCompany')->name('activateCompany');
    Route::get('emails/CompanyUnlocked/{id}', 'UserViewController@unlockCompany')->name('unlockCompany');

    Route::post('studentsview/activate', 'UserViewController@activate')->name('activate');
    Route::get('emails/StudentActivate/{id}','UserViewController@NotificationActivateStudent')->name('NotificationActivateStudent');

    Route::get('studentsview/update/{id}', 'UserViewController@update')->name('updatePeriod');
    Route::get('project/details/{id}', 'ProjectController@details')->name('projectDetails');
    Route::get('project/aceptProject/{id}', 'ProjectController@aceptProject')->name('aceptProject');
    Route::get('project/rejectProject/{id}', 'ProjectController@rejectProject')->name('rejectProject');
    Route::post('project/setGrade', 'ProjectController@setGrade')->name('setProjectGrade');

    Route::get('projectdefense/index', 'ProjectDefenseController@index')->name('defensesList');
    Route::post('projectdefense/index', 'ProjectDefenseController@index')->name('defensesList');
    Route::get('projectdefense/create', 'ProjectDefenseController@create')->name('createDefense');
    Route::get('projectdefense/edit/{id}', 'ProjectDefenseController@edit')->name('editDefense');
    Route::post('projectdefense/store', 'ProjectDefenseController@store')->name('storeDefense');
    Route::post('projectdefense/update', 'ProjectDefenseController@update')->name('updateDefense');
    Route::get('projectdefense/destroy/{id}', 'ProjectDefenseController@destroy')->name('destroyDefense');

    Route::get('reports/studentsreport', 'ReportsController@studentsReport')->name('studentsReport');
    Route::get('reports/export', 'ReportsController@export')->name('exportReport');
    Route::post('reports/studentsreport', 'ReportsController@studentsReport')->name('studentsReport');

    Route::get('reports/companiesreport', 'ReportsController@companiesReport')->name('companiesReport');
    Route::post('reports/companiesreport', 'ReportsController@companiesReport')->name('companiesReport');

    Route::get('project/{id}/editCompanyProjectAdmin', 'ProjectController@editCompanyProjectAdmin')->name('editCompanyProjectAdmin');
    Route::patch('project/{id}/updateCompanyProjectAdmin', 'ProjectController@updateCompanyProjectAdmin')->name('updateCompanyProjectAdmin');
    Route::get('emails/ProjectStatusChanged/{id}', 'ProjectController@Notification')->name('Notification');

    Route::get('project/{id}/rejectCompanyProjectAdmin', 'ProjectController@rejectCompanyProjectAdmin')->name('rejectCompanyProjectAdmin');

    Route::get('adminusers/index', 'AdminUsersController@index')->name('adminUsersI');
    Route::post('adminusers/index', 'AdminUsersController@index')->name('adminUsers');
    Route::get('adminusers/create', 'AdminUsersController@create')->name('createUsers');
    Route::post('adminusers/store', 'AdminUsersController@store')->name('storeUsers');
    Route::get('adminusers/destroy/{id}', 'AdminUsersController@destroy')->name('destroyUsers');

    Route::get('adminusers/index/{id}', 'UserViewController@indexAdminUsers')->name('indexAdminUsers');
    Route::get('adminusers/activateUser', 'UserViewController@activateAdminUser')->name('activateAdminUser');
    Route::post('adminusers/activateUser', 'UserViewController@activateAdminUser')->name('activateAdminUser');

    Route::get('oportunities/create', 'ProjectOportunityController@create')->name('createOportunities');
    Route::get('oportunities/edit/{id}', 'ProjectOportunityController@edit')->name('editOportunities');
    Route::post('oportunities/store', 'ProjectOportunityController@store')->name('storeOportunities');
    Route::get('oportunities/destroy/{id}', 'ProjectOportunityController@destroy')->name('destroyOportunities');

    Route::get('/Registro', 'RegistroController@index')->name('nuevaMateria');
    Route::post('/Registro', 'RegistroController@store');
    Route::get('/Registro/{id}', 'RegistroController@showMateria')->name('registroView');

    //Aqui estoy definiendo la ruta para las vistas en donde se importara el excel
    Route::get('/import', 'ExcelController@index')->name('import');
    Route::post('/import', 'ExcelController@storeCarreraUlatina');
    Route::post('/import/uploadMateria', 'ExcelController@storeMateriaUlatina');
    Route::post('/import/uploadCsv', 'ExcelController@storeCSV');

    Route::get('/convalidacion', 'InicioController@index')->name('indexConvalidaciones');

    Route::get('/convalidacion', 'ConvalidacionController@index')->name('iniciarConvalidacion');
    Route::post('/convalidacion', 'ConvalidacionController@storeEstudiante');
    Route::post('/convalidacion', 'ConvalidacionController@ModificarConvalidacion');


    Route::post('/convalidacion/save', 'ConvalidacionController@store')->name('guardarEstudiante');


    Route::get('/convalidacion/{id}', 'ConvalidacionController@show')->name('convalidacionView');
    Route::get('/reporteConvalidacion/{id}', 'ConvalidacionController@GenerarConvalidacion')->name('reporteConvalidacion');
    Route::get('convalidacion/destroy/{id}', 'ConvalidacionController@DeteleteConvalidacion')->name('eliminarConvalidacion');
    Route::name('ImprimirPeriodo')->get('/Convalidacion/PdfConvalidacion/PeriodoReporte', 'ConvalidacionController@imprimirConvalidacionPeriodo');

    

    //Route to ContenidoController
    Route::resource('/contenidoCarrera', 'ContenidoCarreraController');
    Route::get('/obtenerMateriasUla', 'ContenidoCarreraController@ObtenerMateriasUla')->name('materiasUla');

    //Route to ContenidoUniversidad
    Route::resource('/contenidoUniversidad', 'ContenidoUniversidadController');
    Route::get('/obtenerMateriaUniversidad', 'ContenidoUniversidadController@ObtenerMateriasUniversidades')->name('materiasUniversidades');

    Route::get('/VerRegistro', 'RegistroController@verRegistros')->name('verView');
    Route::get('/VerRegistro/1', 'RegistroController@show');

    Route::get('/AnalisisCarrera', 'AnalisisController@reportCarrera')->name('analisisCarrera');
    Route::get('/AnalisisCarrera/1', 'AnalisisController@showCarrera');

    Route::get('/AnalisisPeriodo', 'AnalisisController@reportPeriodo')->name('analisisPeriodo');
    Route::get('/AnalisisPeriodo/1', 'AnalisisController@showPeriodo');

    Route::get('/AnalisisInstituto', 'AnalisisController@reportInstituto')->name('analisisInstituto');
    Route::get('/AnalisisInstituto/1', 'AnalisisController@showInstituto');

    Route::get('/horario', 'HorarioController@index');
    Route::get('/curso', 'CursoController@index');
    Route::get('/profesor', 'ProfesorController@index');
    Route::get('/encuesta', 'EncuestaController@index');

    Route::get('/horario/create', 'HorarioController@create');
    Route::get('/horario/index', 'HorarioController@index')->name('horarioIndex');
    Route::get('/horario/{horario}/edit', 'HorarioController@edit');
    Route::patch('/horario/{horario}','HorarioController@update');
    Route::post('/horario', 'HorarioController@store');
    Route::post('/horario/create','HorarioController@store');
    Route::delete('/horario/{horario}', 'HorarioController@destroy');

    Route::get('/curso/create', 'CursoController@create');
    Route::get('/curso/index', 'CursoController@index')->name('cursoIndex');
    Route::get('/curso/{curso}/edit', 'CursoController@edit');
    Route::patch('/curso/{curso}', 'CursoController@update');
    Route::post('/curso', 'CursoController@store');
    Route::post('/curso/create', 'CursoController@store');
    Route::get('/curso/{curso}/destroy', 'CursoController@destroy');
    Route::post('/curso/index', 'CursoController@index');

    Route::get('/profesor/create', 'ProfesorController@create');
    Route::get('/profesor/index', 'ProfesorController@index')->name('profesorIndex');
    Route::get('/profesor/{profesor}/edit', 'ProfesorController@edit');
    Route::patch('/profesor/{profesor}', 'ProfesorController@update');
    Route::post('/profesor', 'ProfesorController@store');
    Route::post('/profesor/create', 'ProfesorController@store');
    Route::get('/profesor/{profesor}/destroy', 'ProfesorController@destroy');
    Route::post('/profesor/index', 'ProfesorController@index');

    Route::get('/encuesta/create','EncuestaController@create');
    Route::get('/encuesta/index', 'EncuestaController@index')->name('encuestaIndex');
    Route::get('/encuesta/{encuesta}/edit', 'EncuestaController@edit');
    Route::patch('/encuesta/{encuesta}','EncuestaController@update');
    Route::post('/encuesta', 'EncuestaController@store');
    Route::post('/encuesta/create', 'EncuestaController@store');
    Route::get('/encuesta/{encuesta}/destroy', 'EncuestaController@destroy');
    Route::post('/encuesta/index', 'EncuestaController@index');

    Route::get('schedules/index', 'ScheduleController@index')->name('schedules');
    Route::post('schedules/index', 'ScheduleController@index')->name('schedules');
    Route::get('schedules/create', 'ScheduleController@create')->name('createSchedules');
    Route::post('schedules/store', 'ScheduleController@store')->name('storeSchedules');
    Route::get('schedules/edit/{id}', 'ScheduleController@edit')->name('editSchedules');
    Route::get('schedules/destroy/{id}', 'ScheduleController@destroy')->name('destroySchedules');
    Route::get('tutors/AssignTutorParticipant/{id}','ProjectController@assignParticipantTutor')->name('assignParticipantTutor');
    Route::post('tutors/AssignTutorParticipant','TutorController@addstudentCompanyproject')->name('assignTutor');
    Route::get('tutor/assigned/{id}','TutorController@notificationTutor')->name('tutornotification');

    //rutas para modulo de investigacion
    Route::get('investigation/create','InvestigationController@create')->name('createInvestigation');
    Route::get('investigation/plan','InvestigationController@plan')->name('plan');
    Route::get('investigation/showPlan','InvestigationController@showPlan')->name('showPlan');
    Route::post('investigation/store','InvestigationController@store')->name('storeInvest');
    Route::post('investigation/update/{id}','InvestigationController@update')->name('updateInvest');
    Route::get('investigation/store','InvestigationController@store')->name('storeInvest');
    Route::post('plan/store/{id}','planController@store')->name('storePlan');
    Route::post('plan/update/{id}/{idObj?}','planController@update')->name('updatePlan');
    Route::get('plan/edit/{id}/{idObj?}','planController@edit')->name('editObj');
    Route::get('investigation/destroy/{id}','InvestigationController@destroy')->name('destroyInve');
    Route::get('plan/destroy/{id}','PlanController@destroy')->name('destroyObje');

    Route::get('ApprovedStudentsReport', 'ReportsController@ApprovedStudentsReport')->name('ApprovedStudentsReport');
    Route::post('ApprovedStudentsReport', 'ReportsController@ApprovedStudentsReport')->name('ApprovedStudentsReport');
    Route::get('excelApprovedStudentsReport', 'ReportsController@generateReport')->name('GenerateExcel');


    Route::get('creditos',function(){
        return view('Inicio.creditos');
    })->name('creditos');
});

Route::group(['middleware' => 'empresa'], function () {

    Route::get('empresa', 'EmpresaController@index')->name('empresa');
    Route::get('empresa/profile', 'EmpresaController@profile')->name('empresaProfile');
});

Route::group(['middleware' => 'company'], function () {
    Route::get('company', 'CompanyController@index')->name('company');

    //profile
    Route::get('company/profile', 'CompanyController@profile')->name('companyProfile');
    Route::post('company/editProfile', 'CompanyController@editProfile')->name('editCompanyProfile');
    Route::post('company/changePassword', 'CompanyController@changePassword')->name('editPassword');


    //projects
    Route::get('projectsCompany', 'ProjectController@indexCompany')->name('projectsCompany');
    Route::get('createCompanyProject', 'ProjectController@create')->name('createCompanyProject');

    Route::get('listCompanyPendingApprovals', 'ProjectController@indexCompanyPendingApprovals')->name('listCompanyPendingApprovals');
    
    Route::post('storeProjectCompany', 'ProjectController@storeCompany')->name('storeProjectCompany');
    Route::get('emails/NewProject','ProjectController@NewProject')->name('NewProject');

    Route::get('project/{id}/editCompanyProject', 'ProjectController@editCompanyProject')->name('editCompanyProject');
    Route::patch('project/{id}/updateCompanyProject', 'ProjectController@updateCompanyProject')->name('updateCompanyProject');
    Route::get('downloadC/{id}','ProjectController@downloadfileC')->name('downloadfileC');



    Route::get('enviarInvitacion/{id}','ProjectController@enviarInvitacion')->name('enviarInvitacion');

    Route::get('aceptarInvitacion/{id}','ProjectController@aceptarInvitacion')->name('aceptarInvitacion');

    //    Route::get('project/{id}/aceptarInvitacion','ProjectController@aceptarInvitacion')->name('aceptarInvitacion');  -old
//    Route::get('project/aceptarInvitacion/{id}','ProjectController@aceptarInvitacion')->name('aceptarInvitacion');

//    Route::get('project/{id}/editCompanyProjectStudents', 'ProjectController@editCompanyProjectStudents')->name('editCompanyProjectStudents');
//    Route::get('reports/solicitudesreportstudents', 'ReportsController@solicitudeReportStudents')->name('solicitudesreportstudents'); voy por aqui... aceptar invitacion...


    Route::get('aceptSolicitud/{id}','ProjectController@aceptSolicitud')->name('aceptSolicitud');
    Route::get('rejectSolicitud/{id}','ProjectController@rejectSolicitud')->name('rejectSolicitud');

    Route::get('emails/CambiodeEstadoSolicitud/{id}','ProjectController@notificarsolicitud')->name('notificarsolicitud');

    Route::get('project/{id}/changestudentPerformanceCompany','ProjectController@changestudentPerformanceCompany')->name('studentPerformance');
    Route::post('project/{id}/setgrade','ProjectController@setgradeParticipante')->name('setgrade');
    Route::post('project/{id}/setperformanceParticipante','ProjectController@setperformanceParticipante')->name('editStudentperformance');
    Route::get('emails/ReportStudentPerformance/{id}','ProjectController@reportStudentPerformance')->name('reportstudentperformance');
});






Route::group(['middleware' => 'registro'], function () {

    Route::get('/Registro', 'RegistroController@index')->name('nuevaMateria');
    Route::post('/Registro', 'RegistroController@store');
    Route::get('/Registro/{id}', 'RegistroController@showMateria')->name('registroView');

    Route::get('/convalidaciones', 'InicioController@index')->name('indexConvalidaciones');

    Route::get('/convalidacion', 'ConvalidacionController@index')->name('iniciarConvalidacion');
    Route::post('/convalidacion/store', 'ConvalidacionController@storeEstudiante')->name('convstorestudent');
    Route::post('/convalidacion/1', 'ConvalidacionController@store')->name('guardarEstudiante');
    Route::get('/convalidacion/{id}', 'ConvalidacionController@show')->name('convalidacionView');
    Route::get('/reporteConvalidacion/{id}', 'ConvalidacionController@GenerarConvalidacion')->name('reporteConvalidacion');


//Registro
    Route::get('registerusers/index', 'RegisterUsersController@index')->name('registerUsers');
    Route::post('registerusers/index', 'RegisterUsersController@index')->name('registerUsers');
    Route::get('registerusers/create', 'RegisterUsersController@create')->name('createUsers');
    Route::post('registerusers/store', 'RegisterUsersController@store')->name('storeUsers');
    Route::get('registerusers/destroy/{id}', 'RegisterUsersController@destroy')->name('destroyUsers');
    Route::get('registerusers/index/{id}', 'UserViewController@indexRegisterUsers')->name('indexRegisterUsers');
    Route::get('registerusers/activateUser', 'UserViewController@activateRegisterUser')->name('activateRegisterUser');
    Route::post('registerusers/activateUser', 'UserViewController@activateRegisterUser')->name('activateRegisterUser');




    //rutas a agregadas recientes
    Route::post('/convalidacion/modificar/materias', 'ConvalidacionController@ShowMateriasConvalidacion')->name('modificarMateriasConvalidacion');

    Route::get('/convalidacion/modificar/{id}', 'ConvalidacionController@showConvalidacion')->name('modificarConvalidacion');


    //Route to ContenidoController
    Route::resource('/contenidoCarrera', 'ContenidoCarreraController');
    Route::get('/obtenerMateriasUla', 'ContenidoCarreraController@ObtenerMateriasUla')->name('materiasUla');

    //Route to ContenidoUniversidad
    Route::resource('/contenidoUniversidad', 'ContenidoUniversidadController');
    Route::get('/obtenerMateriaUniversidad', 'ContenidoUniversidadController@ObtenerMateriasUniversidades')->name('materiasUniversidades');

    Route::get('/VerRegistro', 'RegistroController@verRegistros')->name('verView');
    Route::get('/VerRegistro/1', 'RegistroController@show');

    Route::get('/AnalisisCarrera', 'AnalisisController@reportCarrera')->name('analisisCarrera');
    Route::get('/AnalisisCarrera/1', 'AnalisisController@showCarrera');

    Route::get('/AnalisisPeriodo', 'AnalisisController@reportPeriodo')->name('analisisPeriodo');
    Route::get('/AnalisisPeriodo/1', 'AnalisisController@showPeriodo');

    Route::get('/AnalisisInstituto', 'AnalisisController@reportInstituto')->name('analisisInstituto');
    Route::get('/AnalisisInstituto/1', 'AnalisisController@showInstituto');

    //Levantamiento de Requisitos
  Route::get('levantamientos/Re', 'LevantamientoController@consultar_plan_Re')->name('consultar');
  Route::get('obtener-planR/{id}','LevantamientoController@obtener_planR')->name('obtener_planR');
  Route::match(['get','post'],'levantamientos/Re/ver_plan_Re', 'LevantamientoController@ver_plan_Re')->name('ver_plan_Re');
  Route::get('levantamientos/crear', 'LevantamientoController@crearSolicitudLevantamiento')->name('crearSolicitudLevantamiento');
  Route::post('levantamientos/crear', 'LevantamientoController@store')->name('storeSolicitud');
  Route::get('courses/{id}/corequisites', 'LevantamientoController@getCorequisites')->name('getCorequisitesStudent');
   /* ruta para obtener por axios, los cursos de la carrera que se seleccione */
   Route::get('obtener-cursos-plan/{id}', 'LevantamientoController@obtener_cursos_plan')->name('obtener-cursos-plan');
     /* ruta para enviar la solicitud a guardar en la base de datos */
  Route::post('levantamientos/guardar-solicitud', 'LevantamientoController@guardar_solicitud')->name('guardar-solicitud'); 
  Route::get('levantamientos/consultar', 'LevantamientoController@showConsultarSolicitudes')->name('consultarSolicitudes');
  Route::post('levantamientos/consultar', 'LevantamientoController@consultarSolicitudes')->name('misSolicitudes');

  Route::get('levantamientos/edit/{id}', 'LevantamientoController@edit')->name('editSolicitud');

  Route::get('levantamientos/consultar-detalle-solicitud/{id}', 'LevantamientoController@mostrarSolicitudDetalles')->name('consultar-detalle-solicitud');

  /* imprimir modulo TCU,PES, TFG reportes*/
  Route::get('reports/imprimirpdf/{person_profile_id}', 'ReportsController@proyect_pdf')->name('proyect_pdf');

});
