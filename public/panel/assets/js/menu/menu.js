$(document).ready(function (){
    var updateOutput = function (e) {

        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    function getMenuNestable(){
        $('#menu_nestable').nestable({
            group: 1,
            maxDepth: '4', // controllerdan geliyor alt alta kaç tane menü olduğu belli etiyor
        }).on('change', updateOutput);
    }
    updateOutput($('#menu_nestable').data('output', $('#nestable-output')));

    $('#custom-link-add').on('submit',function(e){
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

                    $('#menu_nestable').html(data.menu_html);
                    deleteButton();
                    getMenuNestable();
                    modalSave();
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


    deleteButton();
    function deleteButton() {
        $('.dd-deletebutton').click(function () {
            Swal.fire({
                title: 'Are you sure you want to delete?\n',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't delete`,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {

                if (result.isConfirmed) {
                    Loader_toggle('show');
                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        }

                    });
                    $.ajax({

                        type: 'DELETE',

                        url: $(this).attr('data-action'),
                        success: function (data) {
                            if(data.type == "success"){
                                $('#menu_nestable').html(data.menu_html);
                                deleteButton();
                                getMenuNestable();
                                modalSave();
                                updateOutput($('#menu_nestable').data('output', $('#nestable-output')))

                                $.each(data.collaps, function( index, value ) {
                                    $('#nestable'+index).html(value);
                                });
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
                                Loader_toggle('hide');
                            }
                        },
                        error: function (data) {
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
            })
        });
    }


    $('.menu_item_save').click(function (e){
        e.preventDefault();
        Loader_toggle('show');
        updateOutput($('#menu_nestable').data('output', $('#nestable-output')))
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $.ajax({

            type: 'POST',

            url: $(this).attr('data-action'),

            data : {id:"update",data:$('#nestable-output').val(),menu_id:$(this).attr('data-menuid')},
            success: function (data) {
                if(data.type == "success"){
                    $('#menu_nestable').html(data.menu_html);
                    deleteButton();

                    modalSave();
                    $.each(data.collaps, function( index, value ) {
                        $('#nestable'+index).html(value);
                    });
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

                Loader_toggle('hide');

            }

        });
    });

    $('#custom_link_edit').on('submit',function(e){
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

                    $('#menu_nestable').html(data.menu_html);
                    deleteButton();
                    getMenuNestable();
                    modalSave();
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
                    $('#menu-custom-modal').modal('hide');
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
                        $('#menu-custom-modal').modal('hide');
                        Loader_toggle('hide');
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

                Loader_toggle('hide');
            }

        });
    });

    modalSave();
    function modalSave(){

        $('.menu-custom-modal-open').click(function (){

            Loader_toggle('show');
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $.ajax({

                type: 'GET',

                url: $(this).attr('data-action'),

                data :{id:$(this).attr('data-id')},
                success: function (data) {
                    if(data.type == "success"){
                        $('#custom_link_name_edit').val(data.data.menu_name);
                        $('#custom_link_url_edit').val(data.data.real_link);
                        $('#custom_link_target_edit').val(data.data.target);
                        $('#custom_link_edit').attr('action',data.action);
                        $('#custom_link_id').val(data.data.id);

                        $('#menu-custom-modal').modal('show');
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
    }
})
