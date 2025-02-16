<div id="tv-input-properties-form{$tv}"></div>
{literal}
<style>
   
</style>
<div class="mixedmapsInfo">
    {/literal}{include file="$options_desc_tpl"}{literal}
</div>

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

            {/literal}
                MixedMapsLex = {$tveulex};
                function __(key) {
                    return MixedMapsLex[key];
                };
                {literal}

                MODx.load({
                    xtype: 'panel'
                    , layout: 'form'
                    , autoHeight: true
                    , cls: 'form-with-labels'
                    , border: false
                    , labelAlign: 'top'
                    , items: [{
                        xtype: 'textfield',
                        fieldLabel: __('mixedmaps_map_center'),
                        name: 'map_center',
                        id: 'map_center{/literal}{$tv}{literal}',
                        value: params['map_center'] || '',
                        anchors: '98%',
                        listeners: oc
                    }]
                    , renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
                });
    // ]]>
</script>
{/literal}