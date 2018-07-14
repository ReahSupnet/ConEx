function showEditSection(id) {
    $("#actual_post_" + id).hide();
    CKEDITOR.replace("article-ckeditor_" + id);
    CKEDITOR.instances["article-ckeditor_" + id].setData($("#post_content_" + id).html());
    $("#edit_post_" + id).show();
    $("#create_post").hide();
};

function hideEditSection(id) {
    $("#actual_post_" + id).show();
    $("#edit_post_" + id).hide();
    $("#create_post").show();
}

function confirmPostDelete(post_id, thread_id) {
    if (confirm('Are you sure you want to delete this post?')) {
        $.ajax({
            dataType : 'json',
            type : 'DELETE',
            url : '/post/' + post_id,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).always(function() {
            window.location.href = "/thread/" + thread_id;
        });
    };
}

function postVoteUp(post_id, user_id) {
    $.ajax({
        dataType : 'json',
        type : 'PUT',
        url : '/post/' + post_id + '/vote_up',
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'user_id' : user_id },
        success: function(data){
            if (data["saved"] == true) {
                // Update count in UI
                var count = parseInt($("#post_" + post_id + "_up").text());
                $("#post_" + post_id + "_up").text(count + 1);
            }
        }
    });
}

function postVoteDown(post_id, user_id) {
    $.ajax({
        dataType : 'json',
        type : 'PUT',
        url : '/post/' + post_id + '/vote_down',
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'user_id' : user_id },
        success: function(data){
            if (data["saved"] == true) {
                // Update count in UI
                var count = parseInt($("#post_" + post_id + "_down").text());
                $("#post_" + post_id + "_down").text(count + 1);
            }
        }
    });
}

function threadVoteUp(thread_id, user_id) {
    $.ajax({
        dataType : 'json',
        type : 'PUT',
        url : '/thread/' + thread_id + '/vote_up',
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'user_id' : user_id },
        success: function(data){
            if (data["saved"] == true) {
                // Update count in UI
                var count = parseInt($("#thread_" + thread_id + "_up").text());
                $("#thread_" + thread_id + "_up").text(count + 1);
            }
        }
    });
}

function threadVoteDown(thread_id, user_id) {
    $.ajax({
        dataType : 'json',
        type : 'PUT',
        url : '/thread/' + thread_id + '/vote_down',
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'user_id' : user_id },
        success: function(data){
            if (data["saved"] == true) {
                // Update count in UI
                var count = parseInt($("#thread_" + thread_id + "_down").text());
                $("#thread_" + thread_id + "_down").text(count + 1);
            }
        }
    });
}

function confirmCategoryDelete(category_id) {
    if (confirm('Are you sure you want to delete this category?')) {
        $.ajax({
            dataType : 'json',
            type : 'DELETE',
            url : '/category/' + category_id,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).always(function() {
            window.location.href = "/thread";
        });
    };
}
