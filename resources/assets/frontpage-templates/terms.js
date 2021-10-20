$(function(){
    $(document).on('click', '.terms-link', function(){
        gotoSection($(this).data('section'));
    });
});
window.gotoSection = function(section){
    let e = $('#terms-container');
    let hs = e.find('h3');
    let positions = {
        'terms-terms': hs.get(0) ? hs.get(0).offsetTop : 0,
        'terms-privacy-policy': hs.get(1) ? hs.get(1).offsetTop : 0,
        'terms-cookie-policy': hs.get(2) ? hs.get(2).offsetTop : 0,
        'refund-cancellation-policy': hs.get(3) ? hs.get(3).offsetTop : 0,
    };
    e.scrollTop(positions[section]);
};