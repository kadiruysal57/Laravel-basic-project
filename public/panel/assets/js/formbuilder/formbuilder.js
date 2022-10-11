$(document).ready(function(){
    addvaluebutton();
    form_inputdeletefunct();

    $('#form_create').on('submit',function(e){
    e.preventDefault();
    $('.preloader').show();
    var form = new FormData(this);
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $.ajax({

        type: 'POST',

        url: $(this).attr('action'),

        data : form,
        contentType: false,
        processData: false,
        success: function (data) {
            if(data.type == "success"){
                $('.preloader').hide();
                window.location.href = data.route_url;
                $.each(data.success_message_array, function (i, data){
                    Toastify({
                        title:"success",
                        text: data,
                        style: {
                            background: "green",
                        },
                        offset: {
                            x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                            y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                        },
                    }).showToast();

                })

            }else{
                $.each(data.error, function (i, data){
                    Toastify({
                        title:"error",
                        text: data,
                        style: {
                            background: "red",
                        },
                        offset: {
                            x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                            y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                        },
                    }).showToast();
                })

                $('.preloader').hide();
            }
        },
        error: function(data)
        {
            $.each(data.error, function (i, data){
                Toastify({
                    title:"error",
                    text: data,
                    style: {
                        background: "red",
                    },
                    offset: {
                        x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                        y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                    },
                }).showToast();
            })

            $('.preloader').hide();
        }

    });
});

    $('#form_edit').on('submit',function(e){

        e.preventDefault();
        $('.preloader').show();
        var form = new FormData(this);
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $.ajax({

            type: 'POST',

            url: $(this).attr('action'),

            data : form,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data.type === "success"){
                    $.each(data.success_message_array, function (i, data){
                        Toastify({
                            title:"success",
                            text: data,
                            style: {
                                background: "green",
                            },
                            offset: {
                                x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                                y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                            },
                        }).showToast();

                    })

                    $('.preloader').hide();

                }else{
                    $.each(data.error, function (i, data){
                        Toastify({
                            title:"error",
                            text: data,
                            style: {
                                background: "red",
                            },
                            offset: {
                                x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                                y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                            },
                        }).showToast();
                    })

                    $('.preloader').hide();
                }
            },
            error: function(data)
            {
                $.each(data.error, function (i, data){
                    Toastify({
                        title:"error",
                        text: data,
                        style: {
                            background: "red",
                        },
                        offset: {
                            x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                            y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                        },
                    }).showToast();
                })

                $('.preloader').hide();
            }

        });
    });

    function addvaluebutton (){
        $('.addvaluebutton_edit').click(function () {
            var currentVal = $(this).attr('data-value');
            var currentVal2 = parseInt($('#countformselectbox').val());
            currentVal2 = currentVal2 + 1;
            $('#countformselectbox').val(currentVal2);

            $("#addvalues_edit"+currentVal).append(
                "<div id='addvalue_extra' class=\"fv-row mb-7 mt-3 fv-plugins-icon-container addvalue_extra\">" +
                "<input type=\"text\" name=\'addvalue_extra"+currentVal+"_"+currentVal2+"\' id=\"task-textare\" class=\"form-control form-control-solid value_mask"+currentVal+"\">" +
                "</div>");

        })
    }

    function form_inputdeletefunct() {
        $('.formdeleteedit').click(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'İnputu silmek istediğinize emin misiniz?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Sil',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    $("#formbody_edit" + $(this).attr('data-src')).remove();
                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        }

                    });
                    $.ajax({

                        type: 'POST',

                        url: $(this).attr('data-action'),

                        data: {id: $(this).attr('id') , data:$(this).attr('data-src')},

                        success: function (data) {
                            if (data.error != "") {
                                $.each(data.error, function (index, value) {
                                    Toastify({
                                        title: "Error",
                                        text: value,
                                        style: {
                                            background: "red",
                                        },
                                        offset: {
                                            x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                                            y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                                        },
                                    }).showToast();
                                    $('.preloader').hide();
                                });

                            }
                            if (data.type == "success") {


                                Toastify({
                                    text: "Update Successfully",
                                    style: {
                                        background: "green",
                                    },
                                    offset: {
                                        x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                                        y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                                    },
                                }).showToast();

                                $('.preloader').hide();


                            }

                            console.log(data);
                        }
                        ,
                        error: function (data) {
                            console.log(data);
                            $('.preloader').hide();
                        }

                    })
                    ;
                } else {
                    $('.preloader').hide();
                }
            })
        });
    }

});
