$('.add_faq_new').click(function () {
    Loader_toggle('show');
    var count = parseInt($('.count').val());
    var table = $(this).attr('data-table');
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $.ajax({

        type: 'POST',

        url: $(this).attr('data-action'),

        data: {id:"add_faq_new",count:count},
        success: function (data) {
            if (data.type == "success") {
                count = count + 1;
                $('.count').val(count);
                table_write_data_append(data.listData,table);
                delete_faq_word();
                $.each(data.success_message_array, function (i, data) {
                    Toastify({
                        title: "success",
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
                Loader_toggle('hide');
            } else {
                $.each(data.error, function (i, data) {
                    Toastify({
                        title: "error",
                        text: data,
                        style: {
                            background: "red",
                        },
                        offset: {
                            x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                            y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                        },
                    }).showToast();
                    Loader_toggle('hide');
                })
            }

            Loader_toggle('hide');
        },
        error: function (data) {
            Toastify({
                title: "Error",
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
})
function delete_faq_word(){
    $('.delete_faq_word').click(function(){
       var count = $(this).attr('data-count');
       $('input[name=question'+count+']').parent().parent().remove();
    });
}


$('#faq_create').on('submit',function(e){
    e.preventDefault();
    Loader_toggle('show');
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
                Loader_toggle('hide');
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
                    Loader_toggle('hide');
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
});
$('#faq_edit').on('submit',function(e){
    e.preventDefault();
    Loader_toggle('show');
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
                table_write_data(data.listData,'#faq_table')
                deleteButtonFaq();
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
                Loader_toggle('hide');
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
                    Loader_toggle('hide');
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
});

function deleteButtonFaq(){
    $('.deleteButtonFaq').click(function(){
        var faq_id = $(this).attr('data-id');
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

                    data : {id:"faq_delete",'faq_id':faq_id},
                    success: function (data) {
                        if(data.type == "success"){
                            $('#faqs_td'+faq_id).parent().parent().remove();
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

deleteButtonFaq();
