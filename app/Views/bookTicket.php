<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    
</head>
<style>
    body{
        background-color: black;
        color: white;
    }
    .container-ticket{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 90vh;
        background-color: black;
    }
    .container-ticket .bottom{
        margin-top: 20px;
        display: flex;
        gap: 20px;
    }
    .container-ticket .bottom button{
        padding: 10px 20px;
        height: 40px;
        border-radius: 5px;
        border: none;
        background-color: red;
        color: white;
        cursor: pointer;
    }
    </style>    
<body>
    <div class="container-ticket">
        <h1>Select Seats</h1>
    <input type="hidden" id="movieid" value="<?= $id?>">
    <div class="seat">
    <?php  
    foreach($seat as $key => $value){
        $row = $key;
        foreach($value as $k => $v){
           $seats =$row.$v;
           //echo $seats;
           if(in_array($seats,$occupiedSeats)){?>
            
            <input type='checkbox' class='seat-boxes h-100' style="width:30px; height: 30px" name='seat[]' value='<?php echo $seats?>' disabled>
            <?php }   else{ ?>
             <input type='checkbox' style="width:30px; height: 30px" class='boxes' name='seat[]' value='<?php echo $seats?>'>
            <?php  }
    }
    echo "<br>";
    
    }
    ?>
    </div>
    <div class="bottom">
    <p class="price" >0</p>
    <button class="submit" >Submit</button>
    </div>
</div>
</body>
<script>
    var boxes = document.querySelectorAll('.boxes');

selectedSeats = [];
let price = 0
let money = document.querySelector('.price');

boxes.forEach((box) => {    
    box.addEventListener('click', () => {
        if (box.checked == true) {
            selectedSeats.push(box.value);
            price += 250;
            money.innerHTML = price;
        }
        else {
            if (selectedSeats != []) {
                var index = selectedSeats.indexOf(box.value);
                selectedSeats.splice(index, 1);
                price -= 250;
                money.innerHTML = price;
            }
        }
    })
})


document.querySelector('.submit').addEventListener('click', function (e) {
    
    var bookedseats = selectedSeats.join("_");
    id = document.getElementById("movieid").value;
    console.log(id);
    console.log(bookedseats);
    if (bookedseats == "") {
        return alert("Please select a seat")
    }
    confirm(`Are you sure you want to book this seats ${bookedseats}?`)
    window.location.href = `http://localhost:8080/book/${id}/${bookedseats}/${price}`;
})
</script>
</html>