{include file='Templates/Header.tpl'}

<section class="table">
    <h1>{$Title}</h1>
    <table class="presupuesto">
		<thead class="headersimulator">
			<tr >
				<th>Cliente</th>	
				<th>Monto</th>
				<th>Material</th>
			</tr>

        </thead>
        <tbody>
			<tr>
				<th>{$Budget[0]->nombre_cliente}</th>
				<th>{$Budget[0]->monto}</th>
				<th>{$Budget[0]->nombre_material}</th> 
			</tr>
		</tbody>
	</table>
</section>

{include file='Templates/Footer.tpl'}