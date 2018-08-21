var bootstrapCss = 'bootstrapCss';
if (!document.getElementById(bootstrapCss))
{
    var head = document.getElementsByTagName('head')[0];
    var bootstrapWrapper = document.createElement('link');
    bootstrapWrapper.id = bootstrapCss;
    bootstrapWrapper.rel = 'stylesheet';
    bootstrapWrapper.type = 'text/css';
    bootstrapWrapper.href = '../wp-content/plugins/marketful/admin/css/bootstrap-wrapper.css';
    bootstrapWrapper.media = 'all';
    head.appendChild(bootstrapWrapper);

    //load other stylesheets that override bootstrap styles here, using the same technique from above

    var customStyles = document.createElement('link');
    customStyles.id = "customStyles";
    customStyles.rel = 'stylesheet';
    customStyles.type = 'text/css';
    customStyles.href = '../wp-content/plugins/marketful/admin/css/styles.css';
    customStyles.media = 'all';
    head.appendChild(customStyles);
    
    var ape_style = document.createElement('link');
    ape_style.id = "admin-product-entries";
    ape_style.rel = 'stylesheet';
    ape_style.type = 'text/javascript"';
    ape_style.href = '../wp-content/plugins/marketful/admin/css/admin-product-entries.css';
    ape_style.media = 'all';
    head.appendChild(ape_style);
    
    /*
    var ape_func = document.createElement('link');
    ape_func.id = "admin-product-entries";
    ape_func.rel = 'script';
    ape_func.type = 'text/css';
    ape_func.href = '../wp-content/plugins/marketful/admin/js/admin-product-entries.js';
    ape_func.media = 'all';
    head.appendChild(ape_func);
    */
}

