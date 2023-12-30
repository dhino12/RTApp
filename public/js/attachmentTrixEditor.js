(function() {
    var HOST = "http://127.0.0.1:8000/"; //pass the route
    addEventListener("trix-file-accept", function(event) {
        // Prevent attaching .png files
        if (event.file.type === "application/pdf") {
            // alert("Menambahkan pdf mungkin tidak terlihat langsung")
            // event.preventDefault()/
        }
      
        /**
         * Prevent attaching files > 1024 bytes
         * Convert MB to Bytes
         * https://www.coolstuffshub.com/id/penyimpanan-data/mengkonversi/megabyte-ke-byte/
         */
        if (event.file.size > 50_000_000) {
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
            if (attributes.type == 'application/pdf') {
                attachment.setAttributes({ 
                    content: `<iframe src="${attributes.href}" onerror="" frameborder="0" allowfullscreen class="w-full h-[66vh]"></iframe>`,
                    ...attributes,
                });
            } else {
                attachment.setAttributes(attributes);
            }
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
                href: xhr.responseText + "?content-disposition=attachment",
                type: file.type
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

    /**
     * Embed video / file pdf
     */
    const button = document.createElement('button')
    button.innerText = "embed"
    button.id = "embedVideo"
    button.setAttribute('class', 'text-black border border-slate-600 px-2 py-1 mt-2')
    document.querySelector(".trix-dialog__link-fields").insertAdjacentElement('afterend', button);
    document.querySelector("#embedVideo").addEventListener('click', (e) => {
        e.preventDefault();
        const inputLink = document.querySelector('input.trix-input--dialog').value
        let link = ''

        if (inputLink.includes('youtu')) {
            let videoMatch = inputLink.match(/[?&]v=([^&]+)/);
            videoMatch = videoMatch ? videoMatch[1] : inputLink.split('/')[inputLink.split('/').length - 1];
            link = `https://www.youtube.com/embed/${videoMatch}`
        } 
        if (inputLink.includes('drive.google.com')) {
            link = `https://drive.google.com/file/d/${inputLink.match(/\/file\/d\/(.+?)\//)[1]}/preview`
        }
        
        const attachment = new Trix.Attachment({content: `<iframe src="${link}" frameborder="0" allowfullscreen class="w-full h-[66vh]"></iframe>`});
        document.querySelector('trix-editor').editor.insertAttachment(attachment);

        document.querySelector("#embedVideo").classList.add('bg-lime-500')
        setTimeout(() => {
            document.querySelector("#embedVideo").classList.remove('bg-lime-500')
        }, 2000);
    })
})();