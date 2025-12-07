<style>
    .card-body .fieldset{margin:1% auto;}
    .card-body fieldset{padding:1% 1%;border-left:4px solid grey; box-shadow: 0px 0px 1px 0px}
    #dashboard{
        margin-top:2rem;
    }
    .dash {
        display:flex;
    }
    .dash .dash-card{
        width:33%;
    }
    #dashboard .dash-card .card{
        background:blue;
        color:#fff;
        box-shadow:1px 4px 4px 2px grey;
    }
    table.dataTable thead tr th {
        border-bottom: 2px solid grey;
        font-size: 0.8rem;
    }
    div.dataTables_wrapper tbody tr td {
        border-bottom: 1px solid rgba(189, 188, 188, 0.5);
        padding: 0.5rem;
        white-space: nowrap;
    }
    div.datatables_scrollbody {
        border: 1px solid lightgray;
    }
    input[type=text].form-control:focus,
    input[type=number].form-control:focus,
    input[type=date].form-control:focus,
    input[type=email].form-control:focus {
        box-shadow: 1px 1px rgb(97, 96, 96);
        height: 0.7rem;
        font-size: 0.8rem;
        font-weight: 500;
    }
    input[type=text].form-control,
    input[type=number].form-control,
    input[type=checkbox].form-check-input,
    input[type=date].form-control,
    input[type=email].form-control {
        border-color: gray;
        height: 0.7rem;
        font-size: 0.8rem;
    }
    input[type=checkbox].form-check-input:focus {
        box-shadow: 0 0 rgb(97, 96, 96);
        height: 0.9rem;
        font-size: 0.8rem;
        font-weight: 500;
    }
    input[type=checkbox].form-check-input {
        height: 0.9rem;
        font-size: 0.8rem;
        font-weight: 500;
    }
    input[type=file].form-control,
    input[type=file].form-control:focus {
        border-color: gray;
        font-size: 0.8rem;
        box-shadow: 1px 1px rgb(97, 96, 96);
    }
    textarea.form-control {
        border-color: gray;
    }
    textarea.form-control:focus {
        box-shadow: 1px 1px rgb(97, 96, 96);
        border-color: gray;
    }
    select.form-select:focus {
        box-shadow: 1px 1px rgb(97, 96, 96);
        height: 1.8rem;
        border-color: gray;
    }
    select.form-select {
        box-shadow: none;
        height: 1.8rem;
        border-color: gray;
    }
    .result-scroller {
        position:absolute;
        border:1px solid gray;
        box-shadow: 1px 1px rgb(97, 96, 96);
        padding:0;
        max-height:30vh;
        overflow-y:auto;
    }
    .result-scroller>option, .result-scroller>li {
        background: whitesmoke;
        cursor:pointer;
    }
    .result-scroller::-webkit-scrollbar {display: none} /* chrome */
    .result-scroller {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    .toast-animation-show {
        animation: swal2-show 2s;
    }
    .toast-animation-hide {
        animation: swal2-hide 2s;
    }
    .slow-animation-show {
        animation: swal2-show 0.8s;
    }
    .slow-animation-hide {
        animation: swal2-hide 0.5s;
    }
    .nav-tabs>.nav-item>.nav-link.active {
        color: #0d6efd;
        border: 1px solid #0dcaf0;
        border-bottom: 0;
    }
    .nav-tabs>.nav-item>.nav-link {
        color: rgba(0, 0, 0, 0.7);
    }
    #swal2-title,.custom-title {
        font-size: 1.2rem;
    }
    .custom-input.form-control {
        border-color: gray;
    }
    .custom-input.form-control:focus {
        box-shadow: 1px 1px rgb(97, 96, 96);
    }
    .custom-actions {
        min-width: 350px;
    }
    .cost-img{
        max-width:150px;
        max-height:125px
    }
    input.form-control.form-control-sm.invalid{border:1px solid red;}
    /* input.form-control.form-control-sm.valid{border:0.5px solid #ddd;} */
    .li-scroller::-webkit-scrollbar{width: 7px;height:2vh}
    .li-scroller::-webkit-scrollbar-track{background: #eee; }
    .li-scroller::-webkit-scrollbar-thumb{background: #eee; }
    .li-scroller::-webkit-scrollbar-thumb:hover{background: #456; }
    .li-scroller{position:relative; height:23vh; min-width:10vw; overflow-y:scroll; overflow-x:hidden;}
</style>
<script src="{{asset('/vendor/jquery/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('/vendor/datatables/js/datatables.min.js')}}"></script>
<script src="{{asset('/vendor/sweetalert2/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('/vendor/moment/moment-with-locales.min.js')}}"></script>
<script>
    $(document).on('keypress', 'input', function(e) {
        if(e.which == 13) {
            e.preventDefault();
        }
    });
    function result_direction(input_text, result_ul, btn_wrapper) {
        let input_top       = $('#'+input_text).position().top;
        let ul_top          = $('#'+result_ul).position().top;
        let ul_height       = $('#'+result_ul).height();
        let direction       = input_top - ul_height - 2.5;

        let result_height   = ul_top + ul_height + 60;
        let btn_wrapper_top = $('#'+btn_wrapper).position().top;

        if(result_height >= btn_wrapper_top) {
            $('#'+result_ul).css('top', direction+'px');
            $('#'+btn_wrapper).addClass('dropup');
        }
    }
    // read image
    function readImg(input,type) {
        if (input.files && input.files[0]) {
            var reader              = new FileReader();
            reader.onload           = function (e) {
                $('#'+type).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            $('#'+type).attr('src',"https://via.placeholder.com/150");
        }
    }
    // format number
    function format_number(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    // upper case
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }
    // Export parameter
    function setParamExport(so='', customer='', vendor='', nopol='', driver='', start='', end='') {
        if(so.val() !== "") {
            if(so.val().length < 8){
                $('#so_exp').val('');
                so.addClass("invalid");
                so.focus();
                removeInvalid(null,customer,vendor,nopol,driver,start,end);
                alert("shipment number not valid, minimum 8 characters !!!");
                event.preventDefault();
            } else {
                removeInvalid(so,customer,vendor,nopol,driver,start,end);
                $('#so_exp').val(so.val());
            }
        } else {
            if(so.val()=="" && customer.val()=="" && vendor.val()=="" && nopol.val()=="" && driver.val()=="") {
                if(start.val()=="" && end.val()=="") {
                    addInvalid(so,customer,vendor,nopol,driver,start,end);
                    alert("Please input filter field !!")
                    event.preventDefault();
                } else if(start.val() !=="" && end.val() !=="") {
                    const date1                     = new Date(start.val());
                    const date2                     = new Date(end.val());
                    const diffTime                  = Math.abs(date1 - date2);
                    const diffDays                  = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    if(diffDays > 31 || date1>date2) {
                        start.addClass("invalid");
                        end.addClass("invalid");
                        removeInvalid(so,customer,vendor,nopol,driver);
                        alert("maximum date periode 31 days");
                        event.preventDefault();
                    } else {
                        removeInvalid(so,customer,vendor,nopol,driver,start,end);
                        $('#start_exp').val(start.val());
                        $('#end_exp').val(end.val());
                    }
                } else {
                    start.addClass("invalid");
                    end.addClass("invalid");
                    removeInvalid(so,customer,vendor,nopol,driver);
                    alert("start and end filter cannot be empty!!!");
                    event.preventDefault();
                }
            }
            if(customer.val() !== "") {
                if(customer.val().length < 3) {
                    customer.val('');
                    customer.focus();
                    customer.addClass("invalid");
                    removeInvalid(so,null,vendor,nopol,driver,start,end);
                    alert("customer name not valid, minimum 3 characters !!!");
                    event.preventDefault();
                } else {
                    removeInvalid(so,customer,vendor,nopol,driver);
                    pickup_date_validator($('#pickup_date_start_filter'),$('#pickup_date_end_filter'),'customer_name');
                }
            }
            if(vendor.val() !== "") {
                if(vendor.val().length < 3) {
                    vendor.val('');
                    vendor.focus();
                    vendor.addClass("invalid");
                    removeInvalid(so,customer,null,nopol,driver,start,end);
                    alert("vendor name not valid, minimum 3 characters !!!");
                    event.preventDefault();
                } else {
                    removeInvalid(so,customer,vendor,nopol,driver);
                    pickup_date_validator($('#pickup_date_start_filter'),$('#pickup_date_end_filter'),'vendor_name');
                }
            }
            if(nopol.val() !== "") {
                if(nopol.val().length < 3){
                    nopol.val('');
                    nopol.focus();
                    nopol.addClass("invalid");
                    removeInvalid(so,customer,vendor,null,driver,start,end);
                    alert("nopol not valid, minimum 3 characters !!!");
                    event.preventDefault();
                } else {
                    removeInvalid(so,customer,vendor,nopol,driver);
                    pickup_date_validator($('#pickup_date_start_filter'),$('#pickup_date_end_filter'),'police_number');
                }
            }
            if(driver.val() !== "") {
                if(driver.val().length < 3){
                    driver.val('');
                    driver.focus();
                    driver.addClass("invalid");
                    removeInvalid(so,customer,vendor,nopol,null,start,end);
                    alert("driver not valid, minimum 3 characters !!!");
                    event.preventDefault();
                } else {
                    removeInvalid(so,customer,vendor,nopol,driver);
                    pickup_date_validator($('#pickup_date_start_filter'),$('#pickup_date_end_filter'),'driver_name');
                }
            }
        }
    }
    function addInvalid(so,customer,vendor,nopol,driver,start,end) {
        so && so.addClass("invalid");
        customer && customer.addClass("invalid");
        vendor && vendor.addClass("invalid");
        nopol && nopol.addClass("invalid");
        driver && driver.addClass("invalid");
        start && start.addClass("invalid");
        end && end.addClass("invalid");
    }
    function removeInvalid(so,customer,vendor,nopol,driver,start,end) {
        so && so.removeClass("invalid");
        customer && customer.removeClass("invalid");
        vendor && vendor.removeClass("invalid");
        nopol && nopol.removeClass("invalid");
        driver && driver.removeClass("invalid");
        start && start.removeClass("invalid");
        end && end.removeClass("invalid");
    }
    function pickup_date_validator(start,end,filter) {
        if(start.val() == "" || end.val() == "") {
            start.addClass("invalid");
            end.addClass("invalid");
            $(`#${filter}_filter`).removeClass("invalid");
            alert("start and end filter cannot be empty!!!");
            event.preventDefault();
        } else if(start.val()  == "" && end.val() !== "") {
            start.addClass("invalid");
            alert("start filter cannot be empty!!!");
            event.preventDefault();
        } else if(start.val() !== "" && end.val() == "") {
            end.addClass("invalid");
            alert("end filter cannot be empty!!!");
            event.preventDefault();
        } else {
            const date1                     = new Date(start.val());
            const date2                     = new Date(end.val());
            const diffTime                  = Math.abs(date1 - date2);
            const diffDays                  = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            if(diffDays > 31 || date1>date2) {
                start.addClass("invalid");
                end.addClass("invalid");
                alert("maximum date periode 31 days");
                event.preventDefault();
            } else {
                $(`#${filter}_filter`).removeClass("invalid");
                start.removeClass("invalid");
                end.removeClass("invalid");
                $(`#${filter}_exp`).val($(`#${filter}_filter`).val());
                $('#start_exp').val(start.val());
                $('#end_exp').val(end.val());
            }
        }
    }
</script>

