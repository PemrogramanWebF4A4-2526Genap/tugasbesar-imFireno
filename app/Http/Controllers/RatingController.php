<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'order_id' => 'nullable|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if user already rated this service
        $existingRating = Rating::where('user_id', auth()->id())
            ->where('service_id', $request->service_id)
            ->first();

        if ($existingRating) {
            return back()->with('error', 'Anda sudah memberikan rating untuk jasa ini');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ratings', 'public');
        }

        Rating::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Rating berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $rating = Rating::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($rating->image) {
                Storage::disk('public')->delete($rating->image);
            }
            $rating->image = $request->file('image')->store('ratings', 'public');
        }

        $rating->rating = $request->rating;
        $rating->comment = $request->comment;
        $rating->save();

        return back()->with('success', 'Rating berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rating = Rating::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Delete image if exists
        if ($rating->image) {
            Storage::disk('public')->delete($rating->image);
        }

        $rating->delete();

        return back()->with('success', 'Rating berhasil dihapus');
    }
}
