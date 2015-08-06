$(document).ready(function() {
    /* ActionBar Custom Elements */
    document.createElement('actionbar');
    document.createElement('calender');

    /* Window Custom Elements */
    document.createElement('window');
    document.createElement('toolbar');
    document.createElement('controls');
    document.createElement('divider');
    document.createElement('program');
    document.createElement('main');
    document.createElement('action');
    document.createElement('actionitem');

    /* SCREEN HEIGHT */
    $('body main').css('height', $(window).height() - $('actionbar').height() + 'px');

    /* CORE WINDOW COMMANDS */
    $('actionbar nav ul#program-icons li.actionBar-program-icon').click(function() {
        var programId = $(this).data('program-id');
        $(this).siblings().removeClass('engaged');
        $(this).toggleClass('engaged');
        if($('window[data-program-id="' + programId + '"]').length != 0) {
            $('window[data-program-id="' + programId + '"]').fadeToggle(150);
            // ^ Rework
        } else {
            $.post(
                "ajax/window.php",
                {
                    request: "open",
                    programId: programId,
                    rootDir: $(location).prop('pathname').split('/')[1]
                },
                function(data) {
                    $('body main').prepend(data).hide().fadeIn(150);
                    $('window[data-program-id="' + programId + '"]').draggable(
                        {
                            handle: "action",
                            containment: "main",
                            scroll: false,
                            cancel: "actionitem"
                        });
                    $('window[data-program-id="' + programId + '"]').resizable(
                        {
                            maxHeight: 600,
                            maxWidth: 1000,
                            minHeight: 400,
                            minWidth: 700,
                            containment: "parent",
                            handles: "e"
                        });
                    $('window[data-program-id="' + programId + '"]').css("left", ( $(window).width() - $('window[data-program-id="' + programId + '"]').width() ) / 2 + "px");
                    $('actionbar nav ul#program-icons li.actionBar-program-icon[data-program-id="' + programId + '"]').addClass('open');
                }
            );
        }
    }); // program icon click end

    /* On resize adjust draggable container */
    $(window).resize( function() {
        $('body main').css('height', $(window).height() - $('actionbar').height() + 'px');
        $("window").each( function() {
            $(this).css("left", ( $(window).width() - $(this).width() ) / 2 + "px");
            $(this).css("top", "50%");
        });
    });


    $(document).ajaxComplete(function(){
        $('window program action actionitem[data-command="minimise"]').click(function() {
            var programId = $(this).closest('window').data('program-id');
            $('window[data-program-id="' + programId + '"]').fadeToggle(150);
            $('actionbar nav ul#program-icons li.actionBar-program-icon[data-program-id="' + programId + '"]').removeClass('engaged');
        });
        $('window program action actionitem[data-command="close"]').click(function() {
            var programId = $(this).closest('window').data('program-id');
            $('window[data-program-id="' + programId + '"]').fadeOut(150, function() {
                $(this).remove();
            });
            $('actionbar nav ul#program-icons li.actionBar-program-icon[data-program-id="' + programId + '"]').removeClass('engaged open');
        });
    });

}); // document.ready end

//@prepros-append calender.js
