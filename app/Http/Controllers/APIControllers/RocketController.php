<?php

namespace App\Http\Controllers\APIControllers;

use App\Rocket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RocketController extends Controller
{
    
    
    function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields = ['name', 'active', 'boosters', 'cost_per_launch', 'favorite'];
        
        $filters = $request->only($fields);
        
        $rockets = json_decode(@file_get_contents('https://api.spacexdata.com/v2/rockets', true), true); 
        
        if(isset($filters['active']) && $filters['active'] != null) {
            $filters['active'] = filter_var($filters['active'], FILTER_VALIDATE_BOOLEAN);
            
        }
        
        if(isset($filters['favorite']) && $filters['favorite'] != 1) {
            $filters['favorite'] = null;
        }else{
            $filters = array();
            $filters['favorite'] = 1;
        }
        
        //return $filters;
        
        if ($rockets) {
            $result = array();
            foreach ($rockets as $rocket) {
                $status = 1;
                $rocket['favorite'] = Rocket::isFavorite($rocket['id']);
                foreach ($filters as $key => $value) {
                    if($value != null || $value == false) {
                        if($rocket[$key] != $value) {
                                $status = 0;
                            }
                    }
                }
                if ($status == 1) {
                    $result[] = $rocket;
                }
            }
            
            return response($result);
        }
    }
    
    public function favorites(Request $request) {
        $rocket_id = $request['rocket_id'];
        
        if($rocket_id != null) {
            if(Rocket::isFavorite($rocket_id) == 1) {
                Rocket::removeFavorite($rocket_id);
            }else{
                Rocket::addFavorite($rocket_id);
            }
            $result['message'] = 'success';
        }else{
            $result['message'] = 'Something went wrong';
        }
        
        return response($result);
    }
}
