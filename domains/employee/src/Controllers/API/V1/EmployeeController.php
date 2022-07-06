<?php


namespace SkylarkSoft\HoneyComb\Employee\Controllers\API\V1;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SkylarkSoft\HoneyComb\Employee\Models\Employee;
use SkylarkSoft\HoneyComb\Employee\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            $employee = Employee::paginate(5);
            $response = [
                'data' => $employee,
                'status' => Response::HTTP_OK,
                'message' => "Employee info fetched successfully"
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $error) {
            $response = [
                'data' => [],
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $error->getMessage()
            ];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(EmployeeRequest $request)
    {
        try {

            $employee = Employee::firstOrNew(['id' => $request->get('id')]);

            //$employee = new Employee;
            //$employee = Employee::where('id', $request->get('id'))->first();

            $resultedAttributes = $request->all();
            $employee->fill($resultedAttributes)->save();

            $response = [
                'data' => $employee,
                'status' => Response::HTTP_OK,
                'message' => "Information stored successfully"
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $error) {
            $response = [
                'data' => [],
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $error->getMessage(),
                'file' => $error->getFile()
            ];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show($id)
    {
        try {
            $employee = Employee::query()->findOrFail($id);
            $response = [
                'data' => $employee,
                'status' => Response::HTTP_OK,
                'message' => "Employee fetched succesfully"
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $error) {
            $response = [
                'data' => [],
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $error->getMessage()
            ];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(EmployeeRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->fill($request->all())->save();
            $response = [
                'data' => $employee,
                'status' => Response::HTTP_OK,
                'message' => "Employee data succesfully updated"
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $error) {
            $response = [
                'data' => [],
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $error->getMessage()
            ];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $employee = Employee::find($id);
            $employee->delete();
            $response = [
                'data' => $employee,
                'status' => Response::HTTP_OK,
                'message' => "Data succesfully Deleted"
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $error) {
            $response = [
                'data' => [],
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $error->getMessage()
            ];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
