<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="<?= base_url('movie.css')?>"> 
    <title>Document</title>
</head>
<body>


<div class="container">   
    <div class="column is-full">
		    <h3 class="has-text-white">Movies Collection</h3>
		</div>    
  <div class="columns is-multiline p-0 pt-6 last">
		        
  <?php foreach($movies as $index => $movie) {
    // echo $movie["_id"];
    if (!isset($movie["img"])) {
        return "Title not available for this movie.\n";
    } 

  ?>
	<div class="column is-one-quarter new" data-id="<?= $movie["_id"]?>">
       <img  src="<?= $movie["img"]?>" alt="">
    </div>
		
     <?php } ?>
	</div>
</div>



<script  src="<?= base_url('js/bootstrap.min.js')?>"> 
</script>  
<script>
    const newPage = document.querySelectorAll(".new")
    newPage.forEach((item) => {
    item.addEventListener("click", () => {
    const id  = item.getAttribute("data-id")  
    console.log(id);
    window.location.href = `http://localhost:8080/movieDetails/${id}`;
     console.log("clicked");
  })  
  })
  
</script>
</body>
</html>