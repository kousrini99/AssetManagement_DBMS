<?php
class Manage
{
	private $con;
	function __construct()
	{
		include_once("../database/db.php");
		$db=new Database();
		$this->con=$db->connect();
	}

	public function manageRecord($table,$pno){
		$a=$this->pagination($this->con,$table,$pno,5);
		if($table=="categories"){
			$sql="SELECT p.category_name AS category, c.category_name AS parent, p.cid, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid ".$a["limit"];
		}
		else{
			$sql="SELECT p.pid,p.product_name,c.category_name,p.product_price,p.product_stock,p.added_date,p.p_status FROM products p, categories c WHERE p.cid=c.cid ".$a["limit"];
		}
		$result=$this->con->query($sql) or die($this->con->error);
		$rows=array();
		if($result->num_rows>0){
			while ($row=$result->fetch_assoc()) {
				$rows[]=$row;
			}
		}
		return ["rows"=>$rows,"pagination"=>$a["pagination"]];
	} 


	private function pagination($con,$table,$pno,$n){
			$query = $con->query("SELECT COUNT(*) as rows1 FROM ".$table);
			$row = mysqli_fetch_assoc($query);
			//$totalRecords = 100000;
			$pageno = $pno;
			$numberOfRecordsPerPage = $n;
			$last = ceil($row["rows1"]/$numberOfRecordsPerPage);
			$pagination = "<ul class='pagination'>";
			if ($last != 1) {
				if ($pageno > 1) {
					$previous = "";
					$previous = $pageno - 1;
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#333;'> Previous </a></li>";
				}
				for($i=$pageno - 5;$i< $pageno ;$i++){
					if ($i > 0) {
						$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
					}	
				}
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";
				for ($i=$pageno + 1; $i <= $last; $i++) { 
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
					if ($i > $pageno + 4) {
						break;
					}
				}
				if ($last > $pageno) {
					$next = $pageno + 1;
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#333;'> Next </a></li></ul>";
				}
			}
			//LIMIT 0,10
			//LIMIT 20,10
			$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;
			return ["pagination"=>$pagination,"limit"=>$limit];

		}

		public function deleteRecord($table,$pk,$id){
			if($table=="categories"){
				$pre_stmt=$this->con->prepare("SELECT '.$id' FROM categories WHERE parent_cat = ?");
				$pre_stmt->bind_param("i",$id);
				$pre_stmt->execute();
				$result=$pre_stmt->get_result() or die($this->con->error);
				if($result->num_rows>0){
					return "DEPENDENT_CATEGORY";
				}
				else{
					$pre_stmt=$this->con->prepare("DELETE FROM ".$table." WHERE ".$pk."= ? ");
					$pre_stmt->bind_param("i",$id);
					$result=$pre_stmt->execute() or die($this->con->error);
					if($result){
						return "CATEGORY_DELETED";
					}
				}
				}
			else{
				$pre_stmt=$this->con->prepare("DELETE FROM ".$table." WHERE ".$pk."=?");
					$pre_stmt->bind_param("i",$id);
					$result=$pre_stmt->execute() or die($this->con->error);
					if($result){
						return "PRODUCT_DELETED";
					}
			}

	}

	public function getSingleRecord($table,$pk,$id){
		$pre_stmt=$this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ?");
		$pre_stmt->bind_param("i",$id);
		$pre_stmt->execute();
		$result=$pre_stmt->get_result() or die($this->con->error);;
		if($result->num_rows==1){
			$row=$result->fetch_assoc();
		}
		return $row;
	}


	public function updateCategory($cid,$parent,$cat){
		$pre_stmt=$this->con->prepare("UPDATE `categories` SET `parent_cat`= ?,`category_name`= ?,`status`= ? WHERE cid = ?");
		$status=1;
		$pre_stmt->bind_param("isii",$parent,$cat,$status,$cid);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return "CATEGORY_UPDATED";
		}
		else{
			return 0;
		}
	}

	public function updateProduct($cid,$pro_name,$price,$stock,$date,$pid){
		$pre_stmt=$this->con->prepare("UPDATE `products` SET `cid`=?,`product_name`=?,`product_price`=?,`product_stock`=?,`added_date`=?,`p_status`=? WHERE pid= ?");
		$status=1;
		$pre_stmt->bind_param("isdisii",$cid,$pro_name,$price,$stock,$date,$status,$pid);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return "PRODUCT_UPDATED";
		}
		else{
			return 0;
		}
	}

}

//$obj=new Manage();
//echo "<pre>";
//print_r($obj->manageRecord("categories",1));
//echo $obj->getSingleRecord("categories","cid",1);
//echo $obj->updateCategory(5,1,"Tablets");
?>