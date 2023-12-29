(function() {
    var HOST = "http://127.0.0.1:8000/"; //pass the route
    addEventListener("trix-file-accept", function(event) {
        // Prevent attaching .png files
        if (event.file.type === "application/pdf") {
            alert("Menambahkan pdf mungkin tidak terlihat langsung")
            event.preventDefault()
        }
      
        // Prevent attaching files > 1024 bytes
        if (event.file.size > 50000) {
            event.preventDefault();
            alert("File to large, max size 50mb")
        }
    })
    addEventListener("trix-attachment-add", function(event) {
        
        if (event.attachment.file) {
            uploadFileAttachment(event.attachment)
        }
    })

    addEventListener("trix-attachment-remove", async function (event) {
        const attachment = event.attachment;

        if (attachment.file) {
            const file = attachment.file;
            console.log(attachment.file.name);
            try {
                const response = await fetch(HOST + "destroy-trix", {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getMeta('csrf-token'),
                    },
                    body: JSON.stringify({
                        name: file.name,
                        size: file.size,
                        type: file.type
                    }),
                });
    
                if (response.ok) {
                    console.log('File deleted successfully.');
                } else {
                    console.error('Failed to delete file.');
                }    
            } catch (error) {
                console.error('Error while deleting file:', error);
            }
        }
    })
 
    function uploadFileAttachment(attachment) {
        uploadFile(attachment.file, setProgress, setAttributes)
 
        function setProgress(progress) {
            attachment.setUploadProgress(progress)
        }
 
        function setAttributes(attributes) {
            attachment.setAttributes(attributes)
        }
    }
 
    function uploadFile(file, progressCallback, successCallback) {
        var formData = createFormData(file);
        var xhr = new XMLHttpRequest();
         
        xhr.open("POST", HOST + "upload-trix", true);
        xhr.setRequestHeader( 'X-CSRF-TOKEN', getMeta( 'csrf-token' ) );
 
        xhr.upload.addEventListener("progress", function(event) {
            var progress = event.loaded / event.total * 100
            progressCallback(progress)
        })
 
        xhr.addEventListener("load", function(event) {
            var attributes = {
                url: xhr.responseText,
                href: xhr.responseText + "?content-disposition=attachment"
            }
            successCallback(attributes)
        })
 
        xhr.send(formData)
    }
 
    function createFormData(file) {
        var data = new FormData()
        data.append("Content-Type", file.type)
        data.append("file", file)
        return data
    }
 
    function getMeta(metaName) {
        const metas = document.getElementsByTagName('meta');
        
        for (let i = 0; i < metas.length; i++) {
            if (metas[i].getAttribute('name') === metaName) {
            return metas[i].getAttribute('content');
            }
        }
        
        return '';
    }

})();