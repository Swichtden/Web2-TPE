{include file='Templates/Header.tpl'}

<section class="table">
	<h1>{$Title}</h1>
	<table class="presupuesto">
		<thead class="headersimulator">
			<tr >
				<th>Nombre</th>	
				{*<th>Monto</th>*}	
				<th>Material</th>
			</tr>
			<!-- <tr>
				<th><input type="text" name="namefilter" placeholder="John doe" required> </th>
				<th>
					<select type="select" name="matfilter">
						<option value="">Todos</option>
						<option value="PLA">PLA</option>
						<option value="ABS">ABS</option>
						<option value="Pet-g">Pet-g</option>
						<option value="Tecnicos">Tecnicos</option>
						<option value="Flex">Flex</option>
					</select>
				</th>
				<th><input type="number" name="grfilter" placeholder="cantidad Gr" required></th>
				<th><input type="number" name="hrfilter" placeholder="cantidad Hs" required></th>
				<th><input type="number" name="budgetfilter" placeholder="Monto" required></th>
			</tr> -->
		</thead>
		<tbody>
		  {foreach from=$Budgets item=$budget}
			  <tr>
				  <th><a href="presupuesto/{$budget->id_cliente}">{$budget->nombre_cliente}</a></th>
				  <th>{$budget->nombre_material}</th>
			  </tr>
		  {/foreach}
		</tbody>
	</table>
</section>

{include file='Templates/Footer.tpl'}