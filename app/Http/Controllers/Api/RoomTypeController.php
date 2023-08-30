<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Response;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::all();

        return Response::withData(true, 'Oda Tipleri', $roomTypes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return Response::withoutData(false, $validator->errors());
        }

        $roomType = RoomType::create([
            'name' => $request->input('name'),
        ]);

        return Response::withData(true, 'Oda Tipi Eklenti', $roomType);
    }

    public function show($id)
    {
        $RoomType = RoomType::find($id);

        if (!$RoomType) {
            return Response::withoutData(false, 'Oda Bulunamadı');
        }

        return Response::withData(true, 'Oda', $RoomType);
    }

    public function destroy($id)
    {
        $RoomType = RoomType::find($id);

        if (!$RoomType) {
            return Response::withoutData(false, 'Oda Bulunamadı');
        }

        $RoomType->delete();

        return Response::withoutData(true, 'Oda Tipi Silindi');
    }

    public function update(Request $request, $id)
    {
        $roomType = RoomType::find($id);

        if (!$roomType) {
            return Response::withoutData(false, 'Oda bulunamadı', [], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return Response::withoutData(false, $validator->errors());
        }

        $roomType->update([
            'name' => $request->input('name'),
        ]);

        return Response::withData(true, 'Oda Tipi Başarıyla Güncellendi', $roomType);
    }
}
