<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    public function index()
    {
        $shoes = Shoe::with('category')->get();
        return view('shoes.index', compact('shoes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('shoes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            if ($request->hasFile('cover')) {
                $validated['cover'] = $request->file('cover')->store('covers', 'public');
            }

            Shoe::create($validated);
            return redirect()->route('shoes.index')->with('success', 'Shoe created successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to create shoe: ' . $e->getMessage());
            return redirect()->route('shoes.create')->with('error', 'Failed to create shoe. Please try again.');
        }
    }

    public function show(Shoe $shoe)
    {
        try {
            return view('shoes.show', compact('shoe'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve shoe: ' . $e->getMessage());
            return redirect()->route('shoes.index')->with('error', 'Failed to retrieve shoe. Please try again.');
        }
    }

    public function edit(Shoe $shoe)
    {
        $categories = Category::all();
        return view('shoes.edit', compact('shoe', 'categories'));
    }

    public function update(Request $request, Shoe $shoe)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            if ($request->hasFile('cover')) {
                if ($shoe->cover) {
                    Storage::disk('public')->delete($shoe->cover);
                }
                $validated['cover'] = $request->file('cover')->store('covers', 'public');
            }

            $shoe->update($validated);
            return redirect()->route('shoes.index')->with('success', 'Shoe updated successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to update shoe: ' . $e->getMessage());
            return redirect()->route('shoes.edit', $shoe->id)->with('error', 'Failed to update shoe. Please try again.');
        }
    }

    public function destroy(Shoe $shoe)
    {
        try {
            if ($shoe->cover) {
                Storage::disk('public')->delete($shoe->cover);
            }
            $shoe->delete();
            return redirect()->route('shoes.index')->with('success', 'Shoe deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to delete shoe: ' . $e->getMessage());
            return redirect()->route('shoes.index')->with('error', 'Failed to delete shoe. Please try again.');
        }
    }
}