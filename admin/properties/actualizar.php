<?php
// Check for valid ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
//If the id is not int redirect back to admin
if (!$id) {
    header('Location: /admin');
}

// Imports the Database Connection
require '../../includes/config/database.php';
$db = connectDB();

//Query to get the property by id
$query = "SELECT * FROM properties WHERE id=${id}";
$result2 = mysqli_query($db, $query);
$property = mysqli_fetch_assoc($result2);

// Query to Get Sellers
$query = "SELECT id, name, lastname FROM sellers";
$result2 = mysqli_query($db, $query);

// Variables
$tittle = $property['tittle'];
$price = $property['price'];
$description = $property['description'];
$bedrooms = $property['bedrooms'];
$wc = $property['wc'];
$parking = $property['parking'];
$sellers_id = $property['sellers_id'];
$propertyImage = $property['image'];

$errors = [];

// Sends the form to the DB
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // mysqli_real_escape_string Validates the data sent by the user
    // to avoid sql injections and scripting

    $tittle = mysqli_escape_string($db, $_POST['tittle']);
    $price = mysqli_escape_string($db, $_POST['price']);
    $description = mysqli_escape_string($db, $_POST['description']);
    $bedrooms = mysqli_escape_string($db, $_POST['bedrooms']);
    $wc = mysqli_escape_string($db, $_POST['wc']);
    $parking = mysqli_escape_string($db, $_POST['parking']);
    $sellers_id = mysqli_escape_string($db, $_POST['sellers_id']);
    $created = date('Y/m/d');

    // Save the file in a variable
    // input name='image'
    $image = $_FILES['image'];

    /******* Form Validations *******/
    // Tittle Validations
    if (!$tittle) {
        $errors[] = "Debes añadir un título";
    }
    // Price Validations
    if (!$price || $price < 1) {
        $errors[] = "El precio es obligatorio";
    }
    if ($price >= 100000000) {
        $errors[] = "El precio debe ser menor a $100,000,000,00";
    }
    // Description Validations
    if (strlen($description) < 10) {
        $errors[] = "La descripción debe contener 10 caracteres o más";
    }
    // Bedrooms Validations
    if (!$bedrooms || $bedrooms < 1) {
        $errors[] = "El número de habitaciones es obligartorio";
    }

    if ($bedrooms >= 10) {
        $errors[] = "La cantidad máxima de habitaciones es de 9";
    }
    // WC Validations
    if (!$wc || $wc < 1) {
        $errors[] = "El número de baños es obligartorio";
    }
    if ($wc >= 10) {
        $errors[] = "La cantidad máxima de baños es de 9";
    }
    // Parking Validations
    if (!$parking || $parking < 1) {
        $errors[] = "El número de estacionamientos es obligartorio";
    }
    if ($parking >= 10) {
        $errors[] = "La cantidad máxima de estacionamientos es de 9";
    }

    if (!$sellers_id) {
        $errors[] = "Debes seleccionar un vendedor";
    }

    // Image size  (max 1mb)
    $maxSize = 1024 * 1000;

    if ($image['size'] > $maxSize) {
        $errors[] = "La Imagen es muy pesada (Máximo 100kb)";
    }



    // if there are no errors then insert
    if (empty($errors)) {

        /* Files upload to the server */
        // Create the image folder if not exists
        $imageFolder = '../../images/';

        if (!is_dir($imageFolder)) {
            mkdir($imageFolder);
        }

        // If there is a new Image then Remove the old Image
        if ($image['name']) {
            // Delete the old Image
            unlink($imageFolder . $property['image']);

            // Create custom unique name
            $imageName = md5(uniqid(rand(), true)) . ".jpg";

            // Upload the new image
            move_uploaded_file($image['tmp_name'], $imageFolder . $imageName);
        } else{
            $imageName = $property['image'];
        }

        // Insert query
        $query = " UPDATE properties SET tittle = '${tittle}', price = ${price}, image = '${imageName}', description = '${description}', bedrooms = ${bedrooms}, wc = ${wc}, parking = ${parking}, sellers_id = ${sellers_id} WHERE id = ${id} ";

        $result = mysqli_query($db, $query);

        if ($result) {
            // After the property is inserted go back to admin
            //This header redirects only if there is not any HTML BEFORE it
            require '../../includes/app.php';
            $message = md5(PROPERTY_UPDATED);
            header('Location: /admin?result=' . $message);
        }
    }
}

require '../../includes/functions.php';
includeTemplate('header');
?>

<main class="container section">
    <h1>Actualizar Propiedad</h1>

    <a href="/admin" class="button button-green">Volver</a>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="form" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="formCreateTittle">Título</label>
            <input id="formCreateTittle" name="tittle" type="text" placeholder="Título de la Propiedad" value="<?php echo $tittle; ?>">

            <label for="formCreatePrice">Precio ($)</label>
            <input id="formCreatePrice" name="price" type="number" placeholder="$100,000" min=0 value="<?php echo $price; ?>">

            <label for="formCreateImage">Image</label>
            <input id="formCreateImage" name="image" type="file" accept="image/jpeg, image/png">

            <img class="small-image" src="/images/<?php echo $propertyImage ?>" alt="Imagen de la Propiedad">

            <label for="formCreateDescription">Descripción</label>
            <textarea id="formCreateDescription" name="description" cols="30" rows="10"><?php echo $description; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Características de la Propiedad</legend>

            <label for="formCreateBRooms">Habitaciones</label>
            <input id="formCreateBRooms" type="number" name="bedrooms" placeholder="0" min=0 max=9 value="<?php echo $bedrooms; ?>">

            <label for="formCreateWC">Baños</label>
            <input id="formCreateWC" type="number" name="wc" placeholder="0" min=0 max=9 value="<?php echo $wc; ?>">

            <label for="formCreateParking">Estacionamientos</label>
            <input id="formCreateParking" type="number" name="parking" placeholder="0" min=0 max=9 value="<?php echo $parking; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select id="formCreateSeller" name="sellers_id">
                <option selected disabled>-Seleccionar-</option>
                <?php while ($seller = mysqli_fetch_assoc($result2)) : ?>
                    <option <?php echo $sellers_id === $seller['id'] ? 'selected' : '' ?> value="<?php echo $seller['id']; ?>">
                        <?php echo $seller['name'] . " " . $seller['lastname']; ?> </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" class="button button-green" value="Actualizar Propiedad">
    </form>

    <?php
    includeTemplate('footer');
    ?>