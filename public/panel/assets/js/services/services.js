$(document).ready(function(){

    $('#services_create').on('submit',function(e){
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
                    console.log(data.route_url);
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

                        $('.preloader').hide();
                    })
                }
            },
            error: function(data)
            {
                Toastify({
                    title:"Error",
                    text: "An Error Occurred, please try again later.",
                    style: {
                        background: "red",
                    },
                    offset: {
                        x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                        y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                    },
                }).showToast();

                $('.preloader').hide();
            }

        });
    });

    $('#services_update').on('submit',function(e){

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

                        $('.preloader').hide();
                    })
                }
            },
            error: function(data)
            {
                Toastify({
                    title:"Error",
                    text: "An Error Occurred, please try again later.",
                    style: {
                        background: "red",
                    },
                    offset: {
                        x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                        y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                    },
                }).showToast();

                $('.preloader').hide();
            }

        });
    });

    function deleteButtonServices(){
        $('.deleteButtonServices').click(function(){

            var services_id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Loader_toggle('show');

                    var table = $(this).attr('data-table');
                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        }

                    });


                    $.ajax({

                        type: 'POST',

                        url: $(this).attr('data-action'),

                        data : {id:"services_delete",'services_id':services_id},
                        success: function (data) {
                            if(data.type == "success"){

                                $('#servicesimage_edit'+services_id).parent().parent().remove();
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
                                $.each(data.error_message_array, function (i, data){
                                    Toastify({
                                        title:"Error",
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
                            }
                            Loader_toggle('hide');
                        },
                        error: function(data)
                        {
                            Toastify({
                                title:"Error",
                                text: "An Error Occurred, please try again later.",
                                style: {
                                    background: "red",
                                },
                                offset: {
                                    x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                                    y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                                },
                            }).showToast();

                            Loader_toggle('hide');
                        }

                    });
                }
            });
        });
    }
    deleteButtonServices();

});
