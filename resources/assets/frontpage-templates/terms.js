$(function () {
    $(document).on('click', '.terms-link', function () {
        gotoSection($(this).data('section'));
    });
});
window.gotoSection = function (section) {
    let e = $('#terms-container');

    let positions = 0
    let fs = section?.replace("terms-", '')
    if (fs) {
        let hs = e.find('#' + fs);
        if (hs.get(0)) {
            positions = hs.get(0).offsetTop
        }
    }
    e.scrollTop(positions);
};