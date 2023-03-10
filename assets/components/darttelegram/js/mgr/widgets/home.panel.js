dartTelegram.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'darttelegram-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('darttelegram') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('darttelegram_levels'),
                layout: 'anchor',
                items: [{
                    html: _('darttelegram_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'darttelegram-grid-levels',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    dartTelegram.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(dartTelegram.panel.Home, MODx.Panel);
Ext.reg('darttelegram-panel-home', dartTelegram.panel.Home);
