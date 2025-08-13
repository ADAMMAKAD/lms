<?php

namespace Modules\Installer\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Installer\app\Enums\InstallerInfo;

class PuchaseVerificationController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
    }

    public function index()
    {
        InstallerInfo::writeAssetUrl();
        // Automatically bypass purchase verification
        session()->put('step-1-complete', true);
        return redirect()->route('setup.requirements');
    }
    
    public function validatePurchase(Request $request)
    {
        // Automatically bypass purchase verification
        session()->put('step-1-complete', true);
        return response()->json(['success' => true, 'message' => 'Verification bypassed - proceeding to installation'], 200);
    }


}
