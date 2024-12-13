<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('movie.css')?>"> 
</head>
<body>
    <h1>Ticket</h1>
    <?php
      //print_r($tickets);
      //echo($tickets['_id']);
      //print_r($ticketPrice);
    ?>
    <div class="container-ticket">
        <div class="row">
            <div class="col-md-6">
                <img class="" style="height:500px;" src= "<?=$ticketPrice['img']?>"alt="">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h1 class="card-title mb-2"><?= $ticketPrice['title'] ?></h1>
                   

                    <p><span class="card-subtitle text-muted">Release Date:</span> <span><?= $ticketPrice['release_date'] ?></span></p>
                        <p>Seats :
                    <?php 
                      echo implode(",",$ticketPrice['seats']);
                      ?></p>
                </div>
                <p class="price"><span class="card-subtitle text-muted">Price:</span><span><?= $ticketPrice['totalprice']?></span></p>
                <button class="confirm-ticket">Confirm Ticket</button>
            </div>
            
        </div>
    </div> 

    
</body>
</html>