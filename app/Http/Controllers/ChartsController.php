<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\WalletComission;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ChartsController extends Controller
{
    // Apex Charts
    public function apex()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Charts & Maps"], ['name' => "Apex"]
        ];
        return view('/content/charts-maps/chart-apex', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Chartjs Charts
    public function chartjs()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Charts & Maps"], ['name' => "Chartjs"]
        ];
        return view('/content/charts-maps/chart-chartjs', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Google Maps
    public function maps_leaflet()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Maps"], ['name' => "Leaflet Maps"]
        ];
        return view('/content/charts-maps/maps-leaflet', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function usersChart()
    {
        $activeUsers = User::where('status', '1')->count();
        $inactiveUsers = User::where('status', '0')->count();
        $users = User::all()->count();
        $data = new stdClass;
        $data->activeUsers = $activeUsers;
        $data->inactiveUsers = $inactiveUsers;
        $data->users = $users;
        return $data;
    }
    /**
     * Devuelve el los datos necesarios para el grafico de avance de paquete en Dashboard user
     * @return stdClass
     */
    public function packageRentabilityChart($invesment_id = null)
    {
        $user = Auth::user();
        $data = new stdClass;
        $data->percent = 0;
        if($invesment_id != null || $invesment_id != '')
        {
            $utility = Utility::where('investment_id', $invesment_id)->where('user_id', $user->id)->orderBy('id', 'desc')->first();
            $data->percent = $utility->accumulated_percentage;
        }
        else if($user->utilities->where('status', 0)->count() != 0){
            $data->id = $user->utilities->where('status', 0)->last()->investment_id;
            $data->percent =  $user->utilities->where('status', 0)->last()->accumulated_percentage;
        }
        
        return $data;
    }
    /**
     * Obtiene los datos correspondientes para los gráficos de bonos del dashboard user
     * @return stdClass
     */
    public function bonusChartsData($user_id)
    {
        $user = User::with('wallets')->with('utilities')->findOrFail($user_id); 
        $total_bonus_ranges = $user->wallets->where('type', 1)->sum('amount');
        $total_bonus_commissions = $user->wallets->where('type', 0)->sum('amount');
        $total_passive = $user->utilities->where('status', 0)->sum('amount');
        $data = new stdClass;
        $data->ranges = number_format($total_bonus_ranges, 2);
        $data->commissions = number_format($total_bonus_commissions, 2);
        $data->passive = number_format($total_passive, 2); 
        $data->total = number_format($total_bonus_commissions + $total_bonus_ranges + $total_passive, 2); 
        return $data;
    }
    /**
     * Obtiene las ganancias totales generadas por los paquetes para el gráfico de barra
     * @return stdClass
     */
    public function profitPackageChartData($user_id)
    {
         $array_months = [
            '01' => "Enero",
            '02' => "Febrero",
            '03' => "Marzo",
            '04' => "Abril",
            '05' => "Mayo",
            '06' => "Junio",
            '07' => "Julio",
            '08' => "Agosto",
            '09' => "Septiembre",
            '10' => "Octubre",
            '11' => "Noviembre",
            '12' => "Diciembre"
        ];
        $data_per_months = new Collection();
        for($i = 0; $i < 7; $i++)
        {
            $data = new stdClass;
            //En cada iteración resta un mes
            $month = now()->subMonths($i)->format('m');
            $data->month = $array_months[$month];
            $data->amount = Utility::where('user_id', $user_id)->whereMonth('created_at', $month)->sum('amount');
            $data_per_months->push($data);
        }
        return $data_per_months;
    }

    /**
     * Obtiene los datos de ventas de los ultimos 4 meses para el dashboard admin
     * @return stdClass
     */
    public function salesChartData()
    {
        $data = new Collection();
        $firstDay4MonthsAgo = now()->subMonths(3)->startOfMonth();
        $investments = Investment::whereDate('created_at','>=' , $firstDay4MonthsAgo)->orderBy('created_at', 'ASC')->get();
        foreach($investments as $investment)
        {
            $item = new stdClass;
            $item->date = $investment->created_at->format('d-m-Y');
            $item->amount = $investment->invested;
            $data->push($item);
        }
        return $data;
    }
    /**
     * Obtiene los datos de las ganancias del user auntenticado en los ultimos 30 días
     * @return stdClass
     */
    public function wallestAvailable($user_id)
    {   
      
        $data = new Collection();
        $last30days = now()->subDays(30);
        $wallets = WalletComission::where('user_id' , $user_id)
                                ->whereDate('created_at','>=' , $last30days)
                                ->orderBy('created_at', 'ASC')
                                ->get();

        foreach($wallets as $wallet)
        {
            $item = new stdClass;
            $item->date = $wallet->created_at->format('d-m-Y');
            $item->amount = $wallet->amount_available;
            $data->push($item);
        }

        return $data;
    }
    /**
    * Obtiene los datos para el gráfico de barras sobre ventas de paquetes
    * @return stdClass
    */
    public function packagesBarChart()
    {
        $investments = Investment::with('membershipPackage')->get();
        $bronze = 0;
        $silver = 0;
        $gold = 0;
        $diamond = 0;
        $data = new stdClass;
        foreach($investments as $investment)
        {
            switch($investment->membershipPackage->membership_types_id){
                case (1) :
                    $bronze++;
                    break;
                case (2) :
                    $silver++;
                    break;
                case (3) :
                    $gold++;
                    break;
                case (4) :
                    $diamond++;
                    break;
            }
        }
        $array_names = ['bronze', 'silver', 'gold', 'diamond'];
        $array_amounts = [$bronze, $silver, $gold, $diamond];
        $data->packages = $array_names;
        $data->amounts = $array_amounts;
        return $data;
    }
}
