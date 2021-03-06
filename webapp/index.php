<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>

        <?php
        if ($_POST) {
            try {
                if (empty($_POST["name"]) || empty($_POST["description"]) || empty($_POST["price"]))
                    throw new Exception("All fields cannot be empty");
                if (!is_numeric($_POST["price"]))
                    throw new Exception("Enter number only for Price");    
                
                include 'classes/product.php';
                $product = new Product($_POST['name'], $_POST['description'], $_POST['price']);
                $result = $product->insertNewProduct();
                // Execute the query
                if ($result) {
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                } else {
                    throw new Exception("Unable to save record.");  
                }
            } catch (Exception $e){
                echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";
            }
        }
        ?>
        <form class="formcreate" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class='form-control' /></td>
                </tr>
                <tr class="des">
                    <td>Description</td>
                    <td><input type='text' name='description[]' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>
        <button class="add-one">Clone the Description Row</form>
        <button class="remove-one">Remove last Description Row</form>
    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('click', function (event) {

            // If the clicked element doesn't have the right selector, bail
            if (event.target.matches('.add-one')) {
                // Get the element
                var elem = document.querySelector('.des');
                // Clone a copy of it
                var clone = elem.cloneNode(true);
                // Inject it into the end of DOM
                elem.after(clone);
            }
            if (event.target.matches('.remove-one')) {
                // get the total number of the element
                var total = document.querySelectorAll('.des').length;
                // not to delete if left only 1
                if (total > 1){
                    var elem = document.querySelector('.des');
                    // Remove the last element
                    elem.remove(elem);
                }
            }        

        }, false);

    </script>
</body>

</html>