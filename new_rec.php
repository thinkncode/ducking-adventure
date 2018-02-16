


<?php


$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "codeigniter";

// Create connection
//$conn = new mysqli($servername, $username, $password);
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//$sql = "SELECT a.id, a.parent_id, a.comments, a.date from message a left join message b on a.id = b.parent_id order by a.date desc";

$sql = "SELECT * from message order by date desc";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_array($result)){
		$data[] = array('id'=>$row['id'], 'parent_id'=>$row['parent_id'], 'comments'=>$row['comments'], 'date'=>$row['date']);
	}
}
echo "<pre>";
print_R($data);



$parentID = array();
foreach($data as $msg){
	if($msg['parent_id'] == 0){
		$parentID[] = $msg['id'];
	}else{
		recursionData($data, $msg['parent_id']);
		//print_r($_SESSION['something']);
		array_push($parentID, $_SESSION['something']);
	}
}

print_r($parentID);
$orderedMessages = array_unique($parentID);
echo "<pre>";
print_r($orderedMessages);

session_unset($_SESSION['something']);  
function recursionData($data, $parentID){
	foreach($data as $parentData){
		
		if($parentData['id'] == $parentID){

			if($parentData['parent_id'] == 0){
				//echo "<prE>";
				$a = $parentData['id'];
				session_start();
				$_SESSION['something'] = $a;
				//!isset($_SESSION['something']
				//$a = 1;
				
				//xyz($parentData['id'])
			}else{
				recursionData($data, $parentData['parent_id']);
			}
			
		}
	}
	//return $a;
	//return $a;
	//echo $a;

}

//print_r($orderingInMessage);
//SELECT a.id, a.parent_id, a.comments, a.date from message a left join message b on b.parent_id = a.id where a.parent_id = 0 order by a.date asc 

?> 

	<ul>
	<?php 
		if(!empty($orderingInMessage)){
			foreach($orderingInMessage as $pmessages){
				echo '<li>'.$pmessages['parent']['comments'];
				if($pmessages['child'] != ''){
					echo '<ul>';
					foreach($pmessages['child'] as $cmessage){
						echo '<li>'.$cmessage['comments'].'  --------------  '. $cmessage['date'].'</li>';
					}
					echo '</ul>';
				}
				echo '</li>';
			}
		}else{
			echo 'No Record';
		}
	?>
	</ul>

	