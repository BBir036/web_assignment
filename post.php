<?php include 'inc/header.php';?>

<?php
	if(!isset($_GET['id']) || $_GET['id']== NULL){
		header("Location: 404.php");
	}
	else{
		$id = $_GET['id'];
	}
?>

<?php
	$db = new Database();
	$fm = new Format();
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query = "select * from post where id=$id";
					$post = $db->select($query);
					if($post){
						while($result = $post->fetch_assoc()){
				?>
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?> , By <a href="#"><?php echo $result['author']; ?></a></h4>
				<img src="admin/uploads/<?php echo $result['img']; ?>" alt="post image"/>
				<p><?php echo $result['body']; ?></p>
			
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
						$cat= $result['category'];
						$queryRelated = "select * from post where category= '$cat' order by rand() limit 6";
						$relatedPost = $db->select($queryRelated);
						if($relatedPost){
							while($rresult = $relatedPost->fetch_assoc()){
					?>
					<a href="post.php?id=<?php echo $rresult['id']; ?>"><img src="admin/uploads/<?php echo $rresult['img']; ?>" alt="post image"/></a>
					<?php } } else{
						echo "No Related Posts Available...";
					}
					?>
				</div>
				<?php } } else{
					header("Location: 404.php");
				}?>
	</div>

	</div>
	<?php include 'inc/sidebar.php';?>
	</div>

	<?php include 'inc/footer.php';?>