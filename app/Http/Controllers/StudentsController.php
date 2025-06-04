<?php
namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
{
    public function myView()
    {
        $students = Students::orderBy('created_at', 'desc')->get();
        return view('welcome', compact('students'));
    }

    public function addNewStudent(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|numeric|min:1|max:150',
                'gender' => 'required|string|in:Male,Female,Other',
            ]);

            Students::create($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Student added successfully'
                ]);
            }

            return redirect()->route('std.myView')->with('success', 'Student added successfully');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add student. Please try again.'
                ], 422);
            }

            return back()->with('error', 'Failed to add student. Please try again.')
                        ->withInput();
        }
    }

    public function deleteStudent($id)
    {
        try {
            $student = Students::findOrFail($id);
            $student->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Student deleted successfully!'
                ]);
            }

            return redirect()->route('std.myView')->with('success', 'Student deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage());

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete student. Please check the ID or contact support.'
                ], 422);
            }

            return back()->with('error', 'Failed to delete student. Please check the ID or contact support.');
        }
    }
}
