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
}

