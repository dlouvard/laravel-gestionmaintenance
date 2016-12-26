<?php
/**
 * Created by PhpStorm.
 * User: dlouvard_imac
 * Date: 26/12/2016
 * Time: 18:49
 */

namespace Dlouvard\LaravelGestionmaintenance;


use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use \Dlouvard\LaravelGestionmaintenance\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GestionMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::idDesc()->get();
        return view('vendor.maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $maintenance = new Maintenance();
        $maintenance->begin = Carbon::now()->format('d/m/Y');
        $maintenance->begin_clock = '12:00';
        $maintenance->end = Carbon::now()->addDay()->format('d/m/Y');
        $maintenance->end_clock = '12:00';
        $users = User::get();
        return view('vendor.maintenances.create', compact('maintenance', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $req = $request->all();
        $req['status'] = isset($req['status']) ? 1 : 0;
        $req['begin'] = Carbon::createFromFormat('d/m/Y H:i', $req['begin'] . ' ' . $req['begin_clock'], 'Europe/Paris')->setTimezone('UTC');
        $req['end'] = Carbon::createFromFormat('d/m/Y H:i', $req['end'] . ' ' . $req['end_clock'], 'Europe/Paris')->setTimezone('UTC');

        $req['user_id'] = auth()->user()->id;
        if ($req['status'])
            Maintenance::where('status', '1')->update(['status' => 0]);

        Maintenance::create($req);
        Cache::forget('maintenance');
        Cache::forget('alert_Maintenance');
        return redirect(action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@index'))->with('success', "Maintenance créée avec succès");
    }
    public function show($id)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->begin_clock = Carbon::parse($maintenance->begin)->setTimezone('Europe/Paris')->format('H:i');
        $maintenance->begin = Carbon::parse($maintenance->begin)->format('d/m/Y');
        $maintenance->end_clock = Carbon::parse($maintenance->end)->setTimezone('Europe/Paris')->format('H:i');
        $maintenance->end = Carbon::parse($maintenance->end)->format('d/m/Y');


        return view('vendor.maintenances.edit', compact('maintenance', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $req = $request->all();

        $maintenance = Maintenance::find($id);
        $req['status'] = isset($req['status']) ? 1 : 0;
        if ($req['status'] == 1)
            Maintenance::where('status', '1')
                ->where('id', '!=', $id)
                ->update(['status' => 0]);

        $req['begin'] = Carbon::createFromFormat('d/m/Y H:i', $req['begin'] . ' ' . $req['begin_clock'], 'Europe/Paris')->setTimezone('UTC');
        $req['end'] = Carbon::createFromFormat('d/m/Y H:i', $req['end'] . ' ' . $req['end_clock'], 'Europe/Paris')->setTimezone('UTC');

        $maintenance->update($req);
        Cache::forget('maintenance');
        Cache::forget('alert_Maintenance');

        return redirect(action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@index'))->with('success', "Maintenance mis à jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->delete();
        Cache::forget('maintenance');
        Cache::forget('alert_Maintenance');
        return redirect(action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@index'))->with('success', "Maintenance supprimée");
    }

}