
$(document).ready(function () {
    $('.servicesbutton').click(function (e) {
        e.preventDefault();

        var currentVal = parseInt($('#Hiddenservices').val());
        currentVal = currentVal + 1;
        $('#Hiddenservices').val(currentVal);
        $("#services_feedback").append(
            '<div id="serviceslist'+currentVal+'" class="mt-5 bg-light" style="border-radius:30px; padding: 10px;" >'+
            '<button data-src="'+currentVal+'" class="btn btn-icon btn-active-color-primary btn-sm me-1 serviceslistdelete">'+
            '<a  class="fa fa-trash">'+
            '</a>'+

            '</button>'+

            '<div class="d-flex">'+
            '<div class ="col-6 " >'+
            '<div  style="height:210px;" class=" d-flex justify-content-center align-items-center " id="holder'+currentVal+'">'+
            '<img  style="max-width:200px;" src="" >'+
            '</div>'+
            '<div class="input-group d-grid justify-content-center">'+
            '<div class="d-flex justify-content-center">'+
            '<span class="input-group-btn">'+
            '<a id="lfm'+currentVal+'" data-input="thumbnail'+currentVal+'" data-preview="holder'+currentVal+'" class="btn btn-primary">'+
            '<i class="fa fa-picture-o"></i> Select'+
            '</a>'+
            '</span>'+
            '</div>'+
            '<input id="thumbnail'+currentVal+'" class="form-control" type="hidden" name="filepath'+currentVal+'" value="">'+
            '</div>'+


            '</div>'+

            '<div class="col-6" style="text-align: -webkit-center">'+

            '<div class="fv-row mb-7 fv-plugins-icon-container justify-content-center" >'+
            '<label class="fs-6 fw-bold form-label">'+
            '<span>Link</span>'+
            '</label>'+
            '<input type="text" class="form-control form-control w-75 p-3" name="services_link'+currentVal+'">'+
            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+





            '<div class="fv-row mb-7 fv-plugins-icon-container justify-content-center" >'+
            '<label class="fs-6 fw-bold form-label">'+
            '<span>Başlık</span>'+
            '</label>'+
            '<input class="form-control form-control w-75 p-3" name="services_title'+currentVal+'">'+
            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+

            '<div class="fv-row mb-7 fv-plugins-icon-container ">'+
            '<label class="fs-6 fw-bold form-label ">'+
            '<span>Açıklama</span>'+
            '</label>'+
            '<input type="text" class="form-control form-control w-75 p-3" name="services_desc'+currentVal+'">'+

            '<div class="fv-plugins-message-container invalid-feedback"></div>'+
            '</div>'+

            '</div>'+

            '</div>'+

            '</div>'
        );


        $('.serviceslistdelete').click(function () {
            $("#serviceslist" + $(this).attr('data-src')).remove();
        })

        $('#lfm'+currentVal).filemanager('image');




    })



})
