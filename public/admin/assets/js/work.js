$(document).ready(function () {
    $('.bs-select').selectpicker('refresh');

    'use strict';
    $('.confirm').click(function () {
        event.preventDefault();
        const CONFIRM =  confirm('Are You Sure?');
        if(CONFIRM === true) {
            $(this).parent().find('#ClickSubmitForm, .ClickSubmitForm').submit();
        }
    });

    $('.confirmAjax').click(function (e) {
        e.preventDefault();
        const CONFIRM =  confirm('Are You Sure?');
        if(CONFIRM === true) {
            var This = $(this);
            var DataURL = This.attr('data-url');
            var Loading = $('.loading_request');
            $.ajax({
                url: DataURL,
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    Loading.show();
                },
                data: {'_token': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    Loading.hide();
                    if(data.status === true) {
                        This.parents('tr').remove();
                        location.reload();
                    }
                },
                error: function () {
                    location.reload();
                }
            });
        }
    });

    $('.confirm-btn').click(function () {
        return confirm('Are You Sure?');
    });

    // Check box select in table
    const roleSelect = $('#roleSelect');
    roleSelect.click(function () {
        const roleCheck = $('.roleCheck');
        if (roleSelect.prop('checked') === true) {
            roleCheck.prop('checked', true);
        } else {
            roleCheck.prop('checked', false);
        }
    });

    $('#discount_type').change(function () {
        $(".Equations_Price").each(function () {
            $(this).find(':input, select, textarea').val('');
        });
        const discountPresent = $('#discountPresent');
        const discountAmount = $('#discountAmount');
        if ($(this).val() === 'amount') {
            discountAmount.prop('disabled', false);
            discountAmount.parent().parent().parent().removeClass('hidden');
            discountPresent.prop('disabled', true);
            discountPresent.parent().parent().parent().addClass('hidden');
        } else {
            discountAmount.prop('disabled', true);
            discountAmount.parent().parent().parent().addClass('hidden');
            discountPresent.prop('disabled', false);
            discountPresent.parent().parent().parent().removeClass('hidden');
        }
    });

    const DisPresent = $('#discountPresent');
    const DisAmount = $('#discountAmount');
    const GetPrice = $('#getPrice');
    const DisRate = $('#discount_rate');
    const TotalPrice = $('#total_price');

    DisPresent.bind('keyup change', function () {
        var GetVal = Math.abs(DisPresent.val());
        DisPresent.val(GetVal);
        var Equation = GetPrice.val() * GetVal / 100;
        TotalPrice.val(Equation);
        DisRate.val(GetPrice.val() - Equation);
    });

    DisAmount.bind('keyup change', function () {
        var GetVal = Math.abs(DisAmount.val());
        DisAmount.val(GetVal);
        var Equation = GetPrice.val() - GetVal;
        TotalPrice.val(GetPrice.val() - Equation);
        DisRate.val(Equation);
    });

    // Cities & Districts
    $('.FormDistrictAdd').click(function () {
        $('.sub_content').find('input').val('');
        $('#FieldsForm').attr('action', $(this).val());
    });

    $('.FormDistrictEdit').click(function () {
        const Title = $(this).closest('tr').children('.titleDistrict');
        const TitleAr = $(this).closest('tr').children('.titleDistrictAr');
        const Color = $(this).closest('tr').children('.colorCategory');
        $('#FieldsForm').attr('action', $(this).val());
        $('#title').val(Title.val());
        $('#title_ar').val(TitleAr.val());
        $('#color').val(Color.val());
        $('#color').minicolors('value', Color.val());

    });

    // Warning Pending Seller
    $('#notic').pulsate({
        color: "#fbddd0"
    });

    $('.IntVal').bind('keyup change', function () {
        $(this).val(Math.abs($(this).val()));
    });

    const From = $('#from'), To = $('#to')
    To.bind('keyup change', function () {
        if(From.val() >= To.val()) {
            From.val(0);
            To.val(0);
        }
    });


    $('.preview_images, .open_img').magnificPopup({delegate: 'a.preview_img',type: 'image', gallery: {enabled: true}});
    $('.preview_images').magnificPopup({delegate: 'a', type: 'image', gallery: {enabled: true}});


    $('#checkMulti').click(function () {
        event.preventDefault();
        var CONFIRM =  confirm('Are You Sure?');
        if(CONFIRM === true) {
            $('.form').find('#form_multi').submit();
        }
    });
});