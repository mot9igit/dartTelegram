var dartTelegram = function (config) {
    config = config || {};
    dartTelegram.superclass.constructor.call(this, config);
};
Ext.extend(dartTelegram, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('darttelegram', dartTelegram);

dartTelegram = new dartTelegram();