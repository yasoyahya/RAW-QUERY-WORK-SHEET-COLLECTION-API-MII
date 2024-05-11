<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\EmployeeFamily;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class EmployeeFamilyController extends Controller
{
    public function index()
    {
        $employeesFamily = EmployeeFamily::all();
        return response()->json($employeesFamily);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'religion' => ['required', Rule::in(['Islam', 'Katolik', 'Buda', 'Protestan', 'Konghucu'])],
            'is_life' => 'required|boolean',
            'is_divorced' => 'required|boolean',
            'relation_status' => ['required', Rule::in(['Suami', 'Istri', 'Anak', 'Anak Sambung'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $employeeFamily = EmployeeFamily::create($request->all());
        return response()->json($employeeFamily, 201);
    }

    public function show($id = null)
    {
        try {
            $employee = EmployeeFamily::findOrFail($id);
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
            'religion' => ['required', Rule::in(['Islam', 'Katolik', 'Buda', 'Protestan', 'Konghucu'])],
            'is_life' => 'required|boolean',
            'is_divorced' => 'required|boolean',
            'relation_status' => ['required', Rule::in(['Suami', 'Istri', 'Anak', 'Anak Sambung'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        try {
            $employeeFamily = EmployeeFamily::findOrFail($id);
            $employeeFamily->update($request->all());
            return response()->json($employeeFamily);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $employeeProfile = EmployeeFamily::findOrFail($id);
            $employeeProfile->delete();
            return response()->json(['success' => 'Data berhasil dihapus!.'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }
}
