<div class="mixedmaps__wrapper">
    <div class="mixedmaps__map">
        <div id="mixedmaps{$tv->id}" class="mixedmaps__map__inner" 
        data-mixedmaps-center="{if $tv->get('value')}{$tv->get('value')|escape}{else}{$params.map_center}{/if}"
        data-mixedmaps-zoom="{$params.map_zoom}"
        data-mixedmaps-tv="tv{$tv->id}"
        ></div>
    </div>
    <input
            id="tv{$tv->id}"
            name="tv{$tv->id}"
            class="mixedmaps__input"
            type="text"
            value="{$tv->get('value')|escape}"
            {$style}
            tvtype="{$tv->type}"
    />
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
			{literal}
			, listeners: {'keydown': {fn: MODx.fireResourceFormChange, scope: this}}
		});

		Ext.getCmp('modx-panel-resource').getForm().add(mixedmaps{/literal}{$tv->id}{literal});
		MODx.makeDroppable(mixedmaps{/literal}{$tv->id}{literal});
    });
    {/literal}
    // ]]>

</script>