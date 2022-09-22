
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
function socialmediaaddmodal(){
    $('.social_media_add_modal').click(function (){
        Loader_toggle('show');
        var site_settings_id = $(this).attr('data-settingsid')
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
});
