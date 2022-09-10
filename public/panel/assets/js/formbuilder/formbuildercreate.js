$(document).ready(function () {

    $('.formbutton').click(function (e) {
        var option = "";
        var mask = "";

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            type: 'POST',

            url: "/Kpanel/formbuilder/input_type_list",

            data : "",
            contentType: false,
            processData: false,
            success: function (data) {
                option = data.option;
                addvalue = data.addvalue;

                var currentVal = parseInt($('#form-input-count').val());
                currentVal = currentVal + 1;

                $('#form-input-count').val(currentVal);
                $("#form_feedback").append(
                    "<tr id='formbody"+currentVal+"' class='a'> " +
                    "<td>"+
                    "<div class=\"form-check form-switch form-check-custom form-check-solid\">\n" +
                    "<label class=\"switch\">\n" +
                    "                    <input type=\"checkbox\" name='active"+currentVal+"' value='1' checked=\"\">\n" +
                    "                    <span class=\"switch-indicator\"></span>\n" +
                    "</label>" +
                    "    <label class=\"form-check-label\" for=\"flexSwitchDefault\">\n" +
                    "    </label>\n" +
                    "</div>"+
                    "</td>"+
                    "<td><select name='type_name"+currentVal+"' id='select_type"+currentVal+"' class='form-control form-control-solid formbody' data-value='"+currentVal+"'> <option value=''>Tür Seçiniz</option> " +
                    option +
                    "</select>"+
                    "</td> " +
                    "<td><input type=\"text\" class=\"form-control form-control-solid\" name='placeholder"+currentVal+"'></td> " +
                    "<td><button type='button' id='modal' data-src='"+currentVal+"' data-toggle=\'modal' data-target=\'#exampleModal"+currentVal+"' class=\"btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 formsettings\"> " +
                    "<span class=\"svg-icon svg-icon-3\">" +
                    "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\">" +
                    "<path d=\"M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z\" fill=\"currentColor\"></path>" +
                    "<path opacity=\"0.3\" d=\"M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z\" fill=\"currentColor\"></path>" +
                    "</svg>"+
                    "</span>" +
                    "</button>"+
                    "<button type='button' data-src='"+currentVal+"'  class=\"btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 formdelete\"> " +
                    "<span class=\"svg-icon svg-icon-3\"> " +
                    "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\">" +
                    "<path d=\"M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z\" fill=\"currentColor\"></path>" +
                    "<path opacity=\"0.5\" d=\"M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z\" fill=\"currentColor\"></path>" +
                    "<path opacity=\"0.5\" d=\"M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z\" fill=\"currentColor\"></path>" +
                    "</svg>" +
                    "</span>" +
                    "</button>" +
                    "<input id='order' name='order"+currentVal+"' type='hidden' value='' "+
                    "</td>"+
                    "</tr>"

                );



                $("#modelFeedback").append(
                    "<div id=\'exampleModal"+currentVal+"' class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">" +
                    "<div class=\"modal-dialog\" role=\"document\">" +
                    "<div class=\"modal-content\">" +
                    "<div class=\"modal-header\">" +
                    "<h4 class=\"modal-title\">İnput Ayarları</h4>" +
                    "</div>" +
                    "<div class=\"modal-body\">" +
                    "<div class=\"form-check form-check-custom form-check-solid\">" +
                    "<label class=\"fs-6 fw-bold form-label mt-3\">" +
                    "<span class=\"required\">Zorunluluk</span>" +
                    "</label>" +
                    "<label class=\"switch m-3\">"+
                    "<input name=\'required"+currentVal+"\' class=\"form-check-input m-3\" type=\"checkbox\" value=\"1\" id=\"flexCheckDefault\"/>" +
                    "<span class=\"switch-indicator\"></span>\n" +
                    "</label>"+
                    "</div>" +
                    "<div class=\"fv-row mb-7 fv-plugins-icon-container\">" +
                    "<label class=\"fs-6 fw-bold form-label mt-3\">" +
                    "<span class=\"required\">İsim</span>" +
                    "</label>" +
                    "<input type=\"text\" name=\'name_input"+currentVal+"\' id=\"task-textare\" class=\"form-control form-control-solid\">" +
                    "</div>" +
                    "                        <div id='' class=\"fv-row mb-7 fv-plugins-icon-container\">" +
                    "                        <label class=\"fs-6 fw-bold form-label mt-3\">" +
                    "                        <span class=\"required\">Varsayılan Değer</span>" +
                    "                        </label>" +
                    "                        <input type=\"button\" id='addvalue"+currentVal+"'  class=\"btn btn-warning m-lg-2  addvaluebutton\" data-value='"+currentVal+"' value=\"Değer Ekle\" "+addvalue+">" +
                    "                        <div id='addvalues"+currentVal+"'></div>"+
                    "                        <div class='mt-3'>"+
                    "                        <input type=\"text\" name=\'default_value"+currentVal+"\' id=\"task-textare\" class=\"form-control form-control-solid value_mask"+currentVal+"\">" +
                    "                        </div>"+
                    "                        </div>" +
                    "                        <div class=\"form-check form-check-custom form-check-solid\">" +
                    "                            <label class=\"fs-6 fw-bold form-label mt-3\">" +
                    "                                <span class=\"required\">Bu yazı Placeholder alanında kullanılacak mı?</span>" +
                    "                            </label>" +
                    "                               <label class=\"switch m-3\">"+
                    "                               <input name=\'placeholder_use"+currentVal+"\' class=\"form-check-input m-3\" type=\"checkbox\" value=\"1\" id=\"flexCheckDefault\"/>" +
                    "                               <span class=\"switch-indicator\"></span>\n" +
                    "                            </label>"+
                    "                        </div>" +
                    "                        <div class=\"fv-row mb-7 fv-plugins-icon-container\">" +
                    "                            <label class=\"fs-6 fw-bold form-label mt-3\">" +
                    "                                <span class=\"required\">ID Alanı</span>" +
                    "                            </label>" +
                    "                            <input type=\"text\" name='id_attr"+currentVal+"' id=\"task-textare\" class=\"form-control form-control-solid\">" +
                    "                        </div>" +
                    "                        <div class=\"fv-row mb-7 fv-plugins-icon-container\">" +
                    "                            <label class=\"fs-6 fw-bold form-label mt-3\">" +
                    "                                <span class=\"required\">Class Alanı</span>" +
                    "                            </label>" +
                    "                            <input type=\"text\" name=\'class_attr"+currentVal+"\' id=\"task-textare\" class=\"form-control form-control-solid\">" +
                    "                        </div>" +
                    "                    </div>" +
                    "                </div>" +
                    "            </div>" +
                    " </div>")







                $('.formdelete').click(function () {
                    $("#formbody" + $(this).attr('data-src')).remove();
                    $("#exampleModal" + $(this).attr('data-src')).remove();

                });


                $("#select_type"+currentVal).on('change',function(){
                    var loop = "";

                    $.ajax({

                        type: 'POST',

                        url: "/Kpanel/formbuilder/selectboxloop",

                        data : {id:$(this).val()},

                        success: function (data) {
                            loop = data.loop;
                            if (loop === 1){
                                $('#addvalue'+currentVal).show();

                            }else {

                                $("#addvalues"+currentVal).html(" ");
                                $('#addvalue'+currentVal).hide();
                            }
                        }
                    });
                });

                $('#addvalue'+currentVal).click(function () {
                    currentVal = $(this).attr('data-value');
                    var currentVal2 = parseInt($('#selectbox-count').val());
                    currentVal2 = currentVal2 + 1;
                    $('#selectbox-count').val(currentVal2);

                    $("#addvalues"+currentVal).append(
                        "<div id='addvalue_extra' class=\"fv-row mb-7 mt-3 fv-plugins-icon-container addvalue_extra\">" +
                        "<input type=\"text\" name=\'addvalue_extra"+currentVal+"_"+currentVal2+"\' id=\"task-textare\" class=\"form-control form-control-solid \">" +
                        "</div>");
                });


            },
            error: function(data)
            {

            }

        });



    })

    $('#form_type').on('change',function () {
        var return_url= $(this).find('option:selected').val();
        if(return_url == 1) {
            $(".return_div").show();
        }if(return_url != 1) {
            $(".return_div").hide();
        }
    })

    $('#form_type').on('change',function () {
        var return_url= $(this).find('option:selected').val();
        if(return_url == 2) {
            $(".return_div2").show();
        }if(return_url != 2) {
            $(".return_div2").hide();
        }
    })


})
