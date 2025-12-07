@include('inc.library')
@extends('layouts.app')
@section('content')
<div>
    <div class="d-flex justify-content-end py-1">
        <div>
            <form action="{{ route('partner.export', 'Partner Verified') }}" method="get" style="height: 1rem;">
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
    <table id="verified-partner-table" class="table table-hover mx-0 text-nowrap w-100">
        <thead>
            <tr>
                <th>No</th>
                <th>Partner Name - id</th>
                <th>Referal Code</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Place / BOD</th>
                <th>Religion</th>
                <th>Graduate</th>
                <th>KTP Address</th>
                <th>Account Data</th>
                <th>Partner Status</th>
                <th>KTP Number</th>
                <th>KK Number</th>
                <th>SKCK Number</th>
                <th>Register At</th>
            </tr>
        </thead>
    </table>
</div>
@include('inc.alert')
<script>
    $(document).ready(function() {
        partnerTable();
        $('#partner_name_filter').focus();
    });
    const partnerTable = (partnerName="") => {
        $('#verified-partner-table').DataTable({
            scrollY: 300,
            scrollX: true,
            processing: true,
            serverSide: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            bFilter: false,
            bLengthChange: false,
            ajax: {
                url: "{{ route('partner.verified.index') }}",
                data: {
                    partner_name: partnerName
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'partner_names', name: 'partner_names' },
                { data: 'referal_code', name: 'referal_code' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'email', name: 'email' },
                { data: 'bod', name: 'bod' },
                { data: 'religion', name: 'religion' },
                { data: 'graduate', name: 'graduate' },
                { data: 'ktp_address', name: 'ktp_address' },
                { data: 'bank_account', name: 'bank_account' },
                { data: 'partner_status', name: 'partner_status' },
                { data: 'ktp_number', name: 'ktp_number' },
                { data: 'kk_number', name: 'kk_number' },
                { data: 'skck_number', name: 'skck_number' },
                { data: 'created_at', name: 'created_at' },
            ],
        });
    }
    $(document).on('keyup', '#partner_name_filter', function() {
        var partnerName = $(this).val();
        $('#verified-partner-table').DataTable().destroy();
        partnerTable(partnerName);
    });
    $(document).on('click', '.partner_names', function() {
        const base_url = "{{ url('/partner') }}";
        const id = $(this).attr('id');
        window.location.href = `${base_url}/verified/${id}`;
    });
</script>
@endsection
