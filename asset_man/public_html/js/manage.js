$(document).ready(function(){
	var DOMAIN="http://localhost/asset_man/public_html";

//Manage Category
	manageCategory(1);
	function manageCategory(pn){
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method: "POST",
			data: {manageCategory:1,pageno:pn},
			success: function(data){
				$('#get_category').html(data);
			}
		})
	}

	$("body").delegate(".page-link","click",function(){
		var pn=$(this).attr("pn");
		manageCategory(pn);
	})

	$("body").delegate(".del_cat","click",function(){
		var did=$(this).attr("did");
		if(confirm("Are you sure, You want to delete")){
			$.ajax({
			url:DOMAIN+"/includes/process.php",
			method: "POST",
			data: {deleteCategory:1,id:did},
			success: function(data){
				if(data=="DEPENDENT_CATEGORY"){
					alert("Sorry, the category is dependent");
				}
				else if(data=="CATEGORY_DELETED"){
					alert("Category deleted Successfully");
					manageCategory(1);
				}
				else if(data=="PRODUCT_DELETED"){
					alert("Product deleted Successfully");
				}
				else{
					alert(data);
				}
			}
		})
		}
		else{
		}
	})

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


//Update Category
	$("body").delegate(".edit_cat","click",function(){
		var eid=$(this).attr("eid");
		$.ajax({
			url: DOMAIN+"/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateCategory:1,id:eid},
			success: function(data){
				$("#cid").val(data["cid"]);
				$("#update_category").val(data["category_name"]);
				$("#parent_cat").val(data["parent_cat"]);
			}
		})
	})


	$("#update_category_form").on("submit",function(){
		if($("#update_category").val()==""){
			$("#update_category").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
		}
		else{
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method: "POST",
				data: $('#update_category_form').serialize(),
				success: function(data){
					window.location.href="";
				}
			})
		}
	})


//Products
	
	manageProduct(1);
	function manageProduct(pn){
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method: "POST",
			data: {manageProduct:1,pageno:pn},
			success: function(data){
				$('#get_product').html(data);
			}
		})
	}

	$("body").delegate(".page-link","click",function(){
		var pn=$(this).attr("pn");
		manageProduct(pn);
	})


	$("body").delegate(".del_product","click",function(){
		var did=$(this).attr("did");
		if(confirm("Are you sure, You want to delete")){
			$.ajax({
			url:DOMAIN+"/includes/process.php",
			method: "POST",
			data: {deleteProduct:1,id:did},
			success: function(data){
				if(data=="PRODUCT_DELETED"){
					alert("Product deleted Successfully");
					manageProduct(1);
				}
				else{
					alert(data);
				}
			}
		})
		}
		else{
		}
	})


//Update Product
	$("body").delegate(".edit_product","click",function(){
		var eid=$(this).attr("eid");
		$.ajax({
			url: DOMAIN+"/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateProduct:1,id:eid},
			success: function(data){
				$("#pid").val(data["pid"]);
				$("#update_product").val(data["product_name"]);
				$("#select_cat").val(data["cid"]);
				$("#product_price").val(data["product_price"]);
				$("#product_qty").val(data["product_stock"]);

			}
		})
	})

//Update Product
	$('#update_product_form').on("submit",function(){
			$.ajax({
				url: DOMAIN+"/includes/process.php",
				method: "POST",
				data: $('#update_product_form').serialize(),
				success: function(data){
					if(data=="PRODUCT_UPDATED"){
						alert("Product Updated");
						window.location.href="";
					}
					else{
						alert(data);
					}
				}
			})
		})
})