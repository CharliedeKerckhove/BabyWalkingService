<?php
	// Get last 5 reviews
	$query = "SELECT * FROM reviews ORDER BY ReviewID DESC LIMIT 5";
	$result = $DBH->prepare($query);
	$result->execute();

    // Get all ratings
	$query1 = "SELECT * FROM reviews ORDER BY ReviewID DESC";
	$result1 = $DBH->prepare($query1);
	$result1->execute();
    $numReviews = $result1->rowCount();

    // Get average rating
	$query2 = "SELECT AVG(ReviewScore) AS rating_average FROM reviews";
	$result2 = $DBH->prepare($query2);
	$result2->execute();
	$reviewData = $result2->fetch(PDO::FETCH_ASSOC);
?>
    <div class="content">
        <h3>Average Carer Rating</h3>
        <!--round average rating-->
        <?php echo round($reviewData['rating_average'], 1)."/5   From ".$numReviews." reviews";?>

        <div class="reviews">
            <h2>Latest Reviews</h2>
            <!--display latest reviews-->
            <?php 
            if($result->rowCount()>0){
                while($allReviews=$result->fetch(PDO::FETCH_ASSOC)){
            ?>

                <div class="reviewData">
                    <h4 class="reviewName"><?php echo $allReviews['ReviewName'];?></h4>
                    <span class="reviewScore"><?php echo $allReviews['ReviewScore']."/5";?></span>
                </div>
                <div class="reviewText">
                    <span><?php echo $allReviews['ReviewText'];?></span>
                </div>
                <?php }}else{ $reviews = "No reviews available";} 
        if(!empty($reviews)){
        echo '<h2 class="errormsg">'.$reviews.'<br><br></h2>';} ?>
        </div>
    </div>
