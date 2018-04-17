<script>
    /**
     * WEB FONT LOADING
     */
    (function() {
        // Optimization for Repeat Views
        // https://www.zachleat.com/web-fonts/demos/fout-with-class.html
        if( sessionStorage.foutFontsLoadedStage1 ) {
            document.documentElement.className += " wf-active-1";
        }

        if( sessionStorage.foutFontsLoadedStage2 ) {
            document.documentElement.className += " wf-active-2";
        }
    }());
</script>
