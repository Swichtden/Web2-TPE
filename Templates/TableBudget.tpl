{include file='Templates/Head.tpl'}
{include file='Templates/NavBar.tpl'}

<section>
    <h1>{$Title}</h1>
	{if $Edit && $rol}
		{include file='Templates/BudgetForm.tpl'}
	{else}
		<ul>
			<li>Cliente: {$Budget[0]->nombre_cliente}</li>
			<li>Monto: {$Budget[0]->monto}</li>
			<li>Material: {$Budget[0]->nombre_material}</li>
		</ul>
	{/if}
</section>

{include file='Templates/Footer.tpl'}