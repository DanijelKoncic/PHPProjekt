<?php 
	print '
	<h1>Registracijski formular</h1>
	<div id="register">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<label for="fname">Ime *</label>
			<input type="text" id="fname" name="firstname" placeholder="Vaše ime ..." required>

			<label for="lname">Prezime *</label>
			<input type="text" id="lname" name="lastname" placeholder="Vaše prezime ..." required>
				
			<label for="email">E-mail *</label>
			<input type="email" id="email" name="email" placeholder="Vaš e-mail ..." required>
			
			<label for="username">Korisničko ime:* <small>(Minimalno 5, maksimalno 10 znakova)</small></label>
			<input type="text" id="username" name="username" pattern=".{5,10}" placeholder="Korisničko ime ..." required><br>
			
									
			<label for="password">Lozinka:* <small>(Minimalno 4 znaka)</small></label>
			<input type="password" id="password" name="password" placeholder="Lozinka ..." pattern=".{4,}" required >

			<label for="country">Država:</label>
			<select name="country" id="country">
				<option value="">odaberite</option>';
				#Select all countries from database webprog, table countries
				$query  = "SELECT * FROM countries";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
				}
			print '
			</select>

			<input type="submit" value="Pošalji">
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE user_email='" .  $_POST['email'] . "'";
		$query .= " OR user_name='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ($row['user_email'] == '' || $row['user_name'] == '') {
			# password_hash https://secure.php.net/manual/en/function.password-hash.php
			# password_hash() creates a new password hash using a strong one-way hashing algorithm
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO users (user_firstname, user_lastname, user_email, user_name, user_pass, user_country)";
			$query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "')";
			$result = @mysqli_query($MySQL, $query);
			
			echo "Rezultat" . $result;
			# ucfirst() — Make a string's first character uppercase
			# strtolower() - Make a string lowercase
			echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['lastname'])) . ', hvala Vam na registraciji </p>
			<hr>';
		}
		else {
			echo '<p>Korisnik s ovim e-mailom ili korisničkim imenom već postoji!</p>';
			
		}
	}
	print '
	</div>';
?>