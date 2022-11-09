<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Perizinan
    Route::post('perizinans/media', 'PerizinanApiController@storeMedia')->name('perizinans.storeMedia');
    Route::apiResource('perizinans', 'PerizinanApiController');

    // Data Lembaga
    Route::post('data-lembagas/media', 'DataLembagaApiController@storeMedia')->name('data-lembagas.storeMedia');
    Route::apiResource('data-lembagas', 'DataLembagaApiController');

    // Data Kerja Sama
    Route::post('data-kerja-samas/media', 'DataKerjaSamaApiController@storeMedia')->name('data-kerja-samas.storeMedia');
    Route::apiResource('data-kerja-samas', 'DataKerjaSamaApiController');

    // Data Daerah
    Route::post('data-daerahs/media', 'DataDaerahApiController@storeMedia')->name('data-daerahs.storeMedia');
    Route::apiResource('data-daerahs', 'DataDaerahApiController');

    // Instansi
    Route::apiResource('instansis', 'InstansiApiController');

    // Kontak
    Route::apiResource('kontaks', 'KontakApiController');

    // Ketua
    Route::apiResource('ketuas', 'KetuaApiController');

    // Regencies
    Route::apiResource('regencies', 'RegenciesApiController');

    // Districts
    Route::apiResource('districts', 'DistrictsApiController');

    // Villages
    Route::apiResource('villages', 'VillagesApiController');

    // Provinces
    Route::apiResource('provinces', 'ProvincesApiController');

    // Data Cabang
    Route::post('data-cabangs/media', 'DataCabangApiController@storeMedia')->name('data-cabangs.storeMedia');
    Route::apiResource('data-cabangs', 'DataCabangApiController');

    // Data Ranting
    Route::post('data-rantings/media', 'DataRantingApiController@storeMedia')->name('data-rantings.storeMedia');
    Route::apiResource('data-rantings', 'DataRantingApiController');
});
