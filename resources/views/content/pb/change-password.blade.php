@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h3">Change Password {{auth()->user()->first_name}} {{auth()->user()->last_name}}</h1>
</div>
<div class="card p-3 m-3 col-6">
    <form id="form_change_password" action="{{ route('update-password', Crypt::encrypt(auth()->user()->id)) }}" method="post">
        @csrf
        @method('put')
        <div class="d-flex">
            <label for="old_password" class="col-4 text-end d-flex flex-column justify-content-center">Old Password</label>
            <div class="col-6">
                <input type="password" id="old_password" name="old_password" class="ms-2 form-control form-control-sm" required>
            </div>
        </div>
        <div class="mt-1 d-flex">
            <label for="new_password" class="col-4 text-end d-flex flex-column justify-content-center">New Password</label>
            <div class="col-6">
                <input type="password" id="new_password" name="new_password" class="ms-2 form-control form-control-sm" required>
            </div>
        </div>
        <div class="mt-1 d-flex">
            <label for="confirm_password" class="col-4 text-end d-flex flex-column justify-content-center">Confirmation Password</label>
            <div class="col-6">
                <input type="password" id="confirm_password" name="confirm_password" class="ms-2 form-control form-control-sm" required>
            </div>
        </div>
        <div class="mt-1 d-flex">
            <span class="col-4"></span>
            <div class="ms-2 d-flex justify-content-start p-0">
                <input type="checkbox" name="show_password" id="show_password" class="me-2">
                <label for="show_password">Show Password</label>
            </div>
        </div>
        <div class="row mt-2">
            <span class="ms-2 col-4"></span>
            <button id="btn_change_password" class="btn btn-primary col-6">Submit</button>
        </div>
    </form>
</div>
<style>
    .invalid {
        box-shadow: 1px 1px 5px red;
        border: 1px solid red;
        outline-color: red;
    }
</style>
@if (Session::has('wrong-password'))
<script>
    Swal.fire({
        width               : '30em',
        icon                : 'error',
        text                : "{{Session('wrong-password')}}",
        timer               : 5000,
        showConfirmButton   : false,
        showClass   : {
            popup   : 'toast-animation-show animate__fadeInRight',
        },
        hideClass   : {
            popup   : 'toast-animation-hide animate__fadeOutRight',
        },
        toast       : true,
        position    : 'top-end',
        timerProgressBar    : true,
        showCloseButton     : true,
    });
</script>
@endif
<script>
  $(document).on('click', '#show_password', function() {
      if($(this).is(':checked')) {
          $('#old_password').prop('type', 'text');
          $('#new_password').prop('type', 'text');
          $('#confirm_password').prop('type', 'text');
      } else {
          $('#old_password').prop('type', 'password');
          $('#new_password').prop('type', 'password');
          $('#confirm_password').prop('type', 'password');
      }
  });
  $(document).on('keyup', '#confirm_password', function() {
    if($('#new_password').val() !== $(this).val()) {
        $(this).addClass('invalid')
    } else {
        $(this).removeClass('invalid')
    }
  });
  $(document).on('click', '#btn_change_password', function() {
    $(this).attr('disabled', true);
    $(this).text('Processing...');
    $('#form_change_password').submit();
  });
</script>
@endsection