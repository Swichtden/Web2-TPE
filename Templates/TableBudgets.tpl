{include file='Templates/Header.tpl'}

<section class="table">
	<nav>
	<ul>
		<li>
			<a href="login"></a>
		</li>
	</ul>
	</nav>
	<h1>{$Title}</h1>
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
						<td><a href="/presupuesto/edit/{$budget->id_cliente}"<button><i class="fas fa-edit fa-fw"></i></button></a></td>
						<td><a href="/presupuesto/delete/{$budget->id_cliente}"<button><i class="fas fa-trash fa-fw"></i></button></a></td>
					{/if}
				</tr>
			{/foreach}
		</tbody>
	</table>
</section>

{include file='Templates/Footer.tpl'}