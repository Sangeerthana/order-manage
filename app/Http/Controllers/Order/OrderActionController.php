<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Orders;
use Carbon\Carbon;

class OrderActionController extends Controller {
  public function getAllStatus() {
    $all_status =  Orders::distinct()->get(['status']);
    return $all_status;
  }

  public function getAllChannel() {
    $channels_array = [];
    $all_channel = Orders::distinct()->orderBy('channel', 'ASC')->get(['channel']);
    foreach($all_channel as $channel)
    {
      $exploded = explode("-",$channel->channel);
      if (str_contains($channel->channel, '-')) {
        if (!in_array("MAINCHANNEL_".$exploded[0], $channels_array)) {
          array_push($channels_array, "MAINCHANNEL_".$exploded[0]);
        }
        array_push($channels_array,$exploded[1]);
      }
      else {
        array_push($channels_array,$exploded[0]);
      }
    }
    return $channels_array;
  }

  public function getAllFlags() {
    $all_flags = Orders::distinct()->orderBy('flags', 'ASC')->get(['flags']);
    return $all_flags;
  }

  public function getGraphData(Request $request) {
    $monthStart = Carbon::parse(Carbon::now()->firstOfMonth()->toDateString());
    $monthEnd= Carbon::parse(Carbon::now()->lastOfMonth()->toDateString());
    $lmonthStart = Carbon::parse(Carbon::now()->addMonth(-1)->firstOfMonth()->toDateString());
    $lmonthEnd= Carbon::parse(Carbon::now()->addMonth(-1)->lastOfMonth()->toDateString());
    $lyearStart = Carbon::parse(Carbon::now()->addYear(-1)->firstOfMonth()->toDateString());
    $lyearEnd= Carbon::parse(Carbon::now()->addYear(-1)->lastOfMonth()->toDateString());
    $end_date = Carbon::now()->toDateString();
    $label_array =[];$val_array_this =[];$val_array_lmonth =[];$val_array_lyear =[];$sal_array_this =[];$sal_array_lmonth =[];$sal_array_lyear =[];
    if(empty($request->dataobj['sel_date']) or $request->dataobj['sel_date'] == "month") {
      $start_date = Carbon::now()->firstOfMonth()->toDateString();
      $period = $monthStart->range($monthEnd, 1, 'day');

      $query_this = Orders::select(DB::raw('DAY(date) day'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$start_date)->where('date', '<=',$end_date);
        if(!empty($request->dataobj['sel_status'])) { $query_this = $query_this->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_this = $query_this->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_this = $query_this->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_this = $query_this->groupBy('date')->get();

      $query_lmonth = Orders::select(DB::raw('DAY(date) day'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$lmonthStart)->where('date', '<=',$lmonthEnd);
        if(!empty($request->dataobj['sel_status'])) { $query_lmonth = $query_lmonth->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_lmonth = $query_lmonth->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_lmonth = $query_lmonth->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_lmonth = $query_lmonth->groupBy('date')->get();

      $query_lyear = Orders::select(DB::raw('DAY(date) day'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$lyearStart)->where('date', '<=',$lyearEnd);
        if(!empty($request->dataobj['sel_status'])) { $query_lyear = $query_lyear->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_lyear = $query_lyear->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_lyear = $query_lyear->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_lyear = $query_lyear->groupBy('date')->get();

      foreach ($query_this as $row_this) {
        $value_array_this[$row_this->day] = $row_this->qty;
        $sales_array_this[$row_this->day] = $row_this->sales;
      }
      foreach ($query_lmonth as $row_lmonth) {
        $value_array_lmonth[$row_lmonth->day] = $row_lmonth->qty;
        $sales_array_lmonth[$row_lmonth->day] = $row_lmonth->sales;
      }
      foreach ($query_lyear as $row_lyear) {
        $value_array_lyear[$row_lyear->day] = $row_lyear->qty;
        $sales_array_lyear[$row_lyear->day] = $row_lyear->sales;
      }

      foreach ($period as $dt) {
        $days = $dt->day;
        if(!empty($value_array_this[$days])) { array_push($val_array_this,$value_array_this[$days]); }
        else { array_push($val_array_this,0); }

        if(!empty($value_array_lmonth[$days])) { array_push($val_array_lmonth,$value_array_lmonth[$days]); }
        else { array_push($val_array_lmonth,0); }

        if(!empty($value_array_lyear[$days])) { array_push($val_array_lyear,$value_array_lyear[$days]); }
        else { array_push($val_array_lyear,0); }

        if(!empty($sales_array_this[$days])) { array_push($sal_array_this,$sales_array_this[$days]); }
        else { array_push($sal_array_this,0); }

        if(!empty($sales_array_lmonth[$days])) { array_push($sal_array_lmonth,$sales_array_lmonth[$days]); }
        else { array_push($sal_array_lmonth,0); }

        if(!empty($sales_array_lyear[$days])) { array_push($sal_array_lyear,$sales_array_lyear[$days]); }
        else { array_push($sal_array_lyear,0); }

        array_push($label_array,$days);
      }
    }
    else if($request->dataobj['sel_date'] == "week") {
      $start_date = Carbon::now()->startOfWeek(Carbon::SUNDAY)->toDateString();
      $weekStart = Carbon::parse(Carbon::now()->startOfWeek(Carbon::SUNDAY)->toDateString());
      $weekEnd= Carbon::parse(Carbon::now()->endOfWeek(Carbon::SATURDAY)->toDateString());

      $period = $weekStart->range($weekEnd, 1, 'day');

      $query_this = Orders::select(DB::raw('DAY(date) day'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$start_date)->where('date', '<=',$end_date);
        if(!empty($request->dataobj['sel_status'])) { $query_this = $query_this->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_this = $query_this->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_this = $query_this->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_this = $query_this->groupBy('date')->get();

      $query_lmonth = Orders::select(DB::raw('DAY(date) day'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$lmonthStart)->where('date', '<=',$lmonthEnd);
        if(!empty($request->dataobj['sel_status'])) { $query_lmonth = $query_lmonth->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_lmonth = $query_lmonth->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_lmonth = $query_lmonth->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_lmonth = $query_lmonth->groupBy('date')->get();

      $query_lyear = Orders::select(DB::raw('DAY(date) day'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$lyearStart)->where('date', '<=',$lyearEnd);
        if(!empty($request->dataobj['sel_status'])) { $query_lyear = $query_lyear->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_lyear = $query_lyear->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_lyear = $query_lyear->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_lyear = $query_lyear->groupBy('date')->get();

      foreach ($query_this as $row_this) {
        $value_array_this[$row_this->day] = $row_this->qty;
        $sales_array_this[$row_this->day] = $row_this->sales;
      }
      foreach ($query_lmonth as $row_lmonth) {
        $value_array_lmonth[$row_lmonth->day] = $row_lmonth->qty;
        $sales_array_lmonth[$row_lmonth->day] = $row_lmonth->sales;
      }
      foreach ($query_lyear as $row_lyear) {
        $value_array_lyear[$row_lyear->day] = $row_lyear->qty;
        $sales_array_lyear[$row_lyear->day] = $row_lyear->sales;
      }

      foreach ($period as $dt) {
        $days = $dt->day;
        $days_name = $dt->format('D');

        if(!empty($value_array_this[$days])) { array_push($val_array_this,$value_array_this[$days]); }
        else { array_push($val_array_this,0); }

        if(!empty($value_array_lmonth[$days])) { array_push($val_array_lmonth,$value_array_lmonth[$days]); }
        else { array_push($val_array_lmonth,0); }

        if(!empty($value_array_lyear[$days])) { array_push($val_array_lyear,$value_array_lyear[$days]); }
        else { array_push($val_array_lyear,0); }

        if(!empty($sales_array_this[$days])) { array_push($sal_array_this,$sales_array_this[$days]); }
        else { array_push($sal_array_this,0); }

        if(!empty($sales_array_lmonth[$days])) { array_push($sal_array_lmonth,$sales_array_lmonth[$days]); }
        else { array_push($sal_array_lmonth,0); }

        if(!empty($sales_array_lyear[$days])) { array_push($sal_array_lyear,$sales_array_lyear[$days]); }
        else { array_push($sal_array_lyear,0); }

        array_push($label_array,$days_name);
      }
    }
    else if($request->dataobj['sel_date'] == "year") {
      $start_date = Carbon::now()->firstOfYear()->toDateString();

      $query_this = Orders::select(DB::raw('MONTH(date) month'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$start_date)->where('date', '<=',$end_date);
        if(!empty($request->dataobj['sel_status'])) { $query_this = $query_this->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_this = $query_this->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_this = $query_this->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_this = $query_this->groupby('month')->get();

      $query_lmonth = Orders::select(DB::raw('MONTH(date) month'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$lmonthStart)->where('date', '<=',$lmonthEnd);
        if(!empty($request->dataobj['sel_status'])) { $query_lmonth = $query_lmonth->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_lmonth = $query_lmonth->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_lmonth = $query_lmonth->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_lmonth = $query_lmonth->groupby('month')->get();

      $query_lyear = Orders::select(DB::raw('MONTH(date) month'),DB::raw('SUM(quantity) as qty'),DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$lyearStart)->where('date', '<=',$lyearEnd);
        if(!empty($request->dataobj['sel_status'])) { $query_lyear = $query_lyear->where('status', '=', $request->dataobj['sel_status']); }
        if(!empty($request->dataobj['sel_channel'])) { $query_lyear = $query_lyear->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
        if(!empty($request->dataobj['sel_flag'])) { $query_lyear = $query_lyear->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
        $query_lyear = $query_lyear->groupby('month')->get();

      foreach ($query_this as $row_this) {
        $value_array_this[$row_this->month] = $row_this->qty;
        $sales_array_this[$row_this->month] = $row_this->sales;
      }
      foreach ($query_lmonth as $row_lmonth) {
        $value_array_lmonth[$row_lmonth->month] = $row_lmonth->qty;
        $sales_array_lmonth[$row_lmonth->month] = $row_lmonth->sales;
      }
      foreach ($query_lyear as $row_lyear) {
        $value_array_lyear[$row_lyear->month] = $row_lyear->qty;
        $sales_array_lyear[$row_lyear->month] = $row_lyear->sales;
      }

      for ($month=1; $month<=12; $month++) {
        $month_name = Carbon::parse("2022-".$month."-01")->format('M');
        if(!empty($value_array_this[$month])) { array_push($val_array_this,$value_array_this[$month]); }
        else { array_push($val_array_this,0); }

        if(!empty($value_array_lmonth[$month])) { array_push($val_array_lmonth,$value_array_lmonth[$month]); }
        else { array_push($val_array_lmonth,0); }

        if(!empty($value_array_lyear[$month])) { array_push($val_array_lyear,$value_array_lyear[$month]); }
        else { array_push($val_array_lyear,0); }

        if(!empty($sales_array_this[$month])) { array_push($sal_array_this,$sales_array_this[$month]); }
        else { array_push($sal_array_this,0); }

        if(!empty($sales_array_lmonth[$month])) { array_push($sal_array_lmonth,$sales_array_lmonth[$month]); }
        else { array_push($sal_array_lmonth,0); }

        if(!empty($sales_array_lyear[$month])) { array_push($sal_array_lyear,$sales_array_lyear[$month]); }
        else { array_push($sal_array_lyear,0); }

        array_push($label_array,$month_name);
      }
    }
    $result = ["xaxis" => $label_array, "yaxis_this" => $val_array_this, "yaxis_lmonth" => $val_array_lmonth, "yaxis_lyear" => $val_array_lyear, "yaxis_thiss" => $sal_array_this, "yaxis_lmonths" => $sal_array_lmonth, "yaxis_lyears" => $sal_array_lyear];
    return $result;
  }

  public function getOrdersSummary(Request $request) {
    $end_date = Carbon::now()->toDateString();
    if(!empty($request->dataobj['sel_date'])) {
        if($request->dataobj['sel_date'] == "week"){ $start_date = Carbon::now()->startOfWeek(Carbon::SUNDAY)->toDateString(); }
        else if($request->dataobj['sel_date'] == "month"){ $start_date = Carbon::now()->firstOfMonth()->toDateString(); }
        else if($request->dataobj['sel_date'] == "year"){ $start_date = Carbon::now()->firstOfYear()->toDateString(); }
    }
    else {
        $start_date = Carbon::now()->firstOfMonth()->toDateString();
    }

    $query = Orders::select(DB::raw('count(id) as count'), DB::raw('SUM(quantity) as qty'), DB::raw('SUM(ordertotal) as sales'))->where('date', '>=',$start_date)->where('date', '<=',$end_date);
    if(!empty($request->dataobj['sel_status'])) { $query = $query->where('status', '=', $request->dataobj['sel_status']); }
    if(!empty($request->dataobj['sel_channel'])) { $query = $query->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
    if(!empty($request->dataobj['sel_flag'])) { $query = $query->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
    $tot_orders = $query->first();


    $query_day_count = Orders::distinct('date')->where('date', '>=',$start_date)->where('date', '<=',$end_date);
    if(!empty($request->dataobj['sel_status'])) { $query_day_count = $query_day_count->where('status', '=', $request->dataobj['sel_status']); }
    if(!empty($request->dataobj['sel_channel'])) { $query_day_count = $query_day_count->where('channel', 'like', '%' . $request->dataobj['sel_channel'] . '%'); }
    if(!empty($request->dataobj['sel_flag'])) { $query_day_count = $query_day_count->where('flags', 'like', $request->dataobj['sel_flag'] . '%'); }
    $day_count = $query_day_count->count();

    if($tot_orders->count > 0){ $result = ["count" => $tot_orders->count, "qty" => $tot_orders->qty, "sales" => $tot_orders->sales, "tot_days" => $day_count] ; }
    else{ $result = ["count" =>0, "qty" => 0, "sales" => 0.00, "tot_days" => 0]; }

    return $result;
  }
}
