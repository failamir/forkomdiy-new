<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Perizinan
    Route::delete('perizinans/destroy', 'PerizinanController@massDestroy')->name('perizinans.massDestroy');
    Route::post('perizinans/media', 'PerizinanController@storeMedia')->name('perizinans.storeMedia');
    Route::post('perizinans/ckmedia', 'PerizinanController@storeCKEditorImages')->name('perizinans.storeCKEditorImages');
    Route::post('perizinans/parse-csv-import', 'PerizinanController@parseCsvImport')->name('perizinans.parseCsvImport');
    Route::post('perizinans/process-csv-import', 'PerizinanController@processCsvImport')->name('perizinans.processCsvImport');
    Route::resource('perizinans', 'PerizinanController');

    // Data Lembaga
    Route::delete('data-lembagas/destroy', 'DataLembagaController@massDestroy')->name('data-lembagas.massDestroy');
    Route::post('data-lembagas/media', 'DataLembagaController@storeMedia')->name('data-lembagas.storeMedia');
    Route::post('data-lembagas/ckmedia', 'DataLembagaController@storeCKEditorImages')->name('data-lembagas.storeCKEditorImages');
    Route::post('data-lembagas/parse-csv-import', 'DataLembagaController@parseCsvImport')->name('data-lembagas.parseCsvImport');
    Route::post('data-lembagas/process-csv-import', 'DataLembagaController@processCsvImport')->name('data-lembagas.processCsvImport');
    Route::resource('data-lembagas', 'DataLembagaController');

    // Data Kerja Sama
    Route::delete('data-kerja-samas/destroy', 'DataKerjaSamaController@massDestroy')->name('data-kerja-samas.massDestroy');
    Route::post('data-kerja-samas/media', 'DataKerjaSamaController@storeMedia')->name('data-kerja-samas.storeMedia');
    Route::post('data-kerja-samas/ckmedia', 'DataKerjaSamaController@storeCKEditorImages')->name('data-kerja-samas.storeCKEditorImages');
    Route::post('data-kerja-samas/parse-csv-import', 'DataKerjaSamaController@parseCsvImport')->name('data-kerja-samas.parseCsvImport');
    Route::post('data-kerja-samas/process-csv-import', 'DataKerjaSamaController@processCsvImport')->name('data-kerja-samas.processCsvImport');
    Route::resource('data-kerja-samas', 'DataKerjaSamaController');

    // Data Daerah
    Route::delete('data-daerahs/destroy', 'DataDaerahController@massDestroy')->name('data-daerahs.massDestroy');
    Route::post('data-daerahs/media', 'DataDaerahController@storeMedia')->name('data-daerahs.storeMedia');
    Route::post('data-daerahs/ckmedia', 'DataDaerahController@storeCKEditorImages')->name('data-daerahs.storeCKEditorImages');
    Route::post('data-daerahs/parse-csv-import', 'DataDaerahController@parseCsvImport')->name('data-daerahs.parseCsvImport');
    Route::post('data-daerahs/process-csv-import', 'DataDaerahController@processCsvImport')->name('data-daerahs.processCsvImport');
    Route::resource('data-daerahs', 'DataDaerahController');

    // Instansi
    Route::delete('instansis/destroy', 'InstansiController@massDestroy')->name('instansis.massDestroy');
    Route::post('instansis/parse-csv-import', 'InstansiController@parseCsvImport')->name('instansis.parseCsvImport');
    Route::post('instansis/process-csv-import', 'InstansiController@processCsvImport')->name('instansis.processCsvImport');
    Route::resource('instansis', 'InstansiController');

    // Kontak
    Route::delete('kontaks/destroy', 'KontakController@massDestroy')->name('kontaks.massDestroy');
    Route::post('kontaks/parse-csv-import', 'KontakController@parseCsvImport')->name('kontaks.parseCsvImport');
    Route::post('kontaks/process-csv-import', 'KontakController@processCsvImport')->name('kontaks.processCsvImport');
    Route::resource('kontaks', 'KontakController');

    // Ketua
    Route::delete('ketuas/destroy', 'KetuaController@massDestroy')->name('ketuas.massDestroy');
    Route::post('ketuas/parse-csv-import', 'KetuaController@parseCsvImport')->name('ketuas.parseCsvImport');
    Route::post('ketuas/process-csv-import', 'KetuaController@processCsvImport')->name('ketuas.processCsvImport');
    Route::resource('ketuas', 'KetuaController');

    // Regencies
    Route::delete('regencies/destroy', 'RegenciesController@massDestroy')->name('regencies.massDestroy');
    Route::post('regencies/parse-csv-import', 'RegenciesController@parseCsvImport')->name('regencies.parseCsvImport');
    Route::post('regencies/process-csv-import', 'RegenciesController@processCsvImport')->name('regencies.processCsvImport');
    Route::resource('regencies', 'RegenciesController');

    // Districts
    Route::delete('districts/destroy', 'DistrictsController@massDestroy')->name('districts.massDestroy');
    Route::post('districts/parse-csv-import', 'DistrictsController@parseCsvImport')->name('districts.parseCsvImport');
    Route::post('districts/process-csv-import', 'DistrictsController@processCsvImport')->name('districts.processCsvImport');
    Route::resource('districts', 'DistrictsController');

    // Villages
    Route::delete('villages/destroy', 'VillagesController@massDestroy')->name('villages.massDestroy');
    Route::post('villages/parse-csv-import', 'VillagesController@parseCsvImport')->name('villages.parseCsvImport');
    Route::post('villages/process-csv-import', 'VillagesController@processCsvImport')->name('villages.processCsvImport');
    Route::resource('villages', 'VillagesController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::post('provinces/parse-csv-import', 'ProvincesController@parseCsvImport')->name('provinces.parseCsvImport');
    Route::post('provinces/process-csv-import', 'ProvincesController@processCsvImport')->name('provinces.processCsvImport');
    Route::resource('provinces', 'ProvincesController');

    // Data Cabang
    Route::delete('data-cabangs/destroy', 'DataCabangController@massDestroy')->name('data-cabangs.massDestroy');
    Route::post('data-cabangs/media', 'DataCabangController@storeMedia')->name('data-cabangs.storeMedia');
    Route::post('data-cabangs/ckmedia', 'DataCabangController@storeCKEditorImages')->name('data-cabangs.storeCKEditorImages');
    Route::post('data-cabangs/parse-csv-import', 'DataCabangController@parseCsvImport')->name('data-cabangs.parseCsvImport');
    Route::post('data-cabangs/process-csv-import', 'DataCabangController@processCsvImport')->name('data-cabangs.processCsvImport');
    Route::resource('data-cabangs', 'DataCabangController');

    // Data Ranting
    Route::delete('data-rantings/destroy', 'DataRantingController@massDestroy')->name('data-rantings.massDestroy');
    Route::post('data-rantings/media', 'DataRantingController@storeMedia')->name('data-rantings.storeMedia');
    Route::post('data-rantings/ckmedia', 'DataRantingController@storeCKEditorImages')->name('data-rantings.storeCKEditorImages');
    Route::post('data-rantings/parse-csv-import', 'DataRantingController@parseCsvImport')->name('data-rantings.parseCsvImport');
    Route::post('data-rantings/process-csv-import', 'DataRantingController@processCsvImport')->name('data-rantings.processCsvImport');
    Route::resource('data-rantings', 'DataRantingController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
