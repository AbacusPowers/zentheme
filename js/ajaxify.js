/**
 * Created by justin on 1/19/16.
 */
//no-conflict wrapper for jQuery's $ alias
(function($) {
    (function(window, undefined) {
        History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
            var state = History.getState().data;
            var modal = state.modal;
            var targetUrl = state.url;
            //If the modal should not be open, destroy the modal. This may occur when the modal is already hidden. That's fine.
            if (!modal) {
                //close modal
                destroyModal();
            } else {
                //Open modal referenced in state
                //If modal is visible, it means the wrong content is already in the modal
                if ($('#modal').is(':visible')) {
                    getModalContentByURL(targetUrl)
                }
                showModal(targetUrl, modal);
            }
        });
    })(window);

    function showModal(modalLink, state){
        if (state === undefined || $('#modal').is(':visible') ) {
            History.pushState({type:'modal', url: modalLink, modal: 1}, '', modalLink);
        }
        if(! $('#modal').is(':visible')){
            $('#overlay').show();
            $('#modal').show('scale',{duration: 300, easing:'easeOutCubic'});
            $('body').addClass('article-view');
        }

        //re-run Prism's code highlighter
        setInterval(function(){
            Prism.highlightAll();
        }, 500);
    }

    function destroyModal(pageLink, state){
        if (state) {
            History.pushState(null, '', pageLink);
        }
        $('#overlay').hide();
        $('#modal').hide('scale',{duration: 300, easing:'easeInCubic'});
        $('body').removeClass('article-view');

    }

    $(document).ready(function(){
        var state = History.getState().data;
        if (state.modal) {
            History.replaceState(null, null, null);
        }
    });

    function findPostIDFromLink(element) {
        var id = element.closest('article').attr('id').split('-')[1];

        return id;
    }

    $(document).on('click','.article-link', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var id = findPostIDFromLink($(this));

        if (href.includes('/project/')) {
            var actionType = 'ajax_get_project';
        } else {
            var actionType = 'ajax_get_post';
        }

        getModalContentByID(actionType, id);
        showModal(href);
    });
    $(document).on('click','.page-links a', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var id = findPostIDFromLink($(this));

        if (href.includes('/project/')) {
            var actionType = 'ajax_get_project';
        } else {
            var actionType = 'ajax_get_post';
        }

        getModalContentByID(actionType, id);
        showModal(href);
    });


    $(document).on('click','.gallery-item a', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');

        getModalContentByURL(href);
        showModal(href);
    });

    //uses WordPress ajax to query post and fill out template, then put template in modal
    function getModalContentByID(actionType, postId){
        console.log('getting');
        $('#modal').addClass('loading');

        $.ajax({
            url: ajaxification.ajaxurl,
            type: 'post',
            data: {
                action: actionType,
                post_id: postId,
                security: ajaxification.ajax_nonce
            },
            success: function (html) {
                $('#modal-content').html(html);
                document.title = $('#modal-content article .entry-header h1').text();
                console.log(ajaxification.ajax_nonce);
                $('#modal').removeClass('loading');
            }
        });
    }

    //uses jQuery .load() to grab page content from url
    function getModalContentByURL(articleUrl) {
        $('#modal').addClass('loading');
        $('#modal-content').load(articleUrl + ' #main', function (response, status, xhr) {
            document.title = $('#modal-content article .entry-header h1').text();

            $('#modal').removeClass('loading');
        });
    }

    $(document).on('click', '.article-view #close-modal', function (e) {
        console.log('close modal clicked');
        e.preventDefault();

        window.history.back();
    });
})(jQuery);
