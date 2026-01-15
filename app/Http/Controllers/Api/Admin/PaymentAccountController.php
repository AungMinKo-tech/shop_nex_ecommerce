<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\Admin\PaymentAccountRequest;
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

    public function store(PaymentAccountRequest $request)
    {
        $data = $request->validated();

        $payment = PaymentAccount::create($data);

        return $this->successResponse('Payment', new PaymentAccountResource($payment), 201);
    }

    public function update(PaymentAccountRequest $request, $id)
    {
        $payment = PaymentAccount::find($id);

        if (!$payment) {
            return $this->errorResponse('Payment not found!', 404);
        }

        $data = $request->validated();

        $payment->update($data);

        return $this->successResponse('Payment', new PaymentAccountResource($payment), 200);
    }

    public function destroy($id)
    {
        $payment = PaymentAccount::find($id);

        if (!$payment) {
            return $this->errorResponse('Payment not found!', 404);
        }

        $payment->delete();

        return $this->successResponse('Payment', null, 204);
    }
}
