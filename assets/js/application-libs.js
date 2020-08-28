!function ($){
    $(function(){
        $("#appx-menu ul li:first").addClass("active");
        $("#appx_content").load("modules/content_loader.php?moduleidx=default");
        $("#appx-menu-container ul li a[id!='exit']").click(function(){
            var modidx = $(this).attr('id');
            trulogix.appxmenu(modidx);
            return false;
        });
    });
}(window.jQuery);