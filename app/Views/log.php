<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    
  

    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: tomato;
        }
        .table-hover tbody tr:hover {
            background-color:;
        }
        .email-mismatch {
            background-color: #ffdddd;
            color: #ff0000;
        }
        h4{
            color:white;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        <h2 >User Logs</h2>
        
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>User ID</th>
                            <th>User Email</th>
                           
                            <th>Login Time</th>
                            <th>Logout Time</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <?php 
                            // Find matching log for this ticket
                          
                            foreach($log as $logs) {
                            
                         
                            ?>
                            <tr>
                                <td><?= $logs['_id'] ?></td>
                                <td><?= $logs['email'] ?></td>
                                <td><?= $logs['login'] ?></td>
                                <td><?= $logs['logout'] ?><td>
                            
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</body>
</html>