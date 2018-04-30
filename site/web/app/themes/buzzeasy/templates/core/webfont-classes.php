<!-- Preload important assets -->

<!-- Define call to desired webfont sourc. Use preload as rel which enables us to load stylesheets asynchronously, without blocking rendering.
    Once the webfont script loaded preload will be replaced by stylesheet. Boom, fonts loaded!  -->

<!-- If browser has no JS script enabled, use standard call as fallback  -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600">

<!-- Some browsers still don't support rel="preload" therefore we must provide a poilyfill  -->
<script>
    /*! loadCSS rel=preload polyfill. [c]2017 Filament Group, Inc. MIT License */
    <?php echo file_get_contents(get_stylesheet_directory() . '/assets/js/src/polyfills/preload-polyfill.js'); ?>
</script>

<script>
    /**
     * WEB FONT LOADING
     */
    (function() {
        // Optimization for Repeat Views
        // https://www.zachleat.com/web-fonts/demos/fout-with-class.html
        if( sessionStorage.foutFontsLoadedStage1 ) {
            document.documentElement.className += ' wf-active-1';
        }

        if( sessionStorage.foutFontsLoadedStage2 ) {
            document.documentElement.className += ' wf-active-2';
        }

        if( sessionStorage.foutFontsLoadedStage3 ) {
            document.documentElement.className += ' wf-active-3';
        }
    }());
</script>
