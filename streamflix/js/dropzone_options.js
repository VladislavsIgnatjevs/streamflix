$(document).ready(function () {
    Dropzone.autoDiscover = false;


    var myDropzone = new Dropzone("#dZUpload",{
        url: "/uploader.php",
        addRemoveLinks: true,
        uploadMultiple: false,
        autoProcessQueue: false,
        dictDefaultMessage: "Hooray! We are set and ready! Drop files here to upload!",
        dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
        dictInvalidFileType: "You can't upload files of this type. MP4 files are allowed only",
        dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
        maxFiles: 1,
        dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
        acceptedMimeTypes: "video/mp4",
        dictResponseError: "Server responded with {{statusCode}} code.",
        dictCancelUpload: "Cancel upload",
        dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
        parallelUploads: 1,
        maxFilesize: 1024, // MB
        success: function (file, response) {
            file.previewElement.classList.add("dz-success");
            console.log("Successfully uploaded.");
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        },

    });

    $('#submitButton').click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        if ($('#title').val() != '') {
            myDropzone.processQueue();
        } else {
            $('#success-upload').css('display','none');
            $('#error-upload').css('display','block').text('Please enter video title');
            myDropzone.removeAllFiles(true);
        }
});

        myDropzone.on("sending", function(file, xhr, formData) {
            var name = 'upload_'+ (new Date()).getTime();
            formData.append(name, file);
        });

    myDropzone.on("complete", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            $('#error-upload').css('display','none');
            $('#video_title').val($('#title').val());
            $('#video_description').val($('#desc').val());


            $('#file_name').val(myDropzone.files[0].name);


            document.forms["uploadVideoForm"].submit();

        }
    });


});



