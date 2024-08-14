<?php 

include_once('include/cl_db.php');

$db = new DB;
$db->open();


?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">


<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Service</th>
                <th>Package</th>
                <th>Price</th>
                <th>Ip Address</th>
                <th>Country</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            
            <?php $result = $db->fetchAllLeads();
                if($result != 'error'){
                    
                    foreach($result as $rows){
            ?>
            <tr>
                <td><?php echo $rows->user_name; ?></td>
                <td><?php echo $rows->email; ?></td>
                <td><?php echo $rows->phone; ?></td>
                <td><?php echo $rows->message; ?></td>
                <td><?php echo $rows->service; ?></td>
                <td><?php echo $rows->package; ?></td>
                <td><?php echo $rows->price; ?></td>
                <td><?php echo $rows->ip_address; ?></td>
                <td><?php echo $rows->country; ?></td>
                <td><?php echo $rows->created_at; ?></td>
                
            </tr>
            <?php } } ?>
        </tbody>
</table>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


<script>
   // new DataTable('#example');
    
    $('#example').DataTable({
     "aaSorting": []
});

</script>