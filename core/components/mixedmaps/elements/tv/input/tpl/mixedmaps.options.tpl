<div id="tv-input-properties-form{$tv}"></div>
{literal}

<script type="text/javascript">
    // <![CDATA[
    var params = {
        {/literal}{foreach from=$params key=k item=v name='p'}  
        {if $v|is_array}
        {foreach from=$v key=i item=j name='dd'}
        '{$i}': '{$j}',
        {/foreach}
    {else}
    '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last}, {/if}
        {/if}        
            {/foreach}{literal}
            };
            var oc = { 'change': { fn: function () { Ext.getCmp('modx-panel-tv').markDirty(); }, scope: this } };

                MODx.load({
                    xtype: 'panel'
                    , layout: 'form'
                    , autoHeight: true
                    , cls: 'form-with-labels'
                    , border: false
                    , labelAlign: 'top'
                    , items: [{
                        xtype: 'textfield',
                        fieldLabel: _('mixedmaps_map_center'),
                        name: 'inopt_map_center',
                        id: 'map_center{/literal}{$tv}{literal}',
                        value: params['map_center'] || '',
                        anchors: '98%',
                        listeners: oc
                    }, {
                        xtype: 'textfield',
                        fieldLabel: _('mixedmaps_map_zoom'),
                        name: 'inopt_map_zoom',
                        id: 'map_zoom{/literal}{$tv}{literal}',
                        value: params['map_zoom'] || 9,
                        anchors: '98%',
                        listeners: oc
                    }]
                    , renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
                });
    // ]]>
</script>
{/literal}