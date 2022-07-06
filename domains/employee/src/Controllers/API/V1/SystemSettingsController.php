<?php

namespace SkylarkSoft\HoneyComb\Employee\Controllers\API\V1;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SkylarkSoft\HoneyComb\Employee\Models\SystemSettings;
use SkylarkSoft\HoneyComb\Employee\Requests\SystemSettingsRequest ;

class SystemSettingsController extends Controller
{
    public function index()
    {
        try {
            $systemsettings = SystemSettings::paginate(5);
            $response = [
                'data' => $systemsettings,
                'status' => Response::HTTP_OK,
                'message' => "systemsettings fetched succesfully"
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
            $systemsettings = SystemSettings::query()->findOrFail($id);

            $response = [
                'data' => $systemsettings,
                'status' => Response::HTTP_OK,
                'message' => "systemsettings fetched succesfully"
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

    public function store(SystemSettingsRequest $request)
    {
        try {
            $systemsettings = new SystemSettings;
            $requestedAttributes = $request->all();
            $systemsettings->fill($requestedAttributes)->save();
            $response = [
                'data' => $systemsettings,
                'status' => Response::HTTP_OK,
                'message' => "systemsettings created succesfully"
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

    public function update(SystemSettingsRequest $request, $id)
    {
        try {
            $systemsettings = SystemSettings::findOrFail($id);
            $systemsettings->fill($request->all())->save();
            $response = [
                'data' => $systemsettings,
                'status' => Response::HTTP_OK,
                'message' => "systemsettings succesfully Updated"
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
            $systemsettings = SystemSettings::find($id);
            $systemsettings->delete();
            $response = [
                'data' => $systemsettings,
                'status' => Response::HTTP_OK,
                'message' => "systemsettings succesfully Deleted"
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
