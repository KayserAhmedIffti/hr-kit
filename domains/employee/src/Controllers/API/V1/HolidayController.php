<?php

namespace SkylarkSoft\HoneyComb\Employee\Controllers\API\V1;


use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SkylarkSoft\HoneyComb\Employee\Models\Holiday;
use SkylarkSoft\HoneyComb\Employee\Requests\HolidayRequest;


class HolidayController extends Controller
{
    public function index()
    {
        try {
            $holidays = Holiday::latest()->paginate(5);
            $response = [
                'data' => $holidays,
                'status' => Response::HTTP_OK,
                'message' => "holidays fetched succesfully"
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
            $holiday = Holiday::query()->findOrFail($id);
            $response = [
                'data' => $holiday,
                'status' => Response::HTTP_OK,
                'message' => "holiday fetched succesfully"
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


    public function store(HolidayRequest $request)
    {
        try {
            $holiday = new Holiday;
            $requestedAttributes = $request->all();
          
            $holiday->fill($requestedAttributes)->save();
            $response = [
                'data' => $holiday,
                'status' => Response::HTTP_OK,
                'message' => "holiday created succesfully"
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


    public function update(HolidayRequest $request, $id)
    {
        try {
            $holiday = Holiday::findOrFail($id);
            $holiday->fill($request->all())->save();
            $response = [
                'data' => $holiday,
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
           $holiday = Holiday::find($id);
           $holiday->delete();
           $response = [
               'data' => $holiday,
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
