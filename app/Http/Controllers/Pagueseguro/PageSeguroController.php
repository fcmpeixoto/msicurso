<?php

namespace App\Http\Controllers\Pagueseguro;

use App\Http\Controllers\Controller;
use App\Models\PagSeguro;
use Illuminate\Http\Request;

class PageSeguroController extends Controller
{
    //

    public function pagseguro(PagSeguro $pagSeguro)
    {
        $code = $pagSeguro->generate();

        $urlRedirect = config('pagseguro.url_redirect_after_request').$code;

        return redirect()->away($urlRedirect);
    }

    public function lightBox()
    {
        return view('pagueseguro.pagueseguro-lightbox');
    }

    public function lightBoxCode(PagSeguro $pagSeguro)
    {
        return $pagSeguro->generate();
    }

    public function transparente(PagSeguro $pagSeguro)
    {
        return view('pagueseguro.transparente');
    }

    public function getCode(PagSeguro $pagSeguro)
    {
        return $pagSeguro->getSessionId();
    }

    public function billet(Request $request, PagSeguro $pagseguro)
    {
        return $pagseguro->paymentBillet($request->sendHash);
    }
}
