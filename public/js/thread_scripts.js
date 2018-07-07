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
