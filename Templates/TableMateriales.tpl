{include_once file='Templates/Head.tpl'}


<section>
	<h1>{$Title}</h1>
	{if $role==2}
		 {include file='Templates/MaterialForm.tpl'}
	{/if}
	<table>
		<thead>
			<tr >
				<th>Nombre del Material</th>	
				<th>Precio Material</th>
                <th>Descripcion del Material</th>	
			</tr>
        </thead>
		<tbody>
		  	{foreach from=$Materiales item=$material}
			  	<tr class="tablamaterial">
				  	<td><a href="filtroMaterial/{$material->id_material}">{$material->nombre_material}</a></td>
				  	<td>{$material->precio_material}</td>
				  	<td>{$material->descripcion_material}</td>
				  	{if $role==2}
						<td class="buttons"><a href="/material/edit/{$material->id_material}"<button><i class="fas fa-edit fa-fw"></i></button></a></td>
						<td class="buttons"><a href="/material/delete/{$material->id_material}"<button><i class="fas fa-trash fa-fw"></i></button></a></td>
					{/if}
			  	</tr>
		  	{/foreach}
		</tbody>
	</table>
</section>

{include file='Templates/Footer.tpl'}


