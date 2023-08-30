<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Response;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();

        return Response::withData(true, 'Oteller', $hotels);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'phone' => 'required|max:20',
            'email' => 'required|email|max:255',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return Response::withoutData(false, $validator->errors());
        }

        $hotel = Hotel::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'description' => $request->input('description'),
        ]);

        return Response::withData(true, 'Otel Başarıyla Eklenti', $hotel);
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return Response::withoutData(false, 'Otel Bulunamadı');
        }

        return Response::withData(true, 'Otel', $hotel);
    }

    public function destroy($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return Response::withoutData(false, 'Otel Bulunamadı');
        }

        $hotel->delete();

        return Response::withoutData(true, 'Otel Başarıyla Silindi');
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return Response::withoutData(false, 'Otel bulunamadı', [], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'phone' => 'required|max:20',
            'email' => 'required|email|max:255',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return Response::withoutData(false, $validator->errors());
        }

        $hotel->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'description' => $request->input('description'),
        ]);

        return Response::withData(true, 'Otel Başarıyla Güncellendi', $hotel);
    }
}
