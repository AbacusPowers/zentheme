/**
 * Created by justin on 11/15/15.
 */

function find_post_id(element) {
    var id = element.closest('article').attr('id').split('-')[1];
    console.log('post: ' + id);
    return id;
}

function ajax_get_post(id, callback){
    jQuery.ajax({
        url: ajaxpagination.ajaxurl,
        type: 'post',
        data: {
            action: 'ajax_get_post',
            post_id: id
        },
        success: callback(html)
    });
}

