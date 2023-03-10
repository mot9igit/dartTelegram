dartTelegram.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'darttelegram-panel-home',
            renderTo: 'darttelegram-panel-home-div'
        }]
    });
    dartTelegram.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(dartTelegram.page.Home, MODx.Component);
Ext.reg('darttelegram-page-home', dartTelegram.page.Home);