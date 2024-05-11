<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Employee;
use App\Models\EmployeeFamily;
use App\Models\EmployeeProfile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        // Get all data dan relasi
        $employees = Employee::with(['educations', 'profiles', 'familys'])->get();
        return response()->json($employees);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_active' => 'required|boolean',
            'is_married' => 'required|boolean',
            'is_life' => 'required|boolean',
            'is_disvorced' => 'required|boolean',
            'start_date' => 'required',
            'end_date' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
            'description' => 'required',
            'gender' => ['required', Rule::in(['Laki-Laki', 'Perempuan'])],
            'religion' => ['required', Rule::in(['Islam', 'Katolik', 'Buda', 'Protestan', 'Konghucu'])],
            'relation_status' => ['required', Rule::in(['Suami', 'Istri', 'Anak', 'Anak Sambung'])],
            'level' => ['required', Rule::in(['Tk', 'Sd', 'Smp', 'Sma', 'Strata 1', 'Strata 2', 'Doktor', 'Profesor'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Data untuk tabel Profile
        $employeeData = [
            'nik' => $request->nik,
            'name' => $request->employee_name,
            'is_active' => $request->is_active,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => $request->created_by,
        ];

        $employee = Employee::create($employeeData);

        // Data untuk tabel Profile
        $profileData = [
            'employee_id' => $employee->id,
            'place_of_birth' => $request->employee_place_of_birth,
            'date_of_birth' => $request->employee_date_of_birth,
            'gender' => $request->gender,
            'is_married' => $request->is_married,
            'prof_pict' => $request->prof_pict,
            'created_by' => $request->created_by,
        ];

        // Simpan data ke tabel Profile
        $profile = EmployeeProfile::create($profileData);

        // Data untuk tabel Family
        $familyData = [
            'employee_id' => $employee->id,
            'name' => $request->family_name,
            'identifier' => $request->identifier,
            'job' => $request->job,
            'place_of_birth' => $request->family_place_of_birth,
            'date_of_birth' => $request->family_date_of_birth,
            'religion' => $request->religion,
            'is_life' => $request->is_life,
            'is_divorced' => $request->is_divorced,
            'relation_status' => $request->relation_status,
        ];

        // Simpan data ke tabel Profile
        $profile = EmployeeFamily::create($familyData);

        // Data untuk tabel Education
        $educationData = [
            'employee_id' => $employee->id,
            'name' => $request->education_name,
            'level' => $request->level,
            'description' => $request->description,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        ];

        // Simpan data ke tabel Profile
        $profile = Education::create($educationData);

        return response()->json(['employee' => $employee, 'profile' => $profile, 'family' => $familyData, 'education' => $educationData], 201);
    }

    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return response()->json([
                'Data Employee' => [
                    'nik' => $employee->nik,
                    'name' => $employee->name,
                    'is_active' => $employee->is_active,
                    'start_date' => $employee->start_date,
                    'end_date' => $employee->end_date,
                    'created_by' => $employee->created_by,
                    'updated_by' => $employee->updated_by,
                    'created_at' => $employee->created_at,
                    'updated_at' => $employee->created_by,
                ],
                'Data Educations' => $employee->educations,
                'Data Profile' => $employee->profiles,
                'Data Familys' => $employee->familys,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'is_active' => 'required|boolean',
            'is_married' => 'required|boolean',
            'start_date' => 'required',
            'end_date' => 'required',
            'updated_by' => 'required',
            'description' => 'required',
            'gender' => ['required', Rule::in(['Laki-Laki', 'Perempuan'])],
            'religion' => ['required', Rule::in(['Islam', 'Katolik', 'Buda', 'Protestan', 'Konghucu'])],
            'relation_status' => ['required', Rule::in(['Suami', 'Istri', 'Anak', 'Anak Sambung'])],
            'level' => ['required', Rule::in(['Tk', 'Sd', 'Smp', 'Sma', 'Strata 1', 'Strata 2', 'Doktor', 'Profesor'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        try {
            $employee = Employee::findOrFail($id);
            $employee->update([
                'nik' => $request->nik,
                'name' => $request->employee_name,
                'is_active' => $request->is_active,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'updated_by' => $request->updated_by,
            ]);

            $employeeProfile = EmployeeProfile::where('employee_id', $id)->firstOrFail();
            $employeeProfile->update([
                'place_of_birth' => $request->employee_place_of_birth,
                'date_of_birth' => $request->employee_date_of_birth,
                'gender' => $request->gender,
                'is_married' => $request->is_married,
                'prof_pict' => $request->prof_pict,
                'created_by' => $request->created_by,
                'updated_by' => $request->updated_by,
            ]);

            $employeeFamily = EmployeeFamily::where('employee_id', $id)->firstOrFail();
            $employeeFamily->update([
                'name' => $request->family_name,
                'identifier' => $request->identifier,
                'job' => $request->job,
                'place_of_birth' => $request->family_place_of_birth,
                'date_of_birth' => $request->family_date_of_birth,
                'religion' => $request->religion,
                'is_life' => $request->is_life,
                'is_divorced' => $request->is_divorced,
                'relation_status' => $request->relation_status,
                'updated_by' => $request->updated_by,
            ]);

            $employeeEducation = Education::where('employee_id', $id)->firstOrFail();
            $employeeEducation->update([
                'name' => $request->education_name,
                'level' => $request->level,
                'description' => $request->description,
                'updated_by' => $request->updated_by,
            ]);

            return response()->json(['employee' => $employee, 'profile' => $employeeProfile, 'family' => $employeeFamily, 'education' => $employeeEducation], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function report()
    {
        // Get all data dan relasi
        $employee = Employee::with('educations', 'profiles', 'familys')->first();

        $dateNow = \Illuminate\Support\Carbon::today();
        $date_of_birth = $employee->profiles->pluck('date_of_birth')[0];

        $status = $employee->familys->pluck('relation_status');
        $statusCounts = $employee->familys->pluck('relation_status')->countBy();

        $statusCounts = $employee->familys->pluck('relation_status')->countBy();

        $output = '';

        foreach ($statusCounts as $status => $count) {
            $output .= "$count $status & ";
        }

        $output = rtrim($output, ' &');

        $employeeID = $employee->id;
        $nik = $employee->nik;
        $name = $employee->name;
        $is_active = $employee->is_active;
        $gender = $employee->profiles->pluck('gender')[0];
        $age = $dateNow->diffInYears($date_of_birth);
        $schoolName = $employee->educations->pluck('name')[0];
        $level = $employee->educations->pluck('level')[0];

        return response()->json([
            'data' => [
                'employee_id' => $employeeID,
                'nik' => $nik,
                'name' => $name,
                'is_active' => $is_active,
                'gender' => $gender,
                'age' => $age . ' ' . 'Years Old',
                'schoolName' => $schoolName,
                'level' => $level,
                'family_data' => $output,
            ],
        ]);
    }
}
