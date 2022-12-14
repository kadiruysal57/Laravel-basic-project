
$('#default_blok_create').on('submit',function(e){
    e.preventDefault();
    $('.top_blok_data').val(window.JSON.stringify($('#top_blok_nestable').nestable('serialize')));
    $('.left_blok_data').val(window.JSON.stringify($('#left_blok_nestable').nestable('serialize')));
    $('.mid_blok_data').val(window.JSON.stringify($('#mid_blok_fix_nestable').nestable('serialize')));
    $('.right_blok_data').val(window.JSON.stringify($('#right_blok_nestable').nestable('serialize')));
    $('.footer_blok_data').val(window.JSON.stringify($('#footer_blok_nestable').nestable('serialize')));
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
$('#default_blok_edit').on('submit',function(e){
    e.preventDefault();
    $('.top_blok_data').val(window.JSON.stringify($('#top_blok_nestable').nestable('serialize')));
    $('.left_blok_data').val(window.JSON.stringify($('#left_blok_nestable').nestable('serialize')));
    $('.mid_blok_data').val(window.JSON.stringify($('#mid_blok_fix_nestable').nestable('serialize')));
    $('.right_blok_data').val(window.JSON.stringify($('#right_blok_nestable').nestable('serialize')));
    $('.footer_blok_data').val(window.JSON.stringify($('#footer_blok_nestable').nestable('serialize')));
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
                $.each(data.file_array,function(i,data){
                    $('#'+i).html(data);
                })
                html_blok_js();
                ddhandetrash();
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

function ddhandetrash(){
    $('.dd-handetrash').click(function(){
        var thisbutton =$(this);
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('.preloader').show();
                var default_blok_id = $(this).attr('data-defaultblokid');
                var id = $(this).attr('data-id');

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });
                $.ajax({

                    type: 'POST',

                    url: $(this).attr('action'),

                    data : {default_blok_id:default_blok_id,page_files_id:id,id:"blok-file-delete"},
                    success: function (data) {
                        if(data.type === "success"){

                            $.each(data.file_array,function(i,data){
                                $('#'+i).html(data);
                            })

                            nestableCall()
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
                            $.each(data.error_message_array, function (i, data){
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
            }
        })
    })
}
ddhandetrash();

