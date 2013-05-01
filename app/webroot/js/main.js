(function (window) {

    var
        $ = window.jQuery,
        $window = $(window),
        $doc = $(document);


    function photoComment() {
        $('#comment-form').submit(function () {
            var
                $this = $(this),
                $comments = $('.comments'),
                url = $this.attr('action'),
                data = $this.serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: data
            })
                .done(function (data) {
                    //$comments.empty();
                    var html;

                    $.each(data.sexies.comments, function (id, sexy) {
                        html = html + "<li>";
                        html = html + sexy.content;
                        html = html + '<abbr class="date timeago">' + sexy.createdAt + "</abbr>";
                        html = html + "</li>";
                    });
                    $comments.html(html);
                })
            ;

            return false;
        });

    }

    function init() {
        var
            foundationOptions = {
                animation: 'fade',
                animationSpeed: 100
            };

        $doc.foundation('reveal', foundationOptions);

        $('.timeago').timeago();

        photoComment();
    }

    $(function () {
        init();
    });

}(window));
