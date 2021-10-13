{include file='Templates/Header.tpl'}

<h1>Login</h1>
<form class="login-form" action="verifyLogin" method="post">
	<input placeholder="email" type="text" name="email" required>
	<input placeholder="password" type="password" name="password" required>
	<input type="submit" value="Login">
</form>

{include file='Templates/Footer.tpl'}