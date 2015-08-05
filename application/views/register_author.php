<?php $this->load->view('partial/header'); ?>

</head>

<body class="gray-bg">
    
    <form>
        <label>Email :</label> <input type="email" name="email_address" />
        <label>first_name :</label> <input type="text" name="first_name" />
        <label>last_name :</label> <input type="text" name="last_name" />
        <label>title :</label> <input type="text" name="title" />
        <label>gender :</label> <select name="gender"><option>Male</option><option>Female</option></select>
        <label>password :</label> <input type="password" name="password" />
        <label>re-password :</label> <input type="password" name="repassword" />
        <label>mobile_no :</label> <input type="text" name="mobile_no" />
        <label>address1 :</label> <input type="text" name="address1" />
        <label>address2 :</label> <input type="text" name="address2" />
        <label>city :</label> <input type="text" name="city" />
        <label>postal_code :</label> <input type="text" name="postal_code" />
        <label>country :</label> <input type="text" name="country" />
        <label>profile_picture :</label> <input type="file" name="profile_picture_URL" />
        <label>security_question :</label> <input type="text" name="security_question" />
        <label>security_answer :</label> <input type="text" name="security_answer" />
        
        <input type="submit" value="Register" />
        
    </form>
    
</body>