$(function () {
  
    // Side Bar Toggle
    $('.hide-sidebar').click(function () {
        $('#sidebar').hide('fast', function () {
            $('#content').removeClass('span9');
            $('#content').addClass('span12');
            $('.hide-sidebar').hide();
            $('.show-sidebar').show();
        });
    });

    $('.show-sidebar').click(function () {
        $('#content').removeClass('span12');
        $('#content').addClass('span9');
        $('.show-sidebar').hide();
        $('.hide-sidebar').show();
        $('#sidebar').show('fast');
    });

    var fixHelper = function (e, ui) {
        ui.children().each(function () {
            $(this).width($(this).width());
        });
        return ui;
    };

    $(".slides tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/slides/saveorder?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();
    
    $(".documents tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/documents/saveorder?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();

    $(".menu tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/menu/saveorder?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();

    $(".conditions tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/conditions/saveorder?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();


//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------


    $("#management1 tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/management/saveorders?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();
    $(".projects tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/projects/saveorder?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();
    
    $("#example_vacancies tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/vacancies/saveorders?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();
    
    $("#example_successstories tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/successstories/saveorders?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();
    
    $("#example tbody").sortable({
        helper: fixHelper,
        update: function (event, ui) {
            var order = $(this).sortable("serialize");
            $.ajax({
                url: '/admin/tech/saveorders?' + order,
                data: {order: order},
                success: function (result) {
                }
            })
        }
    }).disableSelection();

//-----------------------------------------------------------------------------------


    $('body').on('click', '.add-pic', function (e) {
        e.preventDefault();
        $('.pics').append('<div><input type="file" name="img[]" /></div>');
        return false;
    })
    $('body').on('click', '.preview .delete-preview', function (e) {
        e.preventDefault();
        var _this = $(this);
        _this.parent().remove();
         return false;
    })

    $('body').on('click', '.title .delete-preview', function (e) {
        e.preventDefault();
        var _this = $(this);
        _this.parent().remove();
        return false;
    })

    $('body').on('click', '.preview .delete-pic', function (e) {
        e.preventDefault();
        var _this = $(this);
        var deleteId = $(this).attr('id');
        $.ajax({
            url: '/admin/projects/deletepic',
            data: {pic_id: deleteId},
            type: 'post',
            success: function (result) {
                _this.parent().remove();
            }
        })
        return false;
    })
    $('body').on('click', '.multi-switch', function(e) {
        e.preventDefault();
        var select = $(this).parent().find('select');
        if (select.attr('multiple') !== undefined) {
            select.removeAttr('multiple');
        } else {
            select.attr('multiple', 'multiple');
        }

        return false;
    })

    $('.itemTag').click(function(){
        var title = $(this).html();
        var parseTags =  $('#Projects_tags').val();
        if(parseTags.indexOf(title) + 1) {
            parseTags = parseTags.replace(title+', ','');
            $('#Projects_tags').val(parseTags);
        }else{
            $('#Projects_tags').val(parseTags + title + ', ');
        }


    });
});

function openTagsList() {
    $('#tagsList').css('display','block');
    $('#clickTag').attr('onclick','closeTagsList()');
    $('#clickTag').html('Close');
}

function closeTagsList() {
    $('#tagsList').css('display','none');
    $('#clickTag').attr('onclick','openTagsList()');
    $('#clickTag').html('Open');
}

