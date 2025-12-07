@include('inc.library')
@extends('layouts.app')
@section('content')
<div>
    <div class="d-flex justify-content-end py-1">
        <div>
            <form action="{{ route('partner.export', 'Partner Cashflow') }}" method="get" style="height: 1rem;">
                <button type="submit" class="btn btn-sm btn-link"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download" style="background:transparent; text-decoration:none;"><i class="fas fa-cloud-download" style="font-size: 1.5rem"></i></button>
            </form>
        </div>
    </div>
    <div class="mb-2 border-bottom pb-2 d-flexs justify-content-between">
        <div class="d-flex p-2" style="background-color: rgba(226, 221, 221, 0.5)">
            <div class="d-flex flex-column justify-content-around me-2 col-2">
                <label for="partner_name_filter">Partner Name</label>
                <input type="text" class="form-control form-control-sm" name="partner_name_filter" id="partner_name_filter" autocomplete="off"/>
            </div>
        </div>
    </div>
    <table id="table_partner" class="table table-hover table-stripped mx-0">
        <thead>
            <tr id="thead-tr" class="text-nowrap">
                <th>Id</th>
                <th>Partner Name</th>
                <th>Total Order</th>
                <th>Total Revenue</th>
                <th>Total Income</th>
                <th>Total Withdraw</th>
            </tr>
        </thead>
    </table>
</div>
@include('inc.alert')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        data_partner();
    });
    $(document).on('keyup', '#partner_name_filter', function() {
        $('#table_partner').DataTable().destroy();
        data_partner($(this).val());
    });
    let data_partner = (partner_name='') => {
        $('#table_partner').DataTable({
            scrollY: 400,
            scrollX: true,
            processing: true,
            serverSide: true,
            lengthMenu: [[50, 100, -1], [50, 100, "All"]],
            bFilter: false,
            bLengthChange: false,
            ajax: {
                url: "{{ route('partner.cashflow.index') }}",
                type: 'GET',
                data: {
                    partner_name: partner_name,
                },
            },
            columns: [
                { data:'id', name:'id', },
                { data:'full_name', name:'full_name', },
                { data:'total_order', name:'total_order', },
                { data:'total_revenue', name:'total_revenue', },
                { data:'total_income', name:'total_income', },
                { data:'total_withdraw', name:'total_withdraw',  }
            ],
        });
    }
</script>
@endsection
