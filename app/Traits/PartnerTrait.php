<?php
namespace App\Traits;

use App\Models\Partner;
use App\Models\PartnerCashflow;
use App\Models\PartnerTraction;
use App\Models\PartnerNotif;
use App\Models\PartnerWorkStatus;
use Illuminate\Support\Facades\Storage;

trait PartnerTrait
{
    static function _getUnverifiedPartnerList($partner_name)
    {
        $partner_list      = Partner::where('partner_status','unverified');
        if($partner_name != null) $partner_list->where('full_name', 'like', '%'.$partner_name.'%');
        $partner_list      = $partner_list->where('deleted_by', null);
        $partner_list      = $partner_list->select([
            '*'
        ]);
        return $partner_list;
    }
    static function _getVerifiedPartnerList($partner_name)
    {
        $partner_list      = Partner::where('partner_status','active');
        if($partner_name != null) $partner_list->where('full_name', 'like', '%'.$partner_name.'%');
        $partner_list      = $partner_list->where('deleted_by', null);
        $partner_list      = $partner_list->select([
            '*'
        ]);
        return $partner_list;
    }
    static function _getPartnerWorkStatus($area_name){
        $ws         = PartnerWorkStatus::from('partner_work_status as pw')
                    ->leftjoin('partners as p','p.id','pw.partner_id')
                    ->where('pw.inactived_at',null)
                    ->orderBy('actived_at','DESC');
        if($area_name != null) $ws->where('work_areas','like','%'.$area_name.'%');
        $ws         = $ws->select([
                        'pw.*','p.first_name','p.last_name','p.full_name'
                    ]);
        return $ws;
    }
    static function _getNotifList($partner_name=null)
    {
        $notif          = PartnerNotif::from('partner_notif as nt')
                        ->leftjoin('partners as p', 'p.id','nt.partner_id')
                        ->leftJoin('users', 'users.id', 'nt.created_by')
                        ->where('nt.deleted_at',null);
        if($partner_name != null) $notif->where('p.first_name', 'like', '%'.$partner_name.'%');
        $notif          = $notif->select([
            'nt.*','p.first_name','p.last_name',
            'users.full_name as created_by',
        ]);
        return $notif;
    }
    static function _getPartnerCashflow($partner_name){
        $cf             = PartnerCashflow::from('partner_cashflow as pc')
                        ->leftjoin('partners as p','p.id','pc.partner_id');
        if($partner_name != NULL) $cf->where('p.full_name','like','%'.$partner_name.'%');
        return $cf->select([
            'p.full_name','pc.*'
        ]);
    }
    public function  _getPartnerTraction($partner_name){
        $traction       = PartnerTraction::from('partner_traction as pt')
                        ->leftjoin('partners as p','p.id','pt.partner_id');
        if($partner_name != NULL) $traction->where('p.full_name','like','%'.$partner_name.'%');
        return $traction->select([
            'p.full_name','pt.*'
        ]);
    }
    static function _getDocPath($doc_req)
    {
        $imageName      = time().rand(10,100000).'.'.$doc_req->getClientOriginalExtension();
        $path           = $imageName;
        $t              = Storage::disk('s3')->put($path, file_get_contents($doc_req), 'public');
        $file_uri       = Storage::disk('s3')->url($path);

        return $file_uri;
    }
}
