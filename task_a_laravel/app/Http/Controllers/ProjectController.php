<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Employee;
use App\Models\Project;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ApiResponse;
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
            return $this->success($project, 'Project added successfully', 201);

        }catch (Exception $e) {
            return $this->error('Not found', 404, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return $this->success($project->load('employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try{
            $project->update($request->validated());
            return $this->success($project, 'Updated Successfully', 201);
        }catch (Exception $e) {
            return $this->error('Not found', 404, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return $this->success(null,'Deleted Successfully', 204);
    }

    public function dashboard()
    {
        return $this->success([
            'total_projects' => Project::count(),
            'total_employees' => Employee::count(),
            'projects_by_status' => Project::groupBy('status')->selectRaw('status, COUNT(*) as count')->get(),
            'projects' => Project::with('employees')->get(),
        ], 'all projects');
    }
}
