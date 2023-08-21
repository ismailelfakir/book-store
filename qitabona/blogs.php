<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

    <!--   --- script link                       -->
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   
</div>

<section class="blogs">

 <h1  style="color:#5C7D8E;"><q cite=""> Losing yourself in a book is the ultimate relaxation</q></h1> <br> <br>
  <h3 class="intro">  <p style = "text-indent:1cm;">We all know that reading helps to create a better sight of the World, by discovering diffirent
  peoples experiences, cultures, languages...And a lot of more amzing things. Reading has a lot of benefits both for personal
  enjoyment and for the positive impact it can have on our lifes and as we always say <span style="color:#2A4057;"> <strong> The more you read the better you see</strong> </span>.
<br>
<span style="color:#2A4057;"> <strong>QITABONA community</strong></span> lists some of the  main reasons why reading is so important  :
</p>
</h3>


<div class="brain" >
    <img src="brain.jpg" height="250px" >
<div>
  <h1 class="brain">Reading trains your Brain</h1>
  <p style = "text-indent:1cm;"> Reading is a workout for your brain that improves focus and memory
     function because it's one of the few activities that requires your undivided attention, therefore, improving your ability to concentrate.
     It can be also a great way to improve your creativity,
     as it can help you to expose yourself to new ideas and perspectives that can stimulate your imagination
      and help you to think more creatively. When you read, you are engaging in a mental activity
    that requires you to process and interpret information, which can help to exercise your brain and keep it active.
 </p></div>
</div>


<div class="brain">
  <img  src="OIP.jpg" height="250px" width="445px" alt="" >
<div>
<h1 class="entertainment" >Reading is a Form of free Entertainment</h1>
<p style = "text-indent:1cm;"> Did you know that most of the popular TV shows and movies are based on books?Many people find reading to be a relaxing and enjoyable activity that they can do in their spare time. So why not indulge
in the original form of entertainment by immersing yourself in reading and allowing it to explore new worlds, learn about different
cultures and people, and engage with interesting ideas and stories
<strong>without having to pay any money!!!! </strong> <br>
<a  style="color:#2A4057;" href="https://www.tckpublishing.com/best-movies-based-on-books/#:~:text=25%20Best%20Movies%20Based%20on%20Books%201%201.,%282005%29%208%208.%20Harry%20Potter%20%282002-2011%29%20%C3%89l%C3%A9ments%20suppl%C3%A9mentaires">Here are some examples of movies based on books</a>
</p></div>
</div>

<div class="brain" >
  <img src="R.jpg" height="250px" width="445px" alt="" >
<div>
<h1 class="knowledge" >Reading Increases  General Knowledge</h1>
<p style = "text-indent:1cm;">Reading can certainly increase your general knowledge and broaden your understanding of
  a wide range of topics. When you read, you expose yourself to new ideas, information, and perspectives,
   which can help you to better understand the world around you and make more informed decisions.
   Reading also helps to improve your critical thinking skills,
   as you are exposed to different viewpoints and must evaluate and analyze what you are reading. <br>
 Additionally, reading can help to expand your vocabulary and improve your communication skills.
 Overall, reading is a great way to learn and grow intellectually. </p></h4>
 </div>
 </div>




<div class="brain">
  <img  src="MENTAL.jpg" height="250px" width="445px" alt="" >
  <div>
  <h1 class="mental">Reading  Improves your mental health</h1>
<p style = "text-indent:1cm;">reading can be a great way to improve your mental health and well-being.
   It can provide a sense of relaxation and enjoyment, as well as cognitive and social benefits.
 It can be also a relaxing activity that helps you unwind and de-stress after a long day.
 Engaging with a good book can help you forget about your worries and distractions for a little while. </strong> <br>
It can also be an enjoyable and fulfilling hobby,
which can boost your self-esteem and sense of accomplishment.
</p></div>
</div>


<div class="comment"  >
    <form action="" method="post" >
        <h1 style="text-align:center;"> <legend>Share your toughts here !!!</legend> </h1>
      <input required type="text" name="name" value="" placeholder="Full name"> <br>
      <input  type="email" name="email" value="" placeholder="xxxx@gmail.com"> <br>
      <textarea required name="comment" rows="8" cols="80" placeholder="Your comment"></textarea> <br>
    <input type="submit" name="submit" value="Submit" >
    </form>
</div>
<div class="display-comment">
<h1 style="color:#2A4057;">Comments section</h1>
<?php

// Connect to the database

if (isset($_POST['submit'])) {
    // Get the comment from the form
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$mail = mysqli_real_escape_string($conn, $_POST['email']);
    // Insert the comment into the database
    $query = "INSERT INTO comment (nom,email,comment) VALUES ('$name','$mail','$comment')";
    mysqli_query($conn, $query);
     mysqli_close($conn);
}
// Fetch the comments from the database
$query = "SELECT * FROM comment ORDER BY id DESC LIMIT 4";
$result = mysqli_query($conn, $query);

// Display the comments
while ($row = mysqli_fetch_assoc($result)) {
    echo  "<strong>".$row['nom'] ."</strong>"."<br>" ."<div class=\"ligne\">". $row['comment'] ."</div>"."<br>";

}
// Close the connection
mysqli_close($conn);
?>
<button  id="see-more" >See More</button> <br>
</div>
<script>

  // Add a click event listener to the "See More" button
  document.getElementById('see-more').addEventListener('click', function() {
    // Send an AJAX request to the server to retrieve more comments
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'comments.php?offset=4');
    xhr.onload = function() {
      // Append the new comments to the page
      document.querySelector('.display-comment').innerHTML += xhr.responseText;
    };
    xhr.send();
  });
</script>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>