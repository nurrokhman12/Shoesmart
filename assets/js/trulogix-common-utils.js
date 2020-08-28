var trulogix = {
    /* main menu utility */
    appxmenu : function(idxmod){
        var modidx = idxmod;
        trulogix.appxmenufocus(modidx);
        var widgettoload = "modules/content_loader.php?moduleidx="+modidx+"";
        $("#appx_content").empty();
        $("#appx_content").load(widgettoload);
    },
    /* handle focus/blur main menu */
    appxmenufocus : function(targetfocus){
        $("#appx-menu-container ul li[class!='divider-vertical']").removeClass().addClass('appxlink');
        $("#appx-menu-container ul li a[id="+targetfocus+"]").parent("li").addClass('active');
    },
    /* handle user's menu */
    appxusermenu : function(idxumod){
        var umodidx = idxumod;
        var uwidgettoload = "modules/content_loader.php?moduleidx="+umodidx+"";
        $("#appx_content").empty();
        $("#appx_content").load(uwidgettoload);
        $("#appx-menu-container ul li[class!='divider-vertical']").removeClass().addClass('appxlink');
    },
    /* handle parse date for mysql DATE-ready */
    appxparsedate : function(inputdate,optx){
        return false;
    }
}