<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderController extends Controller
{
    // function show list order
    public function index(Request $request): JsonResponse
    {
        try {
            $orders = Order::with('car')
            ->when($request->filled('pickupLocation'), function ($query) use ($request) {
                $query->where('pickup_location', 'like', '%' . $request->pickupLocation . '%');
            })
            ->get();

            // $orders = Order::with('car')->get();
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => $orders,
                'info' => null,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->getMessage(),
                'data' => null,
                'info' => null,
            ], 500);
        }
    }

    // function create new order
    public function create(CreateOrderRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            foreach ($data as $key => $value) {
                $result[Str::snake($key)] = $value;
            }
            $order = new Order($result);
            $order->save();
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => [
                    'message' => [
                        'Order created success'
                    ]
                ],
                'info' => null,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->getMessage(),
                'data' => null,
                'info' => null,
            ], 500);
        }
    }

    // function delete order
    public function delete($id): JsonResponse
    {
        try {
            $order = $this->getDetail($id);
            $order->delete();
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => [
                    'message' => [
                        'Order deleted success'
                    ]
                ],
                'info' => null,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->getMessage(),
                'data' => null,
                'info' => null,
            ], 500);
        }
    }
    // function update order
    public function update(UpdateOrderRequest $request, $id): JsonResponse
    {
        try {
            $data = $request->validated();
            foreach ($data as $key => $value) {
                $result[Str::snake($key)] = $value;
            }
            $order = $this->getDetail($id);
            $order->update($result);
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => [
                    'message' => [
                        'Order updated success'
                    ]
                ],
                'info' => null,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->getMessage(),
                'data' => null,
                'info' => null,
            ], 500);
        }
    }
    // function get detail order by id
    public function show($id): JsonResponse
    {
        try {
            $order = $this->getDetail($id);
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => $order,
                'info' => null,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->getMessage(),
                'data' => null,
                'info' => null,
            ], 500);
        }
    }

    private function getDetail($orderId): Order
    {
        $order = Order::where('id', $orderId)->first();
        if (!$order) {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => [
                    'message' => [
                        'Data not found'
                    ]
                ],
                'data' => null,
                'info' => null,
            ])->setStatusCode(404));
        }
        return $order;
    }
}
