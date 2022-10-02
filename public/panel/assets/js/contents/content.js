var options = {
    filebrowserImageBrowseUrl: '/Kpanel/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/Kpanel/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/Kpanel/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/Kpanel/laravel-filemanager/upload?type=Files&_token='
};
var editor = CKEDITOR.replace('description', options);
$(document).ready(function () {

    $('.gallery_adds').filemanager('image');
    $('#contents_create').on('submit', function (e) {
        e.preventDefault();
        editor.updateElement();
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

            data: form,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.type == "success") {
                    $('.preloader').hide();
                    console.log(data.route_url);
                    window.location.href = data.route_url;
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

                        $('.preloader').hide();
                    })
                }
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

                $('.preloader').hide();
            }

        });
    });

    $('#contents_update').on('submit', function (e) {

        e.preventDefault();
        editor.updateElement();
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

            data: form,
            contentType: false,
            processData: false,
            success: function (data) {
                $.each(data.file_array, function (i, data) {
                    $('#' + i).html(data);
                })

                nestableCall()
                ddhandetrash()
                table_write_data(data.listData, '#content_gallery_add_table');
                deleteButtonGallery();
                html_blok_js();
                if (data.type === "success") {
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

                    $('.preloader').hide();

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

                        $('.preloader').hide();
                    })
                }
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

                $('.preloader').hide();
            }

        });
    });

    function ddhandetrash() {
        $('.dd-handetrash').click(function () {
            var thisbutton = $(this);
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
                    var contentsid = $(this).attr('data-contentsid');
                    var id = $(this).attr('data-id');

                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        }

                    });
                    $.ajax({

                        type: 'POST',

                        url: $(this).attr('action'),

                        data: {contentsid: contentsid, page_files_id: id, id: "blok-file-delete"},
                        success: function (data) {
                            if (data.type === "success") {

                                $.each(data.file_array, function (i, data) {
                                    $('#' + i).html(data);
                                })

                                nestableCall()
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

                                $('.preloader').hide();

                            } else {
                                $.each(data.error_message_array, function (i, data) {
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

                                    $('.preloader').hide();
                                })
                            }
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

                            $('.preloader').hide();
                        }

                    });
                }
            })
        })
    }

    ddhandetrash();

    $('#default_blok').on('change', function () {
        var value = $(this).val();
        if (value == 0) {
            $('.blok_manager_content').show();
        } else {
            $('.blok_manager_content').hide();
        }
    });

    function gallery_image_delete() {
        $('.gallery_image_delete').click(function () {
            var count = $(this).attr('data-count');
            $('.gallery_image_delete' + count).parent().parent().remove();
        });
    }

    $('.gallery_add_button').click(function () {
        Loader_toggle('show');
        var count = parseInt($('#count_gallery').val());
        count = count + 1;
        var table = $(this).attr('data-table');
        var id = "gallery_add";
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $.ajax({

            type: 'PUT',

            url: $(this).attr('data-action'),

            data: {count: count},
            success: function (data) {
                if (data.type === "success") {
                    $('#count_gallery').val(count);
                    console.log(data.listData);
                    table_write_data_append(data.listData, table);
                    gallery_image_delete();
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

                $('.preloader').hide();
            }

        });
    });

    function deleteButtonGallery() {
        $('.deleteButtonGallery').click(function () {
            var id = $(this).attr('data-id');
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

                    var table = $(this).attr('data-table');
                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        }

                    });


                    $.ajax({

                        type: 'PUT',

                        url: $(this).attr('data-action'),

                        data: {value: id},
                        success: function (data) {
                            if (data.type == "success") {
                                if (data.tableRefresh == 1) {
                                    table_write_data(data.listData, table);
                                    deleteButtonGallery();
                                }
                                $('.gallery_image_deletes' + id).parent().parent().remove();
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
                            } else {
                                $.each(data.error_message_array, function (i, data) {
                                    Toastify({
                                        title: "Error",
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
                            $('.preloader').hide();
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

                            $('.preloader').hide();
                        }

                    });
                }
            });

        });
    }

    deleteButtonGallery();

    $('.content_name').change('on',function(){
        var name = $(this).val();
        var seo_url = $('input[name=seo_url]').val();
        var action = $('#contents_create').attr('action');
        if(action == undefined){
            action = $('#contents_update').attr('action');
        }

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $.ajax({

            type: 'POST',

            url: action,

            data: {name:name,id:"seo_url_str"},
            success: function (data) {

                $('input[name=seo_url]').val(data.seo_url);
                $('.preloader').hide();
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

                $('.preloader').hide();
            }

        });
    })
});
