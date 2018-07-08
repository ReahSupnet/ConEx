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