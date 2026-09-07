tinymce.init({

        selector: 'textarea.materialize-textarea',

        menubar: false,
        plugins: [
            'advlist', 'anchor', 'autolink', 'charmap', 'code', 'fullscreen',
            'help', 'image', 'insertdatetime', 'link', 'lists', 'media',
            'preview', 'searchreplace', 'table', 'visualblocks', 'wordcount', 'emoticons'
        ],
        toolbar: 'undo redo | styles | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | emoticons | code | fullscreen | help',

        height: 300,
        setup(editor) {

            editor.on("change keyup", function() {
                editor.save();
                generateItinerary();
            });

        },
        content_style: `

        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');

        body {

            font-family: 'Roboto Condensed', sans-serif;

        }

    `

    });