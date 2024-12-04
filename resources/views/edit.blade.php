<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
</head>
<body>

<div id="onlyoffice-editor" style="width: 100%; height: 600px;"></div>
<script type="text/javascript" src="https://cdn.onlyoffice.com/DocumentEditor.js"></script>
<script type="text/javascript">
    var docEditor = new DocsAPI.DocEditor("onlyoffice-editor", {
        "width": "100%",
        "height": "600px",
        "document": {
            "title": "fdsfasfsa", // Ensure $filename is set properly
            "url": "http://127.0.0.1:8000/edit/B5VbtlTKIFjhZSlljCGnOHVvnZ2TIEAYeLUmk2cr.docx",     // Ensure $fileUrl is a valid URL
            "fileType": "docx",         // Ensure this matches the uploaded file type
            "key": "unique_document_key" // Generate a unique key for each document
        },
        "editorConfig": {
            "callbackUrl": "{{ route('doc.callback') }}", // Ensure this route is correct
            "lang": "en",
            "region": "us"
        }
    });
</script> 
</body>
</html>