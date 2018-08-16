(function (d, s, id) {
    var facebookClientId = $('#fb-root').data('facebookClientId');
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9&appId=" + facebookClientId;
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));