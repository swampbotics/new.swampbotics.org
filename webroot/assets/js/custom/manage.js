/*
 *  ====================== UPDATE EVENT ======================
 */

$('input[name=season]').keyup(function() {
    $('.event-season').empty().append($(this).val());
});

$('input[name=name]').keyup(function() {
    $('.event-name').empty().append($(this).val());
});

$('form[name=event-form]').submit(function(e) {
    e.preventDefault();
    var postData = $(this).serialize();
    var button = $(this).find('button[type=submit]');
    var formMessage = $(this).find('.form-message');
    button.addClass('btn-loading');
    formMessage.fadeOut().empty().removeClass('error success');
    $.post('manage/home?type=update', postData, "json")
        .done(function(data) {
            formMessage.addClass(data.type).append(data.text).fadeIn();
            button.removeClass('btn-loading');
        });
});

$('.btn-back').click(function(e){
    e.preventDefault();
    window.location.replace((window.location.href).replace((window.location.pathname).split("/").pop(), ''));
});

$('.btn-delete').click(function(e){
    e.preventDefault();
    $(this).addClass('btn-loading');
    var result = window.confirm('Are you sure you want to delete this event?');
    if(result){
        var postData = $('form[name=event-form]').serialize();
        var formMessage = $('form[name=event-form]').find('.form-message');
        formMessage.fadeOut().empty().removeClass('error success');
        $.post('manage/home?type=delete', postData, "json")
            .done(function(data) {
                formMessage.addClass(data.type).append(data.text).fadeIn();
                $('.btn-delete').removeClass('btn-loading');
                setTimeout(function() {
                    window.location.replace((window.location.href).replace((window.location.pathname).split("/").pop(), ''));
                }, 1000);
            });
    } else {
        $(this).removeClass('btn-loading');
    }
});


/*
 *  ====================== ADD EVENT ======================
 */

$('.btn-show-form').click(function(e){
    e.preventDefault();
    $('.add-event-form').slideToggle();
});

$('form[name=add-event-form]').submit(function(e) {
    e.preventDefault();
    var postData = $(this).serialize();
    var button = $(this).find('button[type=submit]');
    var formMessage = $(this).find('.form-message');
    button.addClass('btn-loading');
    formMessage.fadeOut().empty().removeClass('error success');
    var result = window.confirm('Are you sure you want to add this event?');
    if(result){
        $.post('manage/home?type=add', postData, "json")
            .done(function(data) {
                formMessage.addClass(data.type).append(data.text).fadeIn();
                button.removeClass('btn-loading');
                setTimeout(function(){
                    location.reload();
                }, 1000);
            });
    } else {
        button.removeClass('btn-loading');
    }
});

/*
 *  ====================== LOGIN ======================
 */

$('#password').keyup(function() {
    // TOGGLE SUBMIT BUTTON
    if ($(this).val().length == 6) {
        $('button[type=submit]').removeClass('disabled');
    } else {
        $('button[type=submit]').addClass('disabled');
    }
    // TOGGLE GENERATE BUTTON
    if ($(this).val().length == 0) {
        $('.btn-generate').removeClass('disabled');
    } else {
        $('.btn-generate').addClass('disabled');
    }
});

$('form[name=login-form]').submit(function(e) {
    e.preventDefault();
    var postData = $(this).serialize();
    if ($('input[type=password]').val() > 0) {
        // PERFORM LOGIN
        $.post('manage/login', postData, "json")
            .done(function(data) {
                $('.form-message').empty().removeClass('error success').addClass(data.type).append(data.text);
                if (data.type == "success") {
                    setTimeout(function() {
                        window.location.replace("/manage/home");
                    }, 1000);
                }
            });

    } else {
        // PERFORM GENERATE
        $.post('manage/login?type=generate', postData, "json")
            .done(function(data) {
                $('.form-message').empty().removeClass('error success').addClass(data.type).append(data.text);
            });
    }
});
