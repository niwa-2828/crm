<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Inertia\Inertia;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
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


  public function store(StoreEmployeeRequest $request)
  {
    $validated = $request->validated();

    Employee::create($validated);

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

  public function update(UpdateEmployeeRequest $request, int $id)
  {
    $employee = Company::findOrFail($id);

    $validated = $request->validated();

    $employee->update($validated);

    return to_route('employees.index')
      ->with([
        'message' => '更新しました。',
        'status' => 'success'
      ]);
  }

  public function destroy(int $id)
  {
    $employee = Employee::findOrFail($id);

    $employee->delete();

    return to_route('employees.index')
      ->with([
        'message' => '削除しました。',
        'status' => 'danger'
      ]);
  }
}
