<?php

namespace App\Http\Controllers;

use Excel;
use Carbon\Carbon;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\PartnerCashflow;
use App\Models\PartnerTraction;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Exports\PartnerCashflowExport;
use App\Exports\PartnerTractionExport;
use App\Exports\PartnerVerifiedExport;
use App\Models\PartnerEquipmentMaster;
use App\Exports\PartnerUnverifiedExport;

class PartnerController extends Controller
{
    public function unverified_index(Request $request)
    {
        if($request->ajax()) {
            $unverified = Partner::query();
            if($request->partner_name) $unverified = $unverified->where('full_name', 'like', '%'.$request->partner_name.'%');
            $unverified = $unverified->where('partner_status', 'unverified')
            ->where('deleted_at', null)
            ->where('referal_code', Auth::user()->pb_code)
            ->get();
            return DataTables::of($unverified)
                ->addColumn('partner_names', function($data) {
                    return '<div class="text-primary partner_names" id="'.Crypt::encrypt($data->id).'" style="cursor:pointer">'.$data->full_name.' - '.$data->id.'</div>';
                })
                ->editColumn('bod', function($data) {
                    $bod    = Carbon::parse($data->bod)->isoFormat('D MMMM Y');
                    return !empty($data->born_place) ? $data->born_place." / ".$bod : '-'."/".$bod;
                })
                ->editColumn('bank_account', function($data) {
                    return $data->bank_account_name.' - '.$data->bank_account_number.' - '.$data->bank_name;
                })
                ->editColumn('created_at', function($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM Y hh:mm:ss');
                })
                ->editColumn('skck_number', function($data) {
                    return !empty($data->skck_number) ? $data->skck_number : '-';
                })
                ->editColumn('partner_status', function($data) {
                    return '<i class="text-warning">'.$data->partner_status.'</i>';
                })
                ->rawColumns(['partner_names', 'bank_account', 'bod', 'created_at','skck_number','partner_status'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('content.partner.unverified.index');
    }
    public function unverified_show(string $id)
    {
        $partner            = Partner::find(Crypt::decrypt($id));
        $categories         = explode(',',$partner->category_type);
        $packages           = explode(',',$partner->package_type);
        return view('content.partner.unverified.show', compact([
            'partner','categories','packages',
        ]));
    }
    public function verified_index(Request $request)
    {
        if($request->ajax()) {
            $verified = Partner::query();
            if($request->partner_name != null) $verified = $verified->where('full_name', 'like', '%'.$request->partner_name.'%');
            $verified = $verified->where('partner_status', '!=', 'unverified')
            ->where('deleted_at', null)
            ->where('referal_code', Auth::user()->pb_code)
            ->get();
            return DataTables::of($verified)
                ->addColumn('partner_names', function($data) {
                    return '<div class="text-primary partner_names" id="'.Crypt::encrypt($data->id).'" style="cursor:pointer">'.$data->full_name.' - '.$data->id.'</div>';
                })
                ->editColumn('bod', function($data) {
                    $bod    = Carbon::parse($data->bod)->isoFormat('D MMMM Y');
                    return !empty($data->born_place) ? $data->born_place." / ".$bod : '-'."/".$bod;
                })
                ->editColumn('bank_account', function($data) {
                    return $data->bank_account_name.' - '.$data->bank_account_number.' - '.$data->bank_name;
                })
                ->editColumn('created_at', function($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM Y hh:mm:ss');
                })
                ->editColumn('skck_number', function($data) {
                    return !empty($data->skck_number) ? $data->skck_number : '-';
                })
                ->editColumn('partner_status', function($data) {
                    return '<i class="text-warning">'.$data->partner_status.'</i>';
                })
                ->rawColumns(['partner_names', 'bank_account', 'bod', 'created_at','skck_number','partner_status'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('content.partner.verified.index');
    }
    public function verified_show(string $id)
    {
        $partner            = Partner::find(Crypt::decrypt($id));
        $categories         = explode(',',$partner->category_type);
        $packages           = explode(',',$partner->package_type);
        return view('content.partner.verified.show', compact([
            'partner','categories','packages',
        ]));
    }
    public function partner_export($title)
    {
        switch (strtolower($title)) {
            case 'partner unverified':
                return Excel::download(new PartnerUnverifiedExport(Auth::user()->pb_code), $title.'.xlsx');
                break;
            case 'partner verified':
                return Excel::download(new PartnerVerifiedExport(Auth::user()->pb_code), $title.'.xlsx');
                break;
            case 'partner traction':
                return Excel::download(new PartnerTractionExport(Auth::user()->pb_code), $title.'.xlsx');
                break;
            case 'partner cashflow':
                return Excel::download(new PartnerCashflowExport(Auth::user()->pb_code), $title.'.xlsx');
                break;
            default:
                return false;
        }
    }
    public function partner_equipment(Request $request)
    {
        $eqp        = collect([]);
        PartnerEquipmentMaster::where('package', $request->pack)
        ->get(['equipment'])
        ->each(function($equip) use($eqp) {
            $eqp->push("- ".$equip->equipment."<br/>");
        });
        return $eqp;
    }
    public function verify_partner(string $id)
    {
        DB::beginTransaction();
        try {
            Partner::where('id', Crypt::decrypt($id))->update([
                'partner_status'    => 'active',
                'updated_by'        => Auth::user()->id,
                'updated_at'        => Carbon::now(),
            ]);
            DB::commit();
            return redirect()->route('partner.verified.index')->with('alert-success', 'Data partner has been verified');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function traction_index(Request $request)
    {
        if($request->ajax()) {
            $traction   = PartnerTraction::from('partner_tractions')
                        ->leftjoin('partners','partners.id','partner_tractions.partner_id')
                        ->where('partner_tractions.deleted_at', null)
                        ->where('partners.referal_code', Auth::user()->pb_code);
            if($request->partner_name != NULL) $traction->where('partners.full_name','like','%'.$request->partner_name.'%');
            $traction->select(['partners.full_name','partner_tractions.*'])->get();
            return DataTables::of($traction)
            ->editColumn('partner_name', function($data) {
                return '<div class="text-primary partner_name" id="'.Crypt::encrypt($data->id).'" style="cursor:pointer">'.$data->full_name.'</div>';
            })
            ->rawColumns([
                'partner_name',
            ])
            ->addIndexColumn()
            ->make(true);
        }
        return view('content.partner.traction.index');
    }
    public function cashflow_index(Request $request)
    {
        if($request->ajax()) {
            $cashflow   = PartnerCashflow::from('partner_cashflow')
                        ->leftjoin('partners','partners.id','partner_cashflow.partner_id')
                        ->where('partner_cashflow.deleted_at', null)
                        ->where('partners.partner_status', '!=', 'unverified')
                        ->where('partners.referal_code', Auth::user()->pb_code);
            if($request->partner_name != NULL) $cashflow->where('partners.full_name','like','%'.$request->partner_name.'%');
            $cashflow->select(['partners.full_name','partner_cashflow.*'])->get();
            return DataTables::of($cashflow)
            ->editColumn('partner_name', function($data) {
                return '<div class="text-primary partner_name" id="'.Crypt::encrypt($data->id).'" style="cursor:pointer">'.$data->first_name.' '.$data->last_name.'</div>';
            })
            ->editColumn('total_order', function($data) {
                return number_format($data->total_order);
            })
            ->editColumn('total_revenue', function($data) {
                return number_format($data->total_revenue);
            })
            ->editColumn('total_income', function($data) {
                return number_format($data->total_income);
            })
            ->editColumn('total_withdraw', function($data) {
                return number_format($data->total_withdraw);
            })
            ->rawColumns(['partner_name','total_order','total_income','total_withdraw'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('content.partner.cashflow.index');
    }
}
