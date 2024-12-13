<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Tickets</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .ticket-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .ticket-image {
            height: 100%;
            width: 100%;
        }
        .ticket-details {
            padding: 15px;
            background-color: white;
        }
        .ticket-header {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .ticket-info {
            margin-bottom: 5px;
        }
        .ticket-icon {
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="container-fluid mt-4">
    <div class="row">
        <?php foreach($tickets as $ticket) { ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
            <div class="ticket-card">
                <div class="row no-gutters">
                    <div class="col-4">
                        <img src="<?= base_url('getimg/'.$ticket->movieimage) ?>" 
                             alt="<?= $ticket->moviename; ?>" 
                             class="ticket-image">
                    </div>
                    <div class="col-8">
                        <div class="ticket-details">
                            <h5 class="ticket-header"><?= $ticket->moviename ?></h5>
                            <p class="ticket-info">
                                <i class="fas fa-user ticket-icon"></i>
                                User: <?= $ticket->useremail ?>
                            </p>
                            <p class="ticket-info">
                                <i class="fas fa-chair ticket-icon"></i>
                                Seats: <?= implode(', ', $ticket->seats) ?>
                            </p>
                            <p class="ticket-info">
                                <i class="fas fa-ticket-alt ticket-icon"></i>
                                Price: <?= $ticket->price ?>
                            </p>
                            <p class="ticket-info">
                                <i class="fas fa-building ticket-icon"></i>
                                Theatre: PVR, Andheri
                            </p>
                            <p class="ticket-info">
                                <i class="fas fa-clock ticket-icon"></i>
                                Show Time: 8:00 pm
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>