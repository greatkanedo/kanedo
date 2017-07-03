
<!-- Load our scripts -->

<!-- Resizable 'on-demand' full-height hero -->
<script type="text/javascript">

    var resizeHero = function () {
        var hero = $(".cover,.heightblock"),
                window1 = $(window);
        hero.css({
            "height": window1.height()
        });
    };

    resizeHero();

    $(window).resize(function () {
        resizeHero();
    });
</script>
<script src="https://kanedo.oss-cn-shanghai.aliyuncs.com/js/plugins.min.js"></script>
<script src="https://kanedo.oss-cn-shanghai.aliyuncs.com/js/jquery.flexslider-min.js"></script>
<script src="https://kanedo.oss-cn-shanghai.aliyuncs.com/js/scripts.js"></script>
<link rel="stylesheet" href="https://kanedo.oss-cn-shanghai.aliyuncs.com/css/jquery.fancybox-1.3.4.css">
<link rel="stylesheet" href="/static/plugin/highlight/styles/atom-one-dark.css">  
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js"></script>
<script> hljs.initHighlightingOnLoad(); </script>
<script type="text/javascript">

</script>

<!-- Initiate flexslider plugin -->
<script type="text/javascript">
    $(document).ready(function($) {
        $('.flexslider').flexslider({
            animation: "fade",
            prevText: "",
            nextText: "",
            directionNav: true
        });

    });
</script>
</body>
</html>