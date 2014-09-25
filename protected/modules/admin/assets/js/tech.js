$(function () {
    $('body').on('click', '.add-element', function (e) {
        e.preventDefault();
        $('.elements').append('<div class="input-list"><input type="text" name="input-list[]" /><input type="hidden" name="list[]" /><a href="#" title="Удалить элемент" class="icon-remove delete-element"> </a></div>');
        return false;
    })
    $('body').on('click', '.input-list .delete-element', function (e) {
        e.preventDefault();
        $(this).parent().remove();
        return false;
    })

    $('.elements').sortable({

    });

    $('body').on('blur', '.elements .input-list input[type=text]', function () {
        $(this).replaceWith('<span>' + $(this).val() + '</span>');
    });
    $('body').on('click', function () {
        $('.elements .input-list input[type=text]').blur();
    });

    $('body').on('click', '.elements .input-list input[type=text]', function (e) {
        e.stopPropagation();
    });

    $('body').on('dblclick', '.elements .input-list span', function (e) {
        var parent = $(this).parent();
        var value = $.trim($(this).text());
        $(this).replaceWith('<input type="text" name="input-list[]" value="" />');
        parent.find('input[type=text]').focus();
        parent.find('input[type=text]').val(value);
    });
    $('body').on('keyup', '.elements .input-list input[type=text]', function () {
        $(this).parent().find('input[type=hidden]').val($.trim($(this).val()));
    });

});