<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\System\Promo\ExistPromo;
class SystemController extends Controller
{
    public function checkPromo(Request $request)
    {
        return response()->json([
            'exist' => (new ExistPromo())->existPromo($request->promo),
        ], 200);
    }
}