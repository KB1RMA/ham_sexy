(function (window) {

    var
        $ = window.jQuery,
        $window = $(window),
        $doc = $(document);

    function init() {
        var
            foundationOptions = {
                animation: 'fade',
                animationSpeed: 100
            };
        $doc.foundation('reveal', foundationOptions);
    }

    $(function () {
        init();
    });

}(window));
