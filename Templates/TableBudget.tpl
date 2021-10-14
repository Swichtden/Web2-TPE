{include file='Templates/Header.tpl'}

<section class="table">
    <h1>{$Title}</h1>
	<ul>
		<li>Cliente: {$Budget[0]->nombre_cliente}</li>
		<li>Monto: {$Budget[0]->monto}</li>
		<li>Material: {$Budget[0]->nombre_material}</li>
	</ul>
</section>

{include file='Templates/Footer.tpl'}