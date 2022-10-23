
$(document).ready(function () {
    $('.sliderbutton').click(function (e) {
        e.preventDefault();

        var currentVal = parseInt($('#HiddenSlider').val());
        currentVal = currentVal + 1;
        $('#HiddenSlider').val(currentVal);
        $("#slider_feedback").append(
            '<div id="sliderimage'+currentVal+'" class="mt-5 bg-light" style="border-radius:30px; padding: 10px;" >'+
            '<button data-src="'+currentVal+'" class="btn btn-icon btn-active-color-primary btn-sm me-1 sliderimagedelete">'+
            '<a  class="fa fa-trash">'+
            '</a>'+

            '</button>'+

            '<div class="d-flex">'+
            '<div class ="col-4 " >'+
            '<div class="input-group d-grid justify-content-center">'+
            '<div class="d-flex justify-content-center">'+
            '<span class="input-group-btn">'+
            '<a id="lfm'+currentVal+'" data-input="thumbnail'+currentVal+'" data-preview="holder'+currentVal+'" class="btn btn-primary ">'+
            '<i class="fa fa-picture-o"></i> Select'+
            '</a>'+
            '</span>'+
            '</div>'+
            '<input id="thumbnail'+currentVal+'" class="form-control" type="hidden" name="filepath'+currentVal+'" value="">'+
            '</div>'+
            '<div class=" d-flex justify-content-center align-items-center mt-5" id="holder'+currentVal+'">'+
            '<img  style="max-height:130px; max-width:130px;" src="" >'+
            '</div>'+

            '</div>'+

            '<div class="col-4" style="text-align: -webkit-center">'+

            '<div class="fv-row mb-7 fv-plugins-icon-container justify-content-center mt-3" >'+
            '<label class="fs-6 fw-bold form-label require">'+
            '<span >Başlık</span>'+
            '</label>'+
            '<input type="text" class="form-control form-control w-75 p-3" name="slider_title'+currentVal+'">'+
            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+


            '<div class="fv-row mb-7 fv-plugins-icon-container mt-3">'+
            '<label class="fs-6 fw-bold form-label ">'+
            '<span>Açıklama</span>'+
            '</label>'+
            '<input type="text" class="form-control form-control w-75 p-3" name="slider_desc'+currentVal+'">'+

            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+


            '<div class="fv-row mb-7 fv-plugins-icon-container justify-content-center mt-3" >'+
            '<label class="fs-6 fw-bold form-label">'+
            '<span>Text</span>'+
            '</label>'+
            '<textarea class="form-control form-control w-75 p-3" name="slider_text'+currentVal+'"></textarea>'+
            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+

            '</div>'+


            '<div class="col-4 " style="text-align: -webkit-center">'+

            '<div class="fv-row mb-7 fv-plugins-icon-container">'+
            '<label class="fs-6 fw-bold form-label ">'+
            '<span>Buton Yazısı</span>'+
            '</label>'+
            '<input type="text" class="form-control form-control w-75 p-3" name="button_text'+currentVal+'">'+
            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+


            '<div class="fv-row mb-7 fv-plugins-icon-container">'+
            '<label class="fs-6 fw-bold form-label mt-3">'+
            '<span>Buton Rengi</span>'+
            '</label>'+
            '<input type="text" class="form-control form-control w-75 p-3" name="button_colour'+currentVal+'">'+
            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+

            '<div class="fv-row mb-7 fv-plugins-icon-container ">'+
            '<label class="fs-6 fw-bold form-label mt-3">'+
            '<span>Buton Href</span>'+
            '</label>'+
            '<input type="text" class="form-control form-control w-75 p-3" name="button_href'+currentVal+'">'+
            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+


            '<div class="fv-row mb-7 fv-plugins-icon-container">'+
            '<label class="fs-6 fw-bold form-label mt-3">'+
            '<span>Sırasını Seçiniz</span>'+
            '</label>'+
            '<input id= "order" name="order'+currentVal+'" class="form-control form-control w-75 p-3" type="number" value="" '+
            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+


            '</div>'+


            '</div>'+

            '</div>'
        );


        $('.sliderimagedelete').click(function () {
            $("#sliderimage" + $(this).attr('data-src')).remove();
        })

        $('#lfm'+currentVal).filemanager('image');



    })



})
