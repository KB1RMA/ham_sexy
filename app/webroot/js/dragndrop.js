(function (window) {
    'use strict'

    var
        $ = window.jQuery;

    $(function () {

        var
            $dropbox = $('#dropbox'),
            $message = $('.message', $dropbox),
            $shade = $('#progress-shade'),
            $progress = $('#progress-bar');

        $dropbox.filedrop({
            paramname: 'image',
            maxfiles: 1,
            maxfilesize: 2,
            url: '/upload',
            uploadFinished: function (i, file, response) {
                $shade.fadeOut(200);
                // Redirect to their uploaded image
                if (response.error.code === 0) {
                    window.location.href = "/" + response.id.$id;
                } else {
                    alert(response.error.msg);
                }
            },
            error: function (err, file) {
                switch(err) {
                    case 'BrowserNotSupported':
                    showMessage('Your browser does not support HTML5 file uploads!');
                    break;
                case 'TooManyFiles':
                    alert('Too many files! Please select 5 at most! (configurable)');
                    break;
                case 'FileTooLarge':
                    alert(file.name+' is too large! Please upload files up to 2mb (configurable).');
                    break;
                default:
                    break;
                }
            },

            uploadStarted: function (i, file, len) {
                $shade.fadeIn(200);
            },

            progressUpdated: function (i, file, progress) {
                $.data(file);

                // Show progress of upload
                $progress.width(progress);
            }

        });

        var template = '<div class="preview">'+
                '<span class="imageHolder">'+
                  '<img />'+
                  '<span class="uploaded"></span>'+
                '</span>'+
                '<div class="progressHolder">'+
                  '<div class="progress"></div>'+
                '</div>'+
              '</div>';


        function showMessage(msg) {
            $message.html(msg);
        }

    });

})(this);
