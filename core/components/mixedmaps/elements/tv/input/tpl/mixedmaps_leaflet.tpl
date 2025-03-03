<div class="mixedmaps">
    <div class="mixedmaps__map">
        <input placeholder="Search address" type="text" class="mixedmaps-search x-form-text x-form-field" id="mixedmaps{$tv->id}-search">
        <div id="mixedmaps{$tv->id}" class="mixedmaps__map__inner" 
        data-mixedmaps-center="{if $tv->get('value')}{$tv->get('value')|escape}{else}{$params.map_center}{/if}"
        data-mixedmaps-zoom="{$params.map_zoom}"
        data-mixedmaps-tv="tv{$tv->id}"
        {if $tv->get('value')}data-mixedmaps-current="{$tv->get('value')|escape}"{/if}
        ></div>
    </div>
    <input type="text" placeholder="Coordinates" id="tv{$tv->id}" name="tv{$tv->id}" class="mixedmaps__input" value="{$tv->get('value')|escape}" tvtype="{$tv->type}"/>
</div>

<script type="text/javascript">
 
    // <![CDATA[
	{literal}
	Ext.onReady(function () {
		mixedmaps{/literal}{$tv->id}{literal} = MODx.load({
			{/literal}
			xtype: 'textfield'
			, applyTo: 'tv{$tv->id}'
			, enableKeyEvents: true
            , anchor: '98%'
			{literal}
			, listeners: {'keydown': {fn: MODx.fireResourceFormChange, scope: this}}
		});

		Ext.getCmp('modx-panel-resource').getForm().add(mixedmaps{/literal}{$tv->id}{literal});
		MODx.makeDroppable(mixedmaps{/literal}{$tv->id}{literal});
    });
    {/literal}
    // ]]>

</script>

<script src="/assets/components/mixedmaps/libs/leaflet/mgr.js" defer></script>
 