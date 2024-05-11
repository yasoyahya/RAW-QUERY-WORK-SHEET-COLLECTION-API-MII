<?php

namespace App\Http\Controllers;

use App\Models\EmployeeProfile;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeProfileController extends Controller
{
    public function index()
    {
        $employeesProfile = EmployeeProfile::all();
        return response()->json($employeesProfile);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'gender' => ['required', Rule::in(['Laki-Laki', 'Perempuan'])],
            'is_married' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $employeeProfile = EmployeeProfile::create($request->all());
        return response()->json($employeeProfile, 201);
    }

    public function show($id)
    {
        try {
            $employee = EmployeeProfile::findOrFail($id);
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
            'gender' => ['required', Rule::in(['Laki-Laki', 'Perempuan'])],
            'is_married' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        try {
            $employeeProfile = EmployeeProfile::findOrFail($id);
            $employeeProfile->update($request->all());
            return response()->json($employeeProfile);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $employeeProfile = EmployeeProfile::where('employee_id', $id)->firstOrFail();
            $employeeProfile->delete();
            return response()->json(['success' => 'Data berhasil dihapus!.'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }
}
