const autosize = require('autosize');
autosize(document.querySelector('textarea'));

tail.select(".tail-select", {
    placeholder: "Select Post Categories...",
    search: true,
    
});

$('#content').summernote({
    placeholder: 'Content',
    tabsize: 2,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['picture', 'video', 'link', 'hre']],
        ['misc', ['codeview']]
    ]
});