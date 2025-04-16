<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarCollection;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarController extends Controller
{
    //function show list car
    public function index(Request $request)
    {
        try {

            // get car with search by name column
            $name = $request->input('name');
            $query = Car::query();
            if ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            }
            $query->orderBy('id', 'desc');
            $cars = $query->get();
            // $cars = Car::all();
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => [
                    'cars' => $cars
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

    //function update car
    public function update(UpdateCarRequest $request, $id): JsonResponse
    {
        try {
            $data = $request->validated();
            foreach ($data as $key => $value) {
                $result[Str::snake($key)] = $value;
            }
            $result['day_rate'] = $data['dayRate'];
            $car = Car::findOrFail($id);
            $car->update($result);
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => [
                    'message' => [
                        'Car updated success'
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

    //function get detail car by id
    public function show($id): JsonResponse
    {
        try {
            $car = Car::findOrFail($id);
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => $car,
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

    // function delete car
    public function delete($id): JsonResponse
    {
        try {
            $car = Car::findOrFail($id);
            $car->delete();
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => [
                    'message' => [
                        'Car deleted success'
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

    public function create(CreateCarRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            foreach ($data as $key => $value) {
                $result[Str::snake($key)] = $value;
            }
            $result['day_rate'] = $data['dayRate'];
            $car = new Car($result);
            $car->save();
            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => [
                    'message' => [
                        'Car created success'
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
}
