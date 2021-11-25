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
		{if $Comentarios != false }
				<ul>
					<li>Comentario:{$Comentarios->detalle}</li>
					<li>Puntaje:{$Comentarios->puntaje}</li> 	
					{if $role==2}
						<button class="buttons" id="delete" data-id_comentario="{$Comentarios->id_comentario}" data-id_presupuesto="{$Comentarios->FK_id_cliente}"><i class="fas fa-trash fa-fw"></i></button>
					{/if}
				</ul>
		{else}
			<h2>No hay comentarios</h2>
		{/if}
	{/if}
</section>
<script type='text/javascript' src='/Js/TableBudget.js'></script>
{include file='Templates/Footer.tpl'}