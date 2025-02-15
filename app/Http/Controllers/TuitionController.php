<?php
namespace App\Http\Controllers;

use App\Models\Tuition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TuitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Tuition::query();

        // Search by subject, category, or tutor name
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('subject', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('tutor', function ($q) use ($searchTerm) {
                      $q->where('name', 'LIKE', "%{$searchTerm}%");
                  });
        }
    
        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
    
        // Paginate results
        $tuitions = $query->paginate(10);
    
        return view('tuitions.index', compact('tuitions'));
    }

    public function create()
    {
        return view('tuitions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'fee' => 'required|numeric',
            'category' => 'required|string',
            'max_students' => 'required|integer|min:1',
        ]);
    
        // Save with authenticated tutor ID
        Tuition::create([
            'subject' => $request->subject,
            'fee' => $request->fee,
            'category' => $request->category,
            'max_students' => $request->max_students,
            'tutor_id' => auth()->id(), // Get the currently logged-in user's ID
        ]);
    
        return redirect()->route('tuitions.index')->with('success', 'Tuition created successfully.');
    }

    // public function edit(Tuition $tuition)
    // {
    //     $tuition->load('tutor'); // Ensure the tutor data is loaded
    //     return view('tuitions.edit', compact('tuition'));
    // }

    // public function update(Request $request, Tuition $tuition)
    // {
    //     $this->authorize('update', $tuition);

    //     $request->validate([
    //         'subject' => 'required',
    //         'fee' => 'required|numeric',
    //         'max_students' => 'required|integer',
    //         'category' => 'required|in:Primary,Lower Secondary,Upper Secondary',
    //         'image' => 'nullable|image|max:2048'
    //     ]);

    //     $tuition->update($request->all());

    //     if ($request->hasFile('image')) {
    //         $tuition->image = $request->file('image')->store('tutor_images', 'public');
    //         $tuition->save();
    //     }

    //     return redirect()->route('tuitions.index')->with('success', 'Tuition updated successfully!');
    // }

    public function show(Tuition $tuition)
    {
         $tuition->load('tutor'); // Ensure the tutor data is loaded
    return view('tuitions.show', compact('tuition'));
    }

    public function edit(Tuition $tuition)
    {
        // Ensure only the tutor who created the tuition can edit it
        if (auth()->user()->id !== $tuition->tutor_id) {
            return redirect()->route('tuitions.index')->with('error', 'Unauthorized action.');
        }
    
        return view('tuitions.edit', compact('tuition'));
    }

    public function update(Request $request, Tuition $tuition)
{
    $request->validate([
        'subject' => 'required|string',
        'fee' => 'required|numeric',
        'category' => 'required|string',
        'max_students' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        'description' => 'nullable|string', // Added validation for description
    ]);

    // Handle Image Upload
    if ($request->hasFile('image')) {
        if ($tuition->image_url) {
            Storage::delete('public/' . $tuition->image_url); // Delete old image
        }

        $imagePath = $request->file('image')->store('tuition_images', 'public');
        $tuition->image_url = $imagePath; // Store new image path
    }

    $tuition->update($request->except(['image']));
    
    return redirect()->route('tuitions.index')->with('success', 'Tuition updated successfully!');
}

public function destroy(Tuition $tuition)
{
    // Ensure only the tutor who created the tuition can delete it
    if (auth()->user()->id !== $tuition->tutor_id) {
        return redirect()->route('tuitions.index')->with('error', 'Unauthorized action.');
    }

    $tuition->delete();

    return redirect()->route('tuitions.index')->with('success', 'Tuition deleted successfully!');
}
    
}