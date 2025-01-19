<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\NameImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NameImageController extends Controller
{
    public function index()
    {
        // Fetch all records from the database (adjust based on your schema)
        $records = NameImage::all();

        // Map the records to include a full URL for the image path
        $records = $records->map(function ($record) {
            // Assuming the image path is stored in 'image_path' field
            $record->image_url = asset('storage/' . $record->image_path);
            return $record;
        });

        // Return the records as a JSON response
        
        return response()->json(['data' => $records], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $nameImage = NameImage::create([
            'name' => $request->name,
            'image_path' => $imagePath,
        ]);

        return response()->json(['message' => 'Record created successfully', 'data' => $nameImage], 201);
    }

    public function destroy($id)
    {
        $nameImage = NameImage::find($id);

        if (!$nameImage) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Delete the image file
        Storage::disk('public')->delete($nameImage->image_path);

        $nameImage->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
}
