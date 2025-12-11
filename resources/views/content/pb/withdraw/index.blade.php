@extends('layouts.app')
@section('content')
    <div>
        <div class="d-flex justify-content-between mt-2">
            <div class="mb-3">&nbsp;</div>
            <div class="d-flex justify-content-end">
                <div>
                    <form action="{{ route('partner.export', 'PB Withdraw') }}" method="GET" style="height: 1rem">
                        <button type="submit" class="btn btn-sm btn-link"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download" style="background:transparent; text-decoration:none;"><i class="fas fa-cloud-download" style="font-size: 1.5rem"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mb-2 pb-2">
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
                    <th>PB Name</th>
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
            $('#partner_name_filter').focus();

            getWithdraw();
            $('#partner_name_filter').on('input', function() {
                getWithdraw($(this).val());
            });
        });
        const getWithdraw = (partner_name='') => {
            $('#table_partner').DataTable({
                scrollY: 400,
                scrollX: true,
                processing: true,
                serverSide: true,
                lengthMenu: [[50, 100, -1], [50, 100, "All"]],
                bFilter: false,
                bLengthChange: false,
                ajax: {
                    url: "{{ route('pb.withdraw.index') }}",
                    type: 'GET',
                    data: {
                        partner_name: partner_name,
                    },
                },
                columns: [
                    { data: 'pb_id', name: 'pb_id' },
                    { data: 'partner_names', name: 'partner_names' },
                    { data: 'total_order', name: 'total_order' },
                    { data: 'total_revenue', name: 'total_revenue' },
                    { data: 'total_income', name: 'total_income' },
                    { data: 'total_withdraw', name: 'total_withdraw' },
                ],
                "columnDefs": [
                    { "className": "dt-center", "targets": "_all" },
                ],
            });
        }
    </script>
@endsection
