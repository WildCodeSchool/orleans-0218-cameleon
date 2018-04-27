$(document).ready(function() {
    $('#spotlight-text').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['paragraph', ['paragraph']]
        ]
    });
});