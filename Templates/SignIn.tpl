{include file='Templates/Head.tpl'}
{* {include file='Templates/NavBar.tpl'} *}

<h1>{$Title}</h1>
<h2>{$Error}</h2> 
<form action="signIn" method="post">
	<input placeholder="email" type="text" name="email" required>
	<input placeholder="password" type="password" name="password" required>
	<input type="submit" value="Register">
</form>

{include file='Templates/Footer.tpl'}