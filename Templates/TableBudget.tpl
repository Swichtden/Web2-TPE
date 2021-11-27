{include file='Templates/Head.tpl'}

<section>
    <h1>{$Title}</h1>
	<h2>{$Message}</h2>
	{if $Edit && $role == 2}
		{include file='Templates/BudgetForm.tpl'}
	{else}
		<ul>
			<li>Cliente: {$Budget[0]->nombre_cliente}</li>
			<li>Monto: {$Budget[0]->monto}</li>
			<li>Material: {$Budget[0]->nombre_material}</li>
		</ul>
		<h2>Comentarios:</h2>
		{if $role >= 1}
			{include file='Templates/CommentForm.tpl'}
		{/if}
		<div id=listaComentarios data-id_presupuesto="{$Budget[0]->id_cliente}" data-id_rol="{$role}">
		</div>
	{/if}
</section>
<script type='text/javascript' src='/Js/TableBudget.js'></script>
{include file='Templates/Footer.tpl'}