<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Inertia\Inertia;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeesController extends Controller
{
  public function index()
  {
    $employees = Employee::with('company')->get();

    return Inertia::render('Employees/Index', [
      'employees' => $employees,
    ]);
  }

  public function create()
  {
    return Inertia::render('Employees/Create', [
      'companies' => Company::all(),
    ]);
  }


  public function store(EmployeeRequest $request)
  {
    Employee::create($request->validated());

    return to_route('employees.index')
      ->with([
        'message' => '作成しました。',
        'status' => 'success'
      ]);
  }

  public function edit(int $id)
  {
    try {
      $employee = Employee::findOrFail($id);

      return Inertia::render('Employees/Edit', [
        'employee' => $employee,
        'companies' => Company::all(),
      ]);
    } catch (ModelNotFoundException $e) {
      return to_route('employees.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger'
        ]);
    }
  }

  public function update(EmployeeUpdateRequest $request, Employee $employee)
  {
    $employee->update($request->validated());

    return to_route('employees.index')
      ->with([
        'message' => '更新しました。',
        'status' => 'success'
      ]);
  }

  public function destroy(Employee $employee)
  {
    $employee->delete();

    return to_route('employees.index')
      ->with([
        'message' => '削除しました。',
        'status' => 'danger'
      ]);
  }
}
