/**
 * Created by justin on 11/15/15.
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





    (function(window, undefined) {
        History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
            //if ($('#article-page-marker').length > 0) { //detect if this is a dummy page
            var state = History.getState();
            var url = state.url;
            var origin = state.data.close;
            console.log(url);
            console.log(origin);
            if(url === origin) {
                $('#close-modal').click();
            }
            if(History.getState().data.modal !== 1) {
                $('#close-modal').click();
                console.log('ping');
            } else if (History.getState().data.modal === 1) {
                showModal();
            }

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

    function find_post_id(element) {
        var id = element.closest('article').attr('id').split('-')[1];
        console.log('post: ' + id);
        return id;
    }
    function ajax_get_post(href, originUrl, originType, id){
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
                History.pushState({ modal : 1, origin : originType, close : originUrl }, newTitle, href);
                $('#modal').removeClass('loading');
            }
        });
    }
    function ajax_get_project(href, originUrl, originType, id){
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
                console.log('------> ' + originUrl);
                $('#close-modal').attr('href',originUrl);

                // Add History Entry using pushState
                History.pushState({ modal : 1, origin : originType, close : originUrl }, newTitle, href);
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
        ajax_get_post(href, originUrl, originType, id);
        window.showModal();
    });
    $(document).on('click','.project-link', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var originUrl = document.URL;
        var originType = 'page';
        console.log(originUrl);
        $('#modal').addClass('loading');

        var id = find_post_id($(this));
        ajax_get_project(href, originUrl, originType, id);
        window.showModal();
    });

    $(document).on('click', '.article-view #close-modal', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        window.destroyModal();

        //var rewrite = History.getState().data.close;
        History.pushState(null, null, href);

    })

})(jQuery);

