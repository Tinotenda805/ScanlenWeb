
document.addEventListener('DOMContentLoaded', function() {
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link'],
                ['clean']
            ]
        },
        placeholder: 'Start writing your content...'
    });
    
    // Set initial content
    quill.root.innerHTML = document.querySelector('#content').value;
    
    // Update textarea on content change
    quill.on('text-change', function() {
        document.querySelector('#content').value = quill.root.innerHTML;
    });
    
    // Ensure content is updated before form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            document.querySelector('#content').value = quill.root.innerHTML;
        });
    }
});
