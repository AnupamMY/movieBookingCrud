<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="<?= base_url('movie.css')?>"> 
</head>
<body>
<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <div class="first-item">
    <a class="navbar-brand" href="/home">Movies</a>
    <?php if(session()->get('role') == 'admin') {?>
    <a class="navbar-brand" href="#AddMovieModal" data-toggle="modal">Add Movie</a>
    <?php } ?>
    </div>
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn" type="submit">Search</button>
        <a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a>
      </form>
  </div>
</nav>
    <div class="container  single">
        <div class="row">
            <div class="col-md-6">
                <img class="" style="height:500px;" src= "<?=$movie->img?>"alt="">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h1 class="card-title mb-2"><?= $movie->title ?></h1>
                    <p><span class="card-subtitle text-muted">Genre:</span> <span><?= $movie->genre ?></span></p>
                    <p><span class="card-subtitle text-muted">Director:</span> <span><?= $movie->director ?></span></p>
                    <p><span class="card-subtitle text-muted">Release Date:</span> <span><?= $movie->release_date ?></span></p>
                    <p><span class="card-subtitle text-muted">Description:</span> <span><?= $movie->description ?></span></p>
                    <?php if(session()->get('role') == 'user') {?>
                    <a class="btn-primary btn" aria-current="page" role="button" href="/bookTicket/<?= $movie->_id?>">Book Tickets</a>
                    <?php }?>
                    <?php if(session()->get('role') == 'admin') { ?>
                <a class="btn-primary btn " data-toggle id="delete" aria-current="page" role="button" del_id="<?= $movie->_id ?>" ><i class="fa-solid fa-trash"></i></a>
                <a class="btn-primary btn" data-toggle="modal" aria-current="page" role="button" href="#editEmployeeModal"><i class="fa-solid fa-pen"></i></a>
                <?php }?>    
            </div>
               
                
            </div>
        </div>
    </div>
    
    <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url()."editMovie/".$movie->_id ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Movie</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="title">Title</label><br>
                    <input type="text" class="field" name="title" id="title" value="<?=$movie->title?>" required><br>

                    <label for="description">Description</label><br>
                    <input type="text" class="field" name="description" id="description" value="<?=$movie->description?>" required><br>

                    <label for="genre">Genre</label><br>
                    <input type="text" class="field" name="genre" id="genre" value="<?=$movie->genre?>" required><br>

                    <label for="director">Director</label><br>
                    <input type="text" class="field" name="director" id="director" value="<?=$movie->director?>" required><br>

                    <label for="releaseDate">Release Date</label><br>
                    <input type="date" name="release-date" id="releaseDate" value="<?=$movie->release_date?>" required><br>

                    <label for="upload-image">Upload Image</label><br>
                    <input type="file" name="file" id="upload-image" required><br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Include Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let deleteButtons = document.querySelector('#delete');
        let a = deleteButtons.getAttribute('del_id');
        //console.log(a);
        deleteButtons.addEventListener('click', () => {
                let check = confirm('Are you sure you want to delete this movie?')
                 if (check) {
                     window.location.href = `http://localhost:8080/delete/${a}`;
                 }else{
                     console.log("not deleted");
                 }
             });
    </script>
</body>
</html>