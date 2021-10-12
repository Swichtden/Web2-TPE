{include file='Templates/Header.tpl'}
    <section class="table">
	<h1>{$Title}</h1>
	<table class="materiales">
		<thead class="headersimulator">
			<tr >
				<th>Nombre del Material</th>	
				<th>Precio Material</th>
                <th>Descripcion del Material</th>	
			</tr>
        </thead>
		<tbody>
		  {foreach from=$MaterialesLista item=$material}
			  <tr>
				  <th><a href="material/{$material->id_material}">{$material->nombre_material}</a></th>
				  <th>{$material->precio_material}</th>
				  <th>{$material->descripcion_material}</th>
			  </tr>
		  {/foreach}
		</tbody>
	</table>
</section>

{include file='Templates/Footer.tpl'}


