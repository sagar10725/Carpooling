<form action="signup-submit.php" method="POST" accept-charset="UTF-8">
        <fieldset>
            <legend>Signup for new user</legend>
            <br>
        
            <p><label><strong> Full Name :</strong></label>
            <label>
                <input type='text' name='name' id='name' maxlength="16" required/>
            </label></p>
            
            <p><label><strong> Password :</strong></label>
            <label>
                <input type='password' name='password' id='password'        maxlength="16" required/>
        </label></p>                        
			<p><label><strong> Email :</strong></label>
            <label>
                <input type='text' name='email' id='email'      maxlength="50" required/>
        </label></p>                        

              <p><label><strong><input type='submit' value="Submit" /></strong></label></p>
        </fieldset>
    </from>