<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/tree/data/data.csv', 'w');

        // Write the updated data to the file
        $regency = \App\Models\Regency::where('id_province', '34')->get();
        $data = array(
            array('id', 'name', 'parent_id', 'created_at', 'published_on', 'last_loaded', 'owner', 'url'),
            array('1', 'Yogyakarta', 'null', '', '', '', '', ''),
            // array('2','Node 2','1','','','',''),
            // array('3','Node 3','1','','','',''),
            // array('4','Node 4','2','','','',''),
        );
        $i = 2;
        foreach ($regency as $key => $value) {
            $data[] = array($i, $value->regency_name, '1', '', '', '', '', '');
            $i++;
            $district = \App\Models\District::where('id_regency', $value->id_regency)->get();
            foreach ($district as $key => $value) {
                $data[] = array($i, $value->district_name, $i - 1, '', '', '', '', '');
                $i++;
            }
            $village = \App\Models\Village::where('id_district', $value->id_district)->get();
            foreach ($village as $key => $value) {
                $data[] = array($i, $value->village_name, $i - 1, '', '', '', '', '');
                $i++;
            }
        }

        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        // Close the file
        fclose($file);
        
        return view('home', compact('data'));
    }
}
