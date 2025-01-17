<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Employee;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $query = Project::query();

            if ($request->has('name')) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            }
        
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }
        
            return response()->json($query->with('employees')->paginate(10)); // Includes pagination

        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {

            $project = Project::create($request->validated());
            return response()->json($project, 201);

        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json($project->load('employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try{
            $project->update($request->validated());
            return response()->json($project);
        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }

    public function dashboard()
    {
        return response()->json([
            'total_projects' => Project::count(),
            'total_employees' => Employee::count(),
            'projects_by_status' => Project::groupBy('status')->selectRaw('status, COUNT(*) as count')->get(),
            'projects' => Project::with('employees')->get(),
        ]);
    }
}
