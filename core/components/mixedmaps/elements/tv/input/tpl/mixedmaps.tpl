<input type="hidden" id="tv{$tv->id}" name="tv{$tv->id}" value="{$tv->value|escape}" /> 
<div id="mixedmaps{$tv->id}" class="mixedmaps"></div>

<div class="mixedmaps__wrapper">
    <div class="mixedmaps__map">
        <div id="mixedmaps{$tv->id}" class="mixedmaps__map__inner"></div>
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
		mixedmaps{$tv->id} = MODx.load{literal}({
			{/literal}
			xtype: 'textfield'
			, applyTo: 'tv{$tv->id}'
			, enableKeyEvents: true
			{literal}
			, listeners: {'keydown': {fn: MODx.fireResourceFormChange, scope: this}}
		});

		Ext.getCmp('modx-panel-resource').getForm().add(mixedmaps{$tv->id});
		MODx.makeDroppable(fld);
    });
    {/literal}
    // ]]>

</script>