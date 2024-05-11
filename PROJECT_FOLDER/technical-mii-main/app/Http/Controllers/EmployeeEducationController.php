<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Education;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeEducationController extends Controller
{
    public function index()
    {
        $employeesEducation = Education::all();
        return response()->json($employeesEducation);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
            'description' => 'required',
            'level' => ['required', Rule::in(['Tk', 'Sd', 'Smp', 'Sma', 'Strata 1', 'Strata 2', 'Doktor', 'Profesor'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $employeeEducation = Education::create($request->all());
        return response()->json($employeeEducation, 201);
    }

    public function show($id = null)
    {
        try {
            $employee = Education::findOrFail($id);
            return response()->json([
                'Data Employee' => $employee,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
            'description' => 'required',
            'level' => ['required', Rule::in(['Tk', 'Sd', 'Smp', 'Sma', 'Strata 1', 'Strata 2', 'Doktor', 'Profesor'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        try {
            $employeeFamily = Education::findOrFail($id);
            $employeeFamily->update($request->all());
            return response()->json($employeeFamily);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $employeeProfile = Education::findOrFail($id);
            $employeeProfile->delete();
            return response()->json(['success' => 'Data berhasil dihapus!.'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }
}
