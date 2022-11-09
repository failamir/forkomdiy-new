<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'team_create',
            ],
            [
                'id'    => 18,
                'title' => 'team_edit',
            ],
            [
                'id'    => 19,
                'title' => 'team_show',
            ],
            [
                'id'    => 20,
                'title' => 'team_delete',
            ],
            [
                'id'    => 21,
                'title' => 'team_access',
            ],
            [
                'id'    => 22,
                'title' => 'perizinan_create',
            ],
            [
                'id'    => 23,
                'title' => 'perizinan_edit',
            ],
            [
                'id'    => 24,
                'title' => 'perizinan_show',
            ],
            [
                'id'    => 25,
                'title' => 'perizinan_delete',
            ],
            [
                'id'    => 26,
                'title' => 'perizinan_access',
            ],
            [
                'id'    => 27,
                'title' => 'data_lembaga_create',
            ],
            [
                'id'    => 28,
                'title' => 'data_lembaga_edit',
            ],
            [
                'id'    => 29,
                'title' => 'data_lembaga_show',
            ],
            [
                'id'    => 30,
                'title' => 'data_lembaga_delete',
            ],
            [
                'id'    => 31,
                'title' => 'data_lembaga_access',
            ],
            [
                'id'    => 32,
                'title' => 'data_kerja_sama_create',
            ],
            [
                'id'    => 33,
                'title' => 'data_kerja_sama_edit',
            ],
            [
                'id'    => 34,
                'title' => 'data_kerja_sama_show',
            ],
            [
                'id'    => 35,
                'title' => 'data_kerja_sama_delete',
            ],
            [
                'id'    => 36,
                'title' => 'data_kerja_sama_access',
            ],
            [
                'id'    => 37,
                'title' => 'data_lembaga_daerah_access',
            ],
            [
                'id'    => 38,
                'title' => 'data_daerah_create',
            ],
            [
                'id'    => 39,
                'title' => 'data_daerah_edit',
            ],
            [
                'id'    => 40,
                'title' => 'data_daerah_show',
            ],
            [
                'id'    => 41,
                'title' => 'data_daerah_delete',
            ],
            [
                'id'    => 42,
                'title' => 'data_daerah_access',
            ],
            [
                'id'    => 43,
                'title' => 'data_master_access',
            ],
            [
                'id'    => 44,
                'title' => 'instansi_create',
            ],
            [
                'id'    => 45,
                'title' => 'instansi_edit',
            ],
            [
                'id'    => 46,
                'title' => 'instansi_show',
            ],
            [
                'id'    => 47,
                'title' => 'instansi_delete',
            ],
            [
                'id'    => 48,
                'title' => 'instansi_access',
            ],
            [
                'id'    => 49,
                'title' => 'kontak_create',
            ],
            [
                'id'    => 50,
                'title' => 'kontak_edit',
            ],
            [
                'id'    => 51,
                'title' => 'kontak_show',
            ],
            [
                'id'    => 52,
                'title' => 'kontak_delete',
            ],
            [
                'id'    => 53,
                'title' => 'kontak_access',
            ],
            [
                'id'    => 54,
                'title' => 'ketua_create',
            ],
            [
                'id'    => 55,
                'title' => 'ketua_edit',
            ],
            [
                'id'    => 56,
                'title' => 'ketua_show',
            ],
            [
                'id'    => 57,
                'title' => 'ketua_delete',
            ],
            [
                'id'    => 58,
                'title' => 'ketua_access',
            ],
            [
                'id'    => 59,
                'title' => 'regency_create',
            ],
            [
                'id'    => 60,
                'title' => 'regency_edit',
            ],
            [
                'id'    => 61,
                'title' => 'regency_show',
            ],
            [
                'id'    => 62,
                'title' => 'regency_delete',
            ],
            [
                'id'    => 63,
                'title' => 'regency_access',
            ],
            [
                'id'    => 64,
                'title' => 'district_create',
            ],
            [
                'id'    => 65,
                'title' => 'district_edit',
            ],
            [
                'id'    => 66,
                'title' => 'district_show',
            ],
            [
                'id'    => 67,
                'title' => 'district_delete',
            ],
            [
                'id'    => 68,
                'title' => 'district_access',
            ],
            [
                'id'    => 69,
                'title' => 'village_create',
            ],
            [
                'id'    => 70,
                'title' => 'village_edit',
            ],
            [
                'id'    => 71,
                'title' => 'village_show',
            ],
            [
                'id'    => 72,
                'title' => 'village_delete',
            ],
            [
                'id'    => 73,
                'title' => 'village_access',
            ],
            [
                'id'    => 74,
                'title' => 'province_create',
            ],
            [
                'id'    => 75,
                'title' => 'province_edit',
            ],
            [
                'id'    => 76,
                'title' => 'province_show',
            ],
            [
                'id'    => 77,
                'title' => 'province_delete',
            ],
            [
                'id'    => 78,
                'title' => 'province_access',
            ],
            [
                'id'    => 79,
                'title' => 'data_cabang_create',
            ],
            [
                'id'    => 80,
                'title' => 'data_cabang_edit',
            ],
            [
                'id'    => 81,
                'title' => 'data_cabang_show',
            ],
            [
                'id'    => 82,
                'title' => 'data_cabang_delete',
            ],
            [
                'id'    => 83,
                'title' => 'data_cabang_access',
            ],
            [
                'id'    => 84,
                'title' => 'data_ranting_create',
            ],
            [
                'id'    => 85,
                'title' => 'data_ranting_edit',
            ],
            [
                'id'    => 86,
                'title' => 'data_ranting_show',
            ],
            [
                'id'    => 87,
                'title' => 'data_ranting_delete',
            ],
            [
                'id'    => 88,
                'title' => 'data_ranting_access',
            ],
            [
                'id'    => 89,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
