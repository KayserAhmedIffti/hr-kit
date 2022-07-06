<?php

namespace SkylarkSoft\HoneyComb\Employee\Controllers\API\V1;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SkylarkSoft\HoneyComb\Employee\Models\Leave;
use SkylarkSoft\HoneyComb\Employee\Requests\LeaveRequest;

class LeaveController extends Controller
{
  public function index(Request $request)
    {
        try {
            $page = $request->get('page', 1);
            $per_page = $request->get('per_page', 10);

            $leaves = Leave::latest()->get()
            ->map(function($collection){
                $diffDataRecord = [];
                
                for($i = 0; $i < $collection->diff; $i++){
                    $diffDataRecord[]=$collection;
                }
                return $diffDataRecord;
            })->flatten();

            $leaves = paginator($leaves, $page, $per_page);

            $response = [
                'data' => $leaves,
                'status' => Response::HTTP_OK,
                'message' => "leaves fetched succesfully"
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
            $leave = Leave::query()->findOrFail($id);
            $response = [
                'data' => $leave,
                'status' => Response::HTTP_OK,
                'message' => "leave fetched succesfully"
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


    public function store(LeaveRequest $request)
    {
        try {
            $leave = new Leave;
            $requestedAttributes = $request->all();
            $leave->fill($requestedAttributes)->save();
            $response = [
                'data' => $leave,
                'status' => Response::HTTP_OK,
                'message' => "leave created succesfully"
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


    public function update(LeaveRequest $request, $id)
    {
        try {
            $leave = Leave::findOrFail($id);
            $leave->fill($request->all())->save();
            $response = [
                'data' => $leave,
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
           $leave = Leave::find($id);
           $leave->delete();
           $response = [
               'data' => $leave,
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
