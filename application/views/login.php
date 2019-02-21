<?php
$name=array(
	'type' => 'text',
	'id' => 'dname', 
	'name' => 'dname');

$email=array(
	'type' => 'email',
	'id' => 'demail',
	'name' => 'demail');

$no=array(
	'type' => 'text',
	'id' => 'dmobile',
	 'name' => 'dmobile');

$adrs=array(
	'type' => 'text',
     'id' => 'daddress',
	 'name' => 'daddress');


?>
<!DOCTYPE html>
<html>
<head>
<title>Create Contact Form Using CodeIgniter</title>
<style type="text/css">
	#container{
width:960px;
height:610px;
margin:50px auto
}
#fugo{
float:right
}
form{
width:320px;
padding:0 50px 20px;
background:linear-gradient(#fff,#ABDBFF);
border:1px solid #ccc;
box-shadow:0 0 5px;
font-family:'Marcellus',serif;
float:left;
margin-top:10px
}
h1{
text-align:center;
font-size:28px
}
hr{
border:0;
border-bottom:1.5px solid #ccc;
margin-top:-10px;
margin-bottom:30px
}
label{
font-size:17px
}
input{
width:100%;
padding:10px;
margin:6px 0 20px;
border:none;
box-shadow:0 0 5px
}
input#submit{
margin-top:20px;
font-size:18px;
background:linear-gradient(#22abe9 5%,#36caf0 100%);
border:1px solid #0F799E;
color:#fff;
font-weight:700;
cursor:pointer;
text-shadow:0 1px 0 #13506D
}
input#submit:hover{
background:linear-gradient(#36caf0 5%,#22abe9 100%)
}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
<div id="container">
	  

<?php echo form_open('Login'); ?>

<?php echo form_label(' Name :'); ?>
<?php echo form_input($name); ?>
<div style="color: red;"><?php echo form_error($name['name']); ?><?php echo isset($errors[$name['name']])?$errors[$name['name']]:''; ?></div>
<?php print_r(form_error()) ; ?> 


<?php echo form_label(' Email :'); ?>
<?php echo form_input($email); ?>
<?php echo form_label(' Mobile No. :'); ?>
<?php echo form_input($no); ?>
<?php echo form_label('Address :'); ?>
<?php echo form_input($adrs); ?>
<div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
<?php echo form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
<?php echo form_close(); ?>

</div>

</body>
</html>