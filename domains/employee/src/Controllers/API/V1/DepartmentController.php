<?php

namespace SkylarkSoft\HoneyComb\Employee\Controllers\API\V1;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SkylarkSoft\HoneyComb\Employee\Models\Department;
use SkylarkSoft\HoneyComb\Employee\Requests\DepartmentRequest;

class DepartmentController extends Controller
{

    public function index()
    {
        try {
            $department = Department::paginate(10);
            $response = [
                'data' => $department,
                'status' => Response::HTTP_OK,
                'message' => "positions fetched succesfully"
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

    public function show($id)
    {
        try {
            $department = Department::query()->findOrFail($id);

            $response = [
                'data' => $department,
                'status' => Response::HTTP_OK,
                'message' => "position fetched succesfully"
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

    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department;
            $requestedAttributes = $request->all();
            $department->fill($requestedAttributes)->save();
            $response = [
                'data' => $department,
                'status' => Response::HTTP_OK,
                'message' => "position created succesfully"
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

    public function update(DepartmentRequest $request, $id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->fill($request->all())->save();
            $response = [
                'data' => $department,
                'status' => Response::HTTP_OK,
                'message' => "Data succesfully Updated"
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
            $department = Department::find($id);
            $department->delete();
            $response = [
                'data' => $department,
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

