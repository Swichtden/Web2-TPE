{include_once file='Templates/Head.tpl'}
{* {include_once file='Templates/NavBar.tpl'} *}

<section>
	<h1>{$Title}</h1>
	{if $rol}
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
				  	{if $rol}
						<td class="boton-tabla"><a href="/material/edit/{$material->id_material}"<button><i class="fas fa-edit fa-fw"></i></button></a></td>
						<td class="boton-tabla"><a href="/material/delete/{$material->id_material}"<button><i class="fas fa-trash fa-fw"></i></button></a></td>
					{/if}
			  	</tr>
		  	{/foreach}
		</tbody>
	</table>
</section>

{include file='Templates/Footer.tpl'}


