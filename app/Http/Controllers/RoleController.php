<?php

namespace App\Http\Controllers;

class RoleController extends Controller
{
    public static function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'Admin':
                return 'admin.contentManagement';
            case 'Pelapor':
                return 'pelapor.reportPelapor';
            case 'Pimpinan':
                return 'pimpinan.dashboard';
            case 'Superuser':
                return 'superuser';
            default:
                return 'user.beranda';
        }
    }
}