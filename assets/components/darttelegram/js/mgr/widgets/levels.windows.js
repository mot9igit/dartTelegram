dartTelegram.window.CreateLevel = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'darttelegram-level-window-create';
    }
    Ext.applyIf(config, {
        title: _('darttelegram_level_create'),
        width: 550,
        autoHeight: true,
        url: dartTelegram.config.connector_url,
        action: 'mgr/level/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    dartTelegram.window.CreateLevel.superclass.constructor.call(this, config);
};
Ext.extend(dartTelegram.window.CreateLevel, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'textfield',
            fieldLabel: _('darttelegram_level_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textfield',
            fieldLabel: _('darttelegram_level_chats'),
            name: 'chats',
            id: config.id + '-chats',
            anchor: '99%'
        }, {
            xtype: 'textarea',
            fieldLabel: _('darttelegram_level_description'),
            name: 'description',
            id: config.id + '-description',
            height: 150,
            anchor: '99%'
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('darttelegram_level_active'),
            name: 'active',
            id: config.id + '-active',
            checked: true,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('darttelegram-level-window-create', dartTelegram.window.CreateLevel);


dartTelegram.window.UpdateLevel = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'darttelegram-level-window-update';
    }
    Ext.applyIf(config, {
        title: _('darttelegram_level_update'),
        width: 550,
        autoHeight: true,
        url: dartTelegram.config.connector_url,
        action: 'mgr/level/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    dartTelegram.window.UpdateLevel.superclass.constructor.call(this, config);
};
Ext.extend(dartTelegram.window.UpdateLevel, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            xtype: 'textfield',
            fieldLabel: _('darttelegram_level_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textfield',
            fieldLabel: _('darttelegram_level_chats'),
            name: 'chats',
            id: config.id + '-chats',
            anchor: '99%'
        }, {
            xtype: 'textarea',
            fieldLabel: _('darttelegram_level_description'),
            name: 'description',
            id: config.id + '-description',
            anchor: '99%',
            height: 150,
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('darttelegram_level_active'),
            name: 'active',
            id: config.id + '-active',
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('darttelegram-level-window-update', dartTelegram.window.UpdateLevel);