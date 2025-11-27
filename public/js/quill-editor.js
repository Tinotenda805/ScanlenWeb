document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('[data-quill]').forEach(function (editor) {

        if (editor.__quill) return; // prevent double init

        const targetId = editor.dataset.target;
        const hiddenInput = document.getElementById(targetId);
        if (!hiddenInput) return;

        const quill = new Quill(editor, {
            theme: 'snow',
            placeholder: editor.dataset.placeholder || 'Start writing your content...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'video'],
                    ['clean']
                ]
            }
        });

        // Load existing content (edit mode)
        if (hiddenInput.value) {
            quill.root.innerHTML = hiddenInput.value;
        }

        editor.__quill = quill;

        const form = hiddenInput.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                hiddenInput.value = quill.root.innerHTML;
            });
        }
    });

});
