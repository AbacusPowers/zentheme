/**
 * Created by justin on 11/15/15.
 * This file is not being used because of issues with history.js stuff.
 */


window.showModal = function(){
    jQuery('#overlay').show();
    jQuery('#modal').show('scale',{duration: 300, easing:'easeOutCubic'});
    jQuery('body').addClass('article-view');
    jQuery('#modal-wrapper').addClass('article');
    //re-run Prism's code highlighter
    Prism.highlightAll();
};
window.destroyModal = function(){
    jQuery('#overlay').hide();
    jQuery('#modal').hide('scale',{duration: 300, easing:'easeInCubic'});
    jQuery('#offsite-modal').hide();
    jQuery('body').removeClass('article-view');
};
(function($) {


    $(document).ready(function(){
        var href = window.location.href;
        var title = document.getElementsByTagName("title")[0].innerHTML;

        //History.pushState(null, null, href);
    });

    manualStateChange = false; //false if using browser navigation (back and forward). must be set to true prior to any click-triggered event

    (function(window, undefined) {
        History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
            var state = History.getState();
            var targetUrl = state.url;
            var origin = state.data.close;
            var originType = state.data.origin;
            var modal = History.getState().data.modal;
            var currentUrl = window.location.href;
            console.log('target url = ' + targetUrl);
            console.log('modal = ' + modal);

            //if we're going back to an article, load the modal on

            //if(targetUrl === origin) {
            //    $('#close-modal').click();
            //}
            //if (origin) {
            //if ( modal !== 1){
            //    console.log("no modal. close the modal.");
            //    $('#close-modal').click();
            //    //window.location.href = targetUrl;
            //    //    console.log('ping');
            //} else if (manualStateChange === false ) {
            //    var body = $('body');
            //    console.log('modal time!');
            //    //detect post type and load content
            //    //run ajax_get_post or ajax_get_project
            //    if ( body.hasClass('post-type-archive-project') ) {
            //        //load the project into the modal
            //        console.log("I'm a project");
            //        if ( !/\S/.test($('#modal-content').html()) ) {
            //            console.log('modal is empty');
            //            $.get( targetUrl, function( data ){
            //                //console.log(data);
            //                var $page = $(data);
            //                var $article = $page.find('#main > article.type-project');
            //                var idID = $article.attr('id');
            //                var projectId = idID.substring(5);
            //                ajax_get_project(targetUrl, currentUrl, "page", projectId, true);
            //
            //            });
            //        }
            //    } else if (body.hasClass('blog')) {
            //        console.log("I'm a post");
            //        $.get( targetUrl, function( data ){
            //            var $page = $(data);
            //            var $article = $page.find('#main > article.type-post');
            //            var idID = $article.attr('id');
            //            var postId = idID.substring(5);
            //            ajax_get_post(targetUrl, currentUrl, "page", postId, true);
            //        });
            //    }
            //
            //    showModal();
            //}
            manualStateChange = false;

            //}
            //if(History.getState().data.modal !== 1 && state.data.origin === "page" && origin) {
            //    //go to the page
            //    window.location.href = origin;
            //} else if (History.getState().data.modal !== 1 && state.data.origin !== "page"){
            //    $('#close-modal').click();
            //    console.log('ping');
            //} else if (History.getState().data.modal === 1) {
            //    console.log(History.getState().data.modal);
            //    showModal();
            //}

        });
    })(window);

    $(document).keyup(function(e) {
        if (e.keyCode == 27) $('#close-modal').click();   // esc
    });

    $(document).mouseup(function (e)
    {
        var container = $("#modal",'.article-view');

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('#close-modal').click();
        }
    });


    function ajax_get_post(href, originUrl, originType, id, addEntry){
        $.ajax({
            url: ajaxpagination.ajaxurl,
            type: 'post',
            data: {
                action: 'ajax_get_post',
                post_id: id
            },
            success: function (html) {
                $('#modal-content').html(html);
                var newTitle = $('#modal-content article .entry-header h1').text();
                document.title = newTitle;
                console.log('------> ' + originUrl);
                $('#close-modal').attr('href',originUrl);

                // Add History Entry using pushState
                if ( addEntry === true ) {
                    History.pushState({ modal : 1, origin : originType, close : originUrl }, newTitle, href);
                }
                $('#modal').removeClass('loading');
            }
        });
    }
    function ajax_get_project(href, originUrl, originType, id, addEntry){
        $.ajax({
            url: ajaxpagination.ajaxurl,
            type: 'post',
            data: {
                action: 'ajax_get_project',
                post_id: id
            },
            error: function(request, status, error) {
              console.log(status, error);
            },
            success: function (html) {
                $('#modal-content').html(html);
                var newTitle = $('#modal-content article .entry-header h1').text();

                document.title = newTitle;
                $('#close-modal').attr('href',originUrl);

                // Add History Entry using pushState
                if ( addEntry === true ) {
                    History.pushState({ modal : 1, origin : originType, close : originUrl }, newTitle, href);
                }
                $('#modal').removeClass('loading');
            }
        });
    }
    $(document).on('click','.article-link', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var originUrl = document.URL;
        var originType = 'page';
        console.log(originUrl);
        $('#modal').addClass('loading');

        var id = find_post_id($(this));

        manualStateChange = true;
        ajax_get_post(href, originUrl, originType, id, true);
        window.showModal();
    });
    $(document).on('click','.project-link', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var originUrl = document.URL;
        var originType = 'page';
        console.log('origin url = ' + originUrl);

        $('#modal').addClass('loading');

        var id = find_post_id($(this));

        manualStateChange = true;
        ajax_get_project(href, originUrl, originType, id, true);
        window.showModal();
    });

    $(document).on('click', '.article-view #close-modal', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        window.destroyModal();

        //var rewrite = History.getState().data.close;
        History.pushState(null, null, href);

    });

})(jQuery);

