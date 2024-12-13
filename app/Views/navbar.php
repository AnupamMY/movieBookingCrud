<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    <link rel="stylesheet" href="<?= base_url('movie.css')?>"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <div class="first-item">
    <a class="navbar-brand" href="/home">Movies</a>
     
    <?php if(session()->get('role') == 'admin') {?>
    <a class="navbar-brand" href="#AddMovieModal" data-toggle="modal">Add Movie</a>
    <a class="navbar-brand" href="#AllMovieModal" data-toggle="modal">All Tickets</a>
    <a class="navbar-brand" href="/logs" >Logs</a>
    <?php } ?>  
</div>
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search"name="search" placeholder="Search" aria-label="Search">
        <button class="btn" type="submit">Search</button>
        <?php if(session()->get('role') == 'user') {?>
            <p>Hi, <?= session()->get('user') ?></p>
        <?php } ?> 
        <a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a>

      </form>
  </div>
</nav>

<div id="AddMovieModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url().'update'?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title">Add Movie</h3>
                    <a class="close" data-dismiss="modal">&times;</a>
                </div>
                <div class="modal-body">
                
                   <label for="title">Title</label></br>
                    <input class="field" type="text" name="title"></br>
                    <label for="description">Description</label></br>
                    <input class="field" type="text" name="description"></br>  
                     <label for="genre">Genre</label></br>
                     <input class="field" type="text" name="genre"></br>
                     <label for="director">Director</label></br>
                     <input class="field" type="text" name="director"></br>

                     <label for="releaseDate">Release Date</label></br>
                     <input type="date" name="release-date"></br>
        
                     <label for="Upload-image"></label></br>
                     <input type="file" class="upload" name="file"></br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include AllMovie -->

<div id="AllMovieModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
         
                <div class="modal-header">
                    <h3 class="modal-title">All Tickets</h3>
                 
                </div>
                <div class="modal-body">
                <?php foreach($ticketPrice as $ticket){?>

                    <div class="tickets">
                       <img class="ticket-img" src="<?=$ticket['img']?>" alt=""/>
                       <div class="ticket-detail">
                          <p>Movie Name: <span><?= $ticket['title']?></span></p>
                          <p>Show Date<span><?= $ticket['release_date']?></span></p>
                          <p>Seats: <span><?php echo implode(",",$ticket['seats'])?></span></p>
                          <p>Price: <span><?= $ticket['totalprice']?></span></p>
                       </div>
                       
                     </div>
                     <hr>
                    <?php }?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>


<!-- Include Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>