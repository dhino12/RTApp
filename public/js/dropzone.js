Dropzone.options.myGreatDropzone = {
    autoProcessQueue: false,
    paramName: "file", // The name that will be used to transfer the file
    acceptedFiles: '.png,.jpg,.gif,.bmp,.jpeg,.pdf',
    init: function () {
        const submitButton = document.querySelector('#submit');
        myDropzone = this;
        submitButton.addEventListener('click', function () {
            myDropzone.processQueue();
        })

        this.on('complete', function () {
            if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
            {
                var _this = this;
                _this.removeAllFiles();
            }
        })
    }
};
