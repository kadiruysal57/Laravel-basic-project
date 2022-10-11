$(document).ready(function () {
    $('.commentsbutton').click(function (e) {
        e.preventDefault();

        var currentVal = parseInt($('#Hiddencomments').val());
        currentVal = currentVal + 1;
        $('#Hiddencomments').val(currentVal);
        $("#comments_feedback").append(
            '<div id="commentslist' + currentVal + '" class="mt-5 bg-light" style="border-radius:30px; padding: 10px;" >' +
            '<button data-src="' + currentVal + '" class="btn btn-icon btn-active-color-primary btn-sm me-1 commentslistdelete">' +
            '<a  class="fa fa-trash">' +
            '</a>' +

            '</button>' +

            '<div class="d-flex">' +
            '<div class ="col-6 " >' +
            '<div  style="height:210px;" class=" d-flex justify-content-center align-items-center " id="holder' + currentVal + '">' +
            '<img  style="max-width:200px;" src="" >' +
            '</div>' +
            '<div class="input-group d-grid justify-content-center">' +
            '<div class="d-flex justify-content-center">' +
            '<span class="input-group-btn">' +
            '<a id="lfm' + currentVal + '" data-input="thumbnail' + currentVal + '" data-preview="holder' + currentVal + '" class="btn btn-primary">' +
            '<i class="fa fa-picture-o"></i> Select' +
            '</a>' +
            '</span>' +
            '</div>' +
            '<input id="thumbnail' + currentVal + '" class="form-control" type="hidden" name="filepath' + currentVal + '" value="">' +
            '</div>' +


            '</div>' +

            '<div class="col-6" style="text-align: -webkit-center">' +

            '<div class="fv-row mb-7 fv-plugins-icon-container justify-content-center" >' +
            '<label class="fs-6 fw-bold form-label">' +
            '<span>Yorum Yapanın İsmi</span>' +
            '</label>' +
            '<input type="text" class="form-control form-control w-75 p-3" name="comments_name' + currentVal + '">' +
            '<div class="fv-plugins-message-container invalid-feedback"></div>' +
            '</div>' +


            '<div class="fv-row mb-7 fv-plugins-icon-container justify-content-center" >' +
            '<label class="fs-6 fw-bold form-label">' +
            '<span>Yorum Yapanın Mesleği</span>' +
            '</label>' +
            '<input class="form-control form-control w-75 p-3" name="comments_job_title' + currentVal + '">' +
            '<div class="fv-plugins-message-container invalid-feedback"></div>' +
            '</div>' +

            '<div class="fv-row mb-7 fv-plugins-icon-container ">' +
            '<label class="fs-6 fw-bold form-label ">' +
            '<span>Yorum</span>' +
            '</label>' +
            '<input type="text" class="form-control form-control w-75 p-3" name="comments' + currentVal + '">' +

            '<div class="fv-plugins-message-container invalid-feedback"></div>' +
            '</div>' +

            '<div class="fv-row mb-7 fv-plugins-icon-container w-75">' +
            '<label class="fs-6 fw-bold form-label ">' +
            '<span>Puan</span>' +
            '</label>' +
            '<select name="rate' + currentVal + '" class="form-control" tabindex="-98">' +
            '<option>Lütfen Yorum Puanını Seçiniz</option>' +
            '<option value="5">5</option>' +
            '<option value="4.5">4.5</option>' +
            '<option value="4">4</option>' +
            '<option value="3.5">3.5</option>' +
            '<option value="3">3</option>' +
            '</select>' +

            '<div class="fv-plugins-message-container invalid-feedback"></div>' +
            '</div>' +
            '<div class="fv-row mb-7 fv-plugins-icon-container ">\n' +
            '                                                    <label class="fs-6 fw-bold form-label ">\n' +
            '                                                        <span>Sıra</span>\n' +
            '                                                    </label>\n' +
            '                                                    <input type="number" class="form-control form-control w-75 p-3" value="0" name="comments_order'+currentVal+'">\n' +
            '                                                    <div class="fv-plugins-message-container invalid-feedback"></div>\n' +
            '                                                </div>'+

            '</div>' +

            '</div>' +

            '</div>'
        );


        $('.commentslistdelete').click(function () {
            $("#commentslist" + $(this).attr('data-src')).remove();
        })

        $('#lfm' + currentVal).filemanager('image');


    })


})
