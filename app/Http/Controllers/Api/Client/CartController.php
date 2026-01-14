<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\Client\CartRequest;
use App\Http\Resources\Client\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->paginate(config('pagination.perPage'));

        return $this->successResponse('Cart retrieved successfully', $this->buildPaginatedResourceResponse(CartResource::class, $cartItems), 200);
    }

    public function store(CartRequest $request)
    {
        $data = $request->validated();

        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $data['productId'],
            ],
            [
                'qty' => DB::raw('quantity + ' . $data['qty'])
            ]
        );

        return $this->successResponse('Cart add successfully', new CartResource($cart), 201);
    }

    public function update(CartRequest $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);

        $cart->update([
            'qty' => $request->validated()['qty']
        ]);

        return $this->successResponse('Cart updated successfully', new CartResource($cart), 200);
    }

    public function destroy($id)
    {
        Cart::where('user_id', auth()->id())->findOrFail($id)->delete();

        return $this->successResponse('Cart deleted successfully', null, 204);
    }
}
