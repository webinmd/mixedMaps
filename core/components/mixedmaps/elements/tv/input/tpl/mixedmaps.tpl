<input type="hidden" id="tv{$tv->id}" name="tv{$tv->id}" value="{$tv->value|escape}" /> 
<div id="mixedmaps{$tv->id}" class="mixedmaps"></div>

<script type="text/javascript">
 
    mixedmaps{$tv->id} = MODx.load{literal}({
		{/literal}
		xtype: 'mixedmaps-panel'
		,renderTo: 'mixedmaps{$tv->id}'
		,tvFieldId: 'tv{$tv->id}'
		,tvId: '{$tv->id}'
		,value: '{$tv->value}'
		,res_id: {$res_id}
		{literal}
	});
	{/literal}

</script>