(() => {
    $.ajaxSetup({ cache: false });
    const $moduleVars = $('#module-vars');
    const diff = $($moduleVars.data('diff'));
    const editor = $($moduleVars.data('editor'));
    editor.on('editor.edit', (e, val) => {
        diff.monacoDiffEditor('updateModified', val);
    });
    $('.terminal-card').widgetFullScreen({
        selectorFullScreen: $moduleVars.data('fullscreen-target')
    });
    $('i[data-toggle="collapse"').click((e) => $($(e.currentTarget).closest('.terminal-card').find('div.collapse')).toggleClass('show'));
})();