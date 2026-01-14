<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Admin\PaymentAccountResource;
use App\Models\PaymentAccount;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $payment = PaymentAccount::paginate(config('pagnation.PerPage'));

        if (!$payment) {
            return $this->errorResponse('Payment not found!', 404);
        }

        return $this->successResponse('Payment successfully!', $this->buildPaginatedResourceResponse(PaymentAccountResource::class, $payment), 200);
    }

    public function store($request)
    {
        $data = $request->validated();

        $payment = PaymentAccount::create($data);

        return $this->successResponse('Payment', new PaymentAccountResource($payment), 201);
    }
}
