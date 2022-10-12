
$('#sitesettingsform').on('submit',function(e){
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
/*function button_main_language(){

}*/

function formatText(icon) {
    return $('<span><i class=" ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
};
function addressaddmodal(){
    $('.address_add_button').click(function (){
        Loader_toggle('show');

        var address_id = $(this).attr('data_address_id');
        var site_settings_id = $(this).attr('data-settingsid');
        $('#address_site_settings_id').val(site_settings_id);
        $('#address_id').val(address_id);
        $('#address').val(null);
        $('#gsm').val(null);
        $('#email').val(null);
        $('#maps').val(null);

        if(typeof address_id != "undefined"){
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $.ajax({

                type: 'PUT',

                url: $(this).attr('data-action'),

                data : {id:address_id},
                success: function (data) {
                    if(data.type == "success"){


                        $('#address_name').val(data.listdata.name);
                        $('#address').val(data.listdata.address);
                        $('#gsm').val(data.listdata.gsm);
                        $('#email').val(data.listdata.email);
                        $('#maps').val(data.listdata.maps);

                        Loader_toggle('hide');
                        $('#address_add').modal('hide');
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
                            $('#address_add').modal('hide');
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

        $('#address_add').modal('show');
        Loader_toggle('hide');
    });
}
addressaddmodal();
function socialmediaaddmodal(){
    $('.social_media_add_modal').click(function (){
        Loader_toggle('show');
        var site_settings_id = $(this).attr('data-settingsid');
        var social_media_id = $(this).attr('data_socialmediaid');
        $('.icon_select').val(null);
        $('.icon_select').select2({
            templateSelection: formatText,
            templateResult: formatText,
            dropdownParent:$('#socail_media_add')
        });
        $('#site_settings_id').val(site_settings_id);
        $('#social_media_id').val(social_media_id);
        $('#social_media_name').val(null);
        $('#social_media_link').val(null);
        $('#social_media_target').val(1);

        if(typeof social_media_id != "undefined"){
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $.ajax({

                type: 'PUT',

                url: $(this).attr('data-action'),

                data : {id:social_media_id},
                success: function (data) {
                    if(data.type == "success"){

                        $('.icon_select').val(data.listdata.icon);

                        $('.icon_select').select2({
                            templateSelection: formatText,
                            templateResult: formatText,
                            dropdownParent:$('#socail_media_add')
                        });
                        $('#social_media_name').val(data.listdata.name);
                        $('#social_media_link').val(data.listdata.link);
                        $('#social_media_target').val(data.listdata.link_target);
                        Loader_toggle('hide');
                        $('#socail_media_add').modal('hide');
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
                            $('#socail_media_add').modal('hide');
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
                    $('#socail_media_add').modal('hide');
                }

            });
        }

        $('#socail_media_add').modal('show');
        Loader_toggle('hide');

    });
}
socialmediaaddmodal();
$('#social_media_add').on('submit',function(e){
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
                if(data.tableRefresh == 1){
                    table_write_data(data.listData,'#social_media_table'+data.site_settings_id);
                    socialmediaaddmodal();
                }
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

                $('#socail_media_add').modal('hide');
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
$('#address_ad').on('submit',function(e){
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
                if(data.tableRefresh == 1){
                    table_write_data(data.listData,'#address_table'+data.site_settings_id);
                    addressaddmodal();
                }
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

                $('#address_add').modal('hide');
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
            $('#address_add').modal('hide');
        }

    });
});

function openhourseaddbutton(){
    $('.open_hourse_add').click(function (){
        Loader_toggle('show');

        $('#start_day').val('');
        $('#finish_day').val('');
        $('#office_id').val('');
        $('#start_time').val('');
        $('#finish_time').val('');
        var site_settings_id = $(this).attr('data-settingsid');
        var open_hourse_id = $(this).attr('data_openhouseid');

        $('#open_hourse_site_settings_id').val(site_settings_id);

        if(typeof open_hourse_id != "undefined"){
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $.ajax({

                type: 'PUT',

                url: $(this).attr('data-action'),

                data : {id:open_hourse_id},
                success: function (data) {
                    if(data.type == "success"){

                        $('#start_day').val(data.listdata.start_day);
                        $('#finish_day').val(data.listdata.finish_day);
                        $('#office_id').val(data.listdata.office_id);
                        $('#start_time').val(data.listdata.start_time);
                        $('#finish_time').val(data.listdata.finish_time);
                        Loader_toggle('hide');
                        $('#socail_media_add').modal('hide');
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
                            $('#socail_media_add').modal('hide');
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
                    $('#socail_media_add').modal('hide');
                }

            });
        }

        $('#open_hourse_modal').modal('show');
        Loader_toggle('hide');

    });
}
openhourseaddbutton();

$('#open_hourse_form').on('submit',function(e){
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
                if(data.tableRefresh == 1){
                    table_write_data(data.listData,'#open_hourse_table'+data.site_settings_id);
                    openhourseaddbutton();
                }
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


                $('#open_hourse_modal').modal('hide');
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
