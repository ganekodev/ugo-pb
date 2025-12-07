@if (Session::has('alert-success'))
    <script>
        Swal.fire({
            width               : '30em',
            icon                : 'success',
            text                : "{{Session('alert-success')}}",
            timer               : 5000,
            showConfirmButton   : false,
            showClass   : {
                popup   : 'toast-animation-show animate__fadeInRight',
            },
            hideClass   : {
                popup   : 'toast-animation-hide animate__fadeOutRight',
            },
            toast       : true,
            position    : 'bottom-end',
            timerProgressBar    : true,
            showCloseButton     : true,
        });
    </script>
@endif
@if (Session::has('alert-error'))
    <script>
        Swal.fire({
            width               : '30em',
            icon                : 'error',
            text                : "{{Session('alert-error')}}",
            timer               : 5000,
            showConfirmButton   : false,
            showClass   : {
                popup   : 'toast-animation-show animate__fadeInRight',
            },
            hideClass   : {
                popup   : 'toast-animation-hide animate__fadeOutRight',
            },
            toast       : true,
            position    : 'bottom-end',
            timerProgressBar    : true,
            showCloseButton     : true,
        });
    </script>
@endif
@if ($errors->any())
    <script>
        Swal.fire({
            width               : '30em',
            icon                : 'error',
            text                : "Update data failed. Please check your data!!!",
            timer               : 5000,
            showConfirmButton   : false,
            showClass   : {
                popup   : 'toast-animation-show animate__fadeInRight',
            },
            hideClass   : {
                popup   : 'toast-animation-hide animate__fadeOutRight',
            },
            toast       : true,
            position    : 'bottom-end',
            timerProgressBar    : true,
            showCloseButton     : true,
        });
    </script>
@endif
