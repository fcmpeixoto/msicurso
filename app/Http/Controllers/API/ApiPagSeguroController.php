<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PagSeguro;
use App\Models\Pedido;

class ApiPagSeguroController extends Controller
{
    public function request(Request $request, PagSeguro $pagseguro, Pedido $pedido)
    {
        if(!$request->notificationCode)
            return response()->json(['error' => 'NotNotificationCode'], 404);
        
        $response = $pagseguro->getStatusTransaction($request->notificationCode);

        $pedidos = $pedido->where('referencia', $response['reference'])->get()->first();

        if($pedidos->status != $response['status'])
        {
            $pedido->update(['status' => $response['status']]);
        }

        $pedidos->changeStatus($response['status']);
        
        return response()->json(['success' => true]);
    }
}
