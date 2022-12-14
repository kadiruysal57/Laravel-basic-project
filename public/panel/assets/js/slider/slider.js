$(document).ready(function(){
    sliderdeletefunct();
    $('#slider_create').on('submit',function(e){
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

    $('#slider_update').on('submit',function(e){

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

    function sliderdeletefunct() {
        $('.sliderimagedelete_edit').click(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Slider?? silmek istedi??inize emin misiniz?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Delete',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    $("#sliderimage_edit" + $(this).attr('data-src')).remove();
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
