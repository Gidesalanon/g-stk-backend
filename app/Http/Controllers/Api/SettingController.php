<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Setting;
use \App\Http\Requests\Api\Setting\UpdateSettingRequest;
use \App\Http\Requests\Api\Setting\StoreSettingRequest;
use App\Http\Resources\Setting as SettingResource;
use App\Services\SettingService;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;


class SettingController extends Controller
{

    /**
     * @var SettingService
     */
    private $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->authorize('view_any', Setting::class);
        $load = ['fichier'];
        $setting = Setting::with($load)
                ->latest()
                ->paginate(1);
        return $setting;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingRequest $request)
    {
       // $this->authorize('create', Setting::class);
       if (empty($request->id)){
        $setting = $this->settingService->create($request->validated());
        $setting->load(['fichier']);
        return response()->json([
            'status' => 'success',
            'status_code' => Response::HTTP_CREATED,
            'data' => [
                'setting' => new SettingResource($setting)
            ],
            'message' => 'Creation successful'
        ]); }
        else{
            $setting = $this->settingService->fupdate($request->validated());
            return $setting;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //  $this->authorize('view', Setting::class);
         $load =['fichier'];
         $setting = Setting::findOrFail($id)->load($load);
         return  $setting;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
      //  $this->authorize('update', Setting::class);
        $setting = $this->settingService->update($setting, $request->validated());

        return $setting;
    }

    /**
     * Force Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function force_update(UpdateSettingRequest $request)
    {
        $setting = $this->settingService->fupdate($request->validated());
        return $setting;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
       // $this->authorize('delete', Setting::class);

        if ($this->settingService->delete($setting)) {
            return response()->json([
                'status' => 'success',
                'status_code' => Response::HTTP_NO_CONTENT,
                'message' => 'Deleted successful'
            ]);
        } else {
            return response()->json([
                'message' => 'Failed deleting resource'
            ], 400);
        }
    }
}
