$(function() {
    $(' .setHome ').click(function() {
        try
        {
            this.style.behavior='url(#default#homepage)';
            this.setHomePage(window.location);
        }
        catch(e){
            alert('in');
            if(window.netscape) {
                try {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                }
                catch (e) {
                    alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将[signed.applets.codebase_principal_support]设置为'true'");
                }
                var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                prefs.setCharPref('browser.startup.homepage',window.location);
            }
        }
    });

    $(' .addFavorite ').click(function() {
        var sTitle = $(' .text-center ').text();
        var sURL = window.location;
        try
        {
            window.external.addFavorite(sURL, sTitle);
        }
        catch (e)
        {
            try
            {
                window.sidebar.addPanel(sTitle, sURL, "");
            }
            catch (e)
            {
                alert("加入收藏失败，请使用Ctrl+D进行添加");
            }
        }
    });
});