@include('inc.library')
@extends('layouts.app')
@section('content')
    <div>
        <h6 class="modal-title mt-2 mx-4">Partner Verification Data</h6><hr>
        <div class="card-body mt" style="margin-top:-4vh">
            <div class="fieldset">
                <fieldset>
                    <div class="col-2 verified-img">
                        <img id="avatar_img" src="{{$partner->avatar_path}}" class="img-circle rounded-circle" style="height:120px;width:120px">
                    </div>
                </fieldset>
            </div>
            <fieldset>
                <div class="row">
                    <div class="col-2">
                        <label class="text-decoration-underline">First Name</label>
                        <p>{{$partner->first_name}}</p>
                    </div>
                    <div class="col-2">
                        <label class="text-decoration-underline">Last Name</label>
                        <p>{{$partner->last_name}}</p>
                    </div>
                    <div class="col-2">
                        <label class="text-decoration-underline">Phone Number</label>
                        <p>{{$partner->phone_number}}</p>
                    </div>
                    <div class="col-2">
                        <label class="text-decoration-underline">Email</label>
                        <p>{{$partner->email}}</p>
                    </div>
                </div>
            </fieldset>
            <div class="fieldset">
                <fieldset>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label class="text-decoration-underline">Born Place</label>
                            <p>{{$partner->born_place}}</p>
                        </div>
                        <div class="col-2">
                            <label class="text-decoration-underline">Birth Of Date</label>
                            <p>{{$partner->bod}}</p>
                        </div>
                        <div class="col-2">
                            <label class="text-decoration-underline">Religion</label>
                            <p>{{$partner->religion}}</p>
                        </div>
                        <div class="col-2">
                            <label  class="text-decoration-underline">Graduate</label>
                            <p>{{$partner->graduate}}</p>
                        </div>
                        <div class="col-8 mt-3">
                            <label  class="text-decoration-underline">KTP Address</label>
                            <p>{{$partner->ktp_address}}</p>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="fieldset">
                <fieldset>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label  class="text-decoration-underline">Bank Account Number</label>
                            <p>{{$partner->bank_account_number}}</p>
                        </div>
                        <div class="col-2">
                            <label  class="text-decoration-underline">Bank Account Name</label>
                            <p>{{$partner->bank_account_name}}</p>
                        </div>
                        <div class="col-2">
                            <label  class="text-decoration-underline">Bank Name</label>
                            <p>{{$partner->bank_name}}</p>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="fieldset">
                <fieldset>
                    <div class="row">
                        <div class="col-2 verified-img">
                            <label  class="text-decoration-underline">KTP</label>
                            <p>{{ $partner->ktp_number }}</p>
                            <img src="{{ $partner->ktp_path_doc ? asset($partner->ktp_path_doc) : 'https://placehold.co/100' }}" class="img img-circle" id="ktp_doc_show" style="height:12vh;width:12vw">
                        </div>
                        <div class="col-2 verified-img">
                            <label  class="text-decoration-underline">KK</label>
                            <p>{{ $partner->kk_number }}</p>
                            <img src="{{ $partner->kk_path_doc ? asset($partner->kk_path_doc) : 'https://placehold.co/100' }}" class="img img-circle" id="kk_doc_show" style="height:12vh;width:12vw">
                        </div>
                        <div class="col-2 verified-img">
                            <label  class="text-decoration-underline">SKCK</label>
                            <p>{{ $partner->skck_number }}</p>
                            <img src="{{ $partner->skck_path_doc ? asset($partner->skck_path_doc) : 'https://placehold.co/100' }}" class="img img-circle" id="skck_doc_show" style="height:12vh;width:12vw">
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="fieldset">
                <fieldset>
                    <div class="row">
                        <div class="col-4">
                            <label  class="text-decoration-underline">Register Areas</label>
                            <p>{{$partner->register_areas}}</p>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="fieldset">
                <fieldset>
                    <div class="row">
                        <div class="col-4">
                            <label  class="text-decoration-underline">Amenities</label>
                            <p>{{$partner->amenities}}</p>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="fieldset">
                <fieldset>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label  class="text-decoration-underline fw-bold">Category</label>
                            <div>
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            {{ $category }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-3">
                            <label  class="text-decoration-underline fw-bold">Package</label>
                            <div>
                                <ul>
                                    @foreach($packages as $package)
                                        <li>
                                            <a style="cursor:pointer">{{$package}} <button type="button" class="btn btn-sm" id="eq-{{$package}}" data-eq="{{$package}}" onclick="eqi_show(this)"><i class="fa-solid fa-circle-info text-secondary"></i></button></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-3 d-none" id="eqlist">
                            <div class="text-decoration-underline fw-bold">
                                <span id="equipment_list" class="p-0"></span>
                            </div>
                            <div id="eq-list">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div id="btn_wrapper" class="card sticky-bottom mt-17vh" style="right:0;background:rgb(230, 226, 226)">
            <div class="card-body" style="padding: 5px">
                <div class="row" style="text-align:right;">
                    <div class="col-12 d-flex justify-content-end gap-4">
                        <div>
                            <button type="button" class="btn btn-sm btn-secondary text-nowrap px-5" id="btn_back" style="max-width:17vw;border:2px solid cyan;">
                                <i class="fa fa-arrow-left"></i>BACK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="img_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="card border-1 border-secondary" style="background: rgba(61, 61, 61, 0.5)">
                    <div>
                        <div id="panzoom" class="d-flex justify-content-center">
                            <img id="large-img" style="height: 85vh;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function eqi_show(eq){
            pack                = $(eq).data('eq');
            $.ajax({
                url             : "{{route('partner.equipment')}}",
                method          : "GET",
                data            : {pack:pack},
                success         : (res) => {
                    $('#equipment_list').text(`Equipment List for ${pack}`);
                    $('#eqlist').removeClass('d-none');
                    $('#eq-list').empty();
                    $('#eq-list').append(res);
                }
            });
        }
        $(document).on('click', '.verified-img img', function() {
            const src = $(this).attr('src');
            $('#img_modal').modal('show');
            $('#large-img').attr('src', src);
        });
        $(document).on('click', '.verified-img', function() {
            const element = document.getElementById('panzoom')
            const panzoom = Panzoom(element, {
                animate:true,
                easing: 'ease-in-out',
                minScale: 0.5,
            });
            // enable mouse wheel
            const parent = element.parentElement
            parent.addEventListener('wheel', panzoom.zoomWithWheel);
            $('#large-img').attr('src', $(this).data('imgdetail'));
            $('#modal_chat_img').modal('toggle');
            panzoom.reset();
        });
        $(document).on('click', '#btn_back', function() {
            $('#btn_back').attr('disabled', true);
            $('#btn_back').text('Back to verified list...');
            $('#btn_back').css('cursor', 'wait');
            location.href = "{{route('partner.verified.index')}}";
        });
    </script>
@endsection
