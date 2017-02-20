/**
 * Created by pchotrani on 17/03/16.
 */

$(document).ready(function () {
    /* Parallax Scrolling */

    // Start listening for the user to scroll...

    $(window).scroll(function () {
        // Parallax the header with css3 tech
        if ($(window).width() > 1024) {
            $('.intro-text').css({
                transform: "translate(0px,-" + $(window).scrollTop() / 3 + "px)"
            });
        }
        else {
            $('.intro-text').css({
                display: "block"
            });
        }
    });

    /*Removing style attribute from caption class*/
    $("div.wp-caption").removeAttr("style");


    //Start of scroll script

    var $sections = $('.cd-section');

    // The user scrolls
    $(window).scroll(function () {

        // currentScroll is the number of pixels the window has been scrolled
        var currentScroll = $(this).scrollTop();

        // $currentSection is somewhere to place the section we must be looking at
        var $currentSection = $(this);

        // We check the position of each of the sections compared to the windows scroll positon
        $sections.each(function () {
            // sectionPosition is the position down the page in px of the current section we are testing
            var sectionPosition = $(this).offset().top;

            // the -1 is so that it includes the section 1px before the section leave the top of the window.
            if (sectionPosition - 1 < currentScroll) {
                // If the section has either been read or currently reading the section so we'll call it our current section
                $currentSection = $(this);
                // If the next section has also been read or we are currently reading it we will overwrite this value again. This will leave us with the LAST section that passed.
            }
            // This is the bit of code that uses the currentSection as its source of ID
            var id = $currentSection.attr("id");
            $('.cd-menu').removeClass('is-selected');
            $("[href=#" + id + "]").addClass('is-selected');
        })

    });

    /*Scroll to script*/
    $(".cd-menu").click(function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(link).offset().top
        }, 'slow');
    });


    /*END Scroll to script*/

    $("<div class='position-top-right'><span class='sprite icon-new-window'></span></div>").insertBefore(".wp-caption > a > img");

    /*Fade right navigation when reaches footer*/
    $(window).scroll(function () {
        if ($(window).scrollTop() + 600 > $(document).height() - $(window).height()) {
            jQuery('#cd-vertical-nav').fadeOut(1000);
        } else {
            $('#cd-vertical-nav').fadeIn(1000);
        }
    });


});