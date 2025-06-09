<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    //
    public function exportUserData(Request $request, User $user)
    {
        $userPdf = Pdf::loadView('pdf.userExport', compact('user'));

        return $userPdf->download("{$user->name}.pdf");
    }

}
