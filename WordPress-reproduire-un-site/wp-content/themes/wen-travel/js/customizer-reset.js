jQuery(function(s) {
    var e = [
        ["#customize-theme-controls", "all", "ct-reset", "ct-reset-main", wen_travelCustomizerReset.confirm, wen_travelCustomizerReset.reset],
        ["#_customize-input-wen_travel_footer_copyright_text", "footer_options", "ct-footer-reset", "ct-reset-section", wen_travelCustomizerReset.confirmSection, wen_travelCustomizerReset.resetSection]
    ];
    s.each(e, function(e, o) {
        var t = s(o[0]),
            c = s('<input type="submit" name="' + o[2] + '" id="' + o[2] + '" class="ct-reset ' + o[3] + ' button-secondary button">').attr("value", o[5]);
        c.on("click", function(e) {
            e.preventDefault();
            var t = {
                wp_customize: "on",
                action: "wen_travel_customizer_reset",
                nonce: wen_travelCustomizerReset.nonce.reset,
                section: o[1]
            };
            confirm(o[4]) && (s(".spinner").css("visibility", "visible"), c.attr("disabled", "disabled"), s.post(ajaxurl, t, function() {
                wp.customize.state("saved").set(!0), location.reload()
            }))
        }), t.after(c)
    })
});
