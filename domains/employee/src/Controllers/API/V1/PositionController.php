<?php

namespace SkylarkSoft\HoneyComb\Employee\Controllers\API\V1;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SkylarkSoft\HoneyComb\Employee\Models\Position;
use SkylarkSoft\HoneyComb\Employee\Requests\PositionRequest;

class PositionController extends Controller
{

    public function index()
    {
        try {
            $positions = Position::paginate(5);
            $response = [
                'data' => $positions,
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
            $position = Position::query()->findOrFail($id);

            $response = [
                'data' => $position,
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

    public function store(PositionRequest $request)
    {
        try {
            $position = new Position;
            $requestedAttributes = $request->all();
            $position->fill($requestedAttributes)->save();
            $response = [
                'data' => $position,
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

    public function update(PositionRequest $request, $id)
    {
        try {
            $position = Position::findOrFail($id);
            $position->fill($request->all())->save();
            $response = [
                'data' => $position,
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
            $position = Position::find($id);
            $position->delete();
            $response = [
                'data' => $position,
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

