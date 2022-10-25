<?php
/*
Template Name: Search Page
*/
?>

<form role="search"  class="form-inline my-2 my-lg-0 search-form w-100" action="/" method="get">
	<div class="input-group mb-3 w-100">
		<input type="text" class="form-control" name="s" autofocus placeholder="Поиск ресторанов и блюд"
		       aria-label="Recipient's username" value="<?php if(isset($_GET['s'])) echo $_GET['s']?>" aria-describedby="basic-addon2">
		<div class="input-group-append">
			<button class="btn btn-outline-secondary" type="submit">
				<ion-icon name="search"></ion-icon>
			</button>

		</div>
	</div>
</form>