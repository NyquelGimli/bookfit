<script>
    console.log('testing')
</script>

<?php 
include '../config.php';

$venue_id = $_POST['venue_id'];
$venue_field = $_POST['field'];
$date = $_POST['date'];

$sql = "SELECT * FROM Bookings WHERE venue_id = ".$venue_id." AND venue_field_no = ".$venue_field." AND date = '".$date."'";
$result_query = mysqli_query($conn, $sql);

// echo '<option>'.$sql.'</option>';
// echo '<option>'.$venue_id.'</option>';
// echo '<option>'.$venue_field.'</option>';
// echo '<option>'.$date.'</option>';

$times = array();
for($i = 0; $i < 24; $i++){
    array_push($times, $i);
}

foreach($result_query as $row) {
    $start_time = $row['start_time'];
    $end_time = $row['end_time'];
    for($i = $start_time; $i <= $end_time; $i++){
        $index = array_search($i, $times);
        // echo '<option>'.$index.'</option>';
        unset($times[$index]);
    }
}

for($i = 0; $i <= 23; $i++){
    if(in_array($i, $times) == false){
        echo '<option disabled>'.$i.':00</option>';
    }else{
        echo '<option value='.$i.'>'.$i.':00</option>';
    }
}
?>