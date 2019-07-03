$().ready(() => {
    $("#countdown-eleicao")
            .countdown("2020/01/01", function (event) {
                $(this).text(
                        event.strftime('%D dias %H:%M:%S')
                        );
            });
});