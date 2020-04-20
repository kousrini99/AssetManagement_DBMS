$(document).ready(function(){
	var DOMAIN="http://localhost/asset_man/public_html";
	$("#register_form").on("submit",function(){
		var status=false;
		var name=$("#username");
		var email=$("#email");
		var pass1=$("#password1");
		var pass2=$("#password2");
		var n_patt=new RegExp(/^[A-Za-z ]+$/);
		if(name.val()==""||name.val().length<6){
			alert("hi");
			name.addClass("border-danger");
			$('#u_error').html("<span class='text-danger'> Please Enter Name</span>");
			status=false;
		}
		else{
			name.removeClass("border-danger");
			$('#u_error').html("");
			status=true;
		}
		if(email.val()==""){
			email.addClass("border-danger");
			$('#e_error').html("<span class='text-danger'> Please Enter Email</span>");
			status=false;
		}
		else{
			email.removeClass("border-danger");
			$('#e_error').html("");
			status=true;
		}
		if(pass1.val()==""||pass1.val().length<6){
			pass1.addClass("border-danger");
			$('#p1_error').html("<span class='text-danger'> Please Enter Password(more than 6 characters)</span>");
			status=false;
		}
		else{
			pass1.removeClass("border-danger");
			$('#p1_error').html("");
			status=true;
		}
		if(pass2.val()!=pass1.val()||status==false){
			pass2.addClass("border-danger");
			$('#p2_error').html("<span class='text-danger'> Passwords do not match</span>");
			status=false;
		}
		else{
			pass2.removeClass("border-danger");
			$('#p2_error').html("");
			status=true;
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method: "POST",
				data: $('#register_form').serialize(),
				success:function(data){
					if(data=="EMAIL_ALREADY_EXISTS"){
						alert("Email already exists");
					}
					else if(data=="SOME_ERROR"){
						alert("Something wrong");
					}
					else{
						window.location.href=encodeURI(DOMAIN+"/index.php?msg=You are registered Now you can login");
					}
				}
			})
		}
	})


	//login
	$("#form_login").on("submit",function(){
		var email=$("#log_email");
		var pass=$("#log_password");
		var status=false;
		if(email.val()==""){
			email.addClass("border-danger");
			$('#e_error').html("<span class='text-danger'> Please Enter Email</span>");
			status=false;
		}
		else{
			email.removeClass("border-danger");
			$('#e_error').html("");
			status=true;
		}
		if(pass.val()==""||pass.val().length<6){
			pass.addClass("border-danger");
			$('#p_error').html("<span class='text-danger'> Please Enter Password(more than 6 characters)</span>");
			status=false;
		}
		else{
			pass.removeClass("border-danger");
			$('#p_error').html("");
			status=true;
		}
		if(status){
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method: "POST",
				data: $('#form_login').serialize(),
				success:function(data){
					if(data=="NOT_REGISTERED"){
						alert("You are not registered");
					}
					else if(data=="PASSWORD_NOT_MATCHED"){
						alert("Please check your email or password");
					}
					else{
						window.location.href=DOMAIN+"/dashboard.php"; 
					}
				}
			})
		}
	})


	//Fetch Category
	fetch_category();
	function fetch_category(){
		$.ajax({
			url: DOMAIN+"/includes/process.php",
			method: "POST",
			data: {getCategory:1},
			success: function(data){
				var root="<option value='0'>Root</option>";
				var choose="<option value=''>Choose Category</option>";
				$('#parent_cat').html(root+data);
				$('#select_cat').html(choose+data);
			}
		})
	}


	//Add Category
	$('#category_form').on("submit",function(){
		if($("#category_name").val()==""){
			$("#category_name").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
		}
		else{
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method: "POST",
				data: $('#category_form').serialize(),
				success: function(data){
					if(data=="CATEGORY_ADDED"){
						$("#category_name").removeClass("border-danger");
						$("#cat_error").html();
						$("#category_name").val("");
						alert("New Category Added Successfully");
						fetch_category();
						window.location.href="";
					}
					else{
						alert(data);
					}
				}
			})
		}
	})


	//Add Product
	$('#product_form').on("submit",function(){
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method: "POST",
				data: $('#product_form').serialize(),
				success: function(data){
					if(data=="PRODUCT_ADDED"){
						alert("New Product Added Successfully");
						$("#product_name").val("");
						$("#product_price").val("");
						$("#product_qty").val("");
						fetch_category();
						window.location.href="";
					}
					else{
						alert(data);
					}
				}
			})
	})


})