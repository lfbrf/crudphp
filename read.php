<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $username = $row["username"];
                $cep = $row["cep"];
                $house_number = $row["street"];
                $complement = $row["house_number"];
                $house_number = $row["complement"];
                $neighborhood = $row["neighborhood"];
                 $city = $row["city"];
                  $state = $row["state"];
                $comercial_phone = $row["comercial_phone"];
                $fix_phone = $row["fix_phone"];
                $mobile_phone = $row["mobile_phone"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Algo deu errado, tente novamente.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Nome de usuario</label>
                        <p class="form-control-static"><?php echo $row["username"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Cep</label>
                        <p class="form-control-static"><?php echo $row["cep"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Numero da casa</label>
                        <p class="form-control-static"><?php echo $row["street"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Complemento</label>
                        <p class="form-control-static"><?php echo $row["house_number"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Bairro</label>
                        <p class="form-control-static"><?php echo $row["complement"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Bairro</label>
                        <p class="form-control-static"><?php echo $row["neighborhood"]; ?></p>
                    </div>
                   <div class="form-group">
                        <label>Cidade</label>
                        <p class="form-control-static"><?php echo $row["city"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <p class="form-control-static"><?php echo $row["state"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Telefone Comercial</label>
                        <p class="form-control-static"><?php echo $row["comercial_phone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Telefone Fixo</label>
                        <p class="form-control-static"><?php echo $row["fix_phone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Telefone Celular</label>
                        <p class="form-control-static"><?php echo $row["mobile_phone"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>