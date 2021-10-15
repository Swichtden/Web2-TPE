{include file='Templates/Head.tpl'}
{include file='Templates/NavBar.tpl'}

<section class="table">
	<h1>{$Title}</h1>
	{if $rol}
		{include file='Templates/BudgetForm.tpl'}
	{/if}
	<table class="presupuesto">
		<thead class="headersimulator">
			<tr >
				<th>Nombre</th>	
				<th>Material</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$Budgets item=$budget}
				<tr>
					<td><a href="presupuesto/{$budget->id_cliente}">{$budget->nombre_cliente}</a></td>
					<td>{$budget->nombre_material}</td>
					{if $rol}
						<td class="boton-tabla"><a href="/presupuesto/edit/{$budget->id_cliente}"<button><i class="fas fa-edit fa-fw"></i></button></a></td>
						<td class="boton-tabla"><a href="/presupuesto/delete/{$budget->id_cliente}"<button><i class="fas fa-trash fa-fw"></i></button></a></td>
					{/if}
				</tr>
			{/foreach}
		</tbody>
	</table>
</section>

{include file='Templates/Footer.tpl'}