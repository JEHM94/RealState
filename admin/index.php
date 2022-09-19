<?php
// Imports the Database Connection
require '../includes/config/database.php';
$db = connectDB();

// Query to Get properties
$query = "SELECT * FROM properties";
$queryResult = mysqli_query($db, $query);


// Includes funcions
require '../includes/functions.php';

// Property successfuly added message validation
$message = md5($PROPERTY_REGISTERED);
$result = $_GET['result'] ?? null;


// Includes the site Header
includeTemplate('header');
?>

<main class="container section">
    <h1>Administrador de Bienes Raices</h1>

    <?php if ($result === $message) : ?>
        <p class="alert successful">Propiedad creada correctamente</p>
    <?php endif; ?>

    <a href="/admin/properties/crear.php" class="button button-green">Nueva Propiedad</a>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Show properties result -->
            <?php while($property = mysqli_fetch_assoc($queryResult)) : ?>
            <tr>
                <td><?php echo $property['id']; ?></td>
                <td><?php echo $property['tittle']; ?></td>
                <td> <img src="/images/<?php echo $property['image'];?>" class="table-image" alt="Imagen Propiedad"></td>
                <td>$<?php echo $property['price']; ?></td>
                <td>
                    <a href="#" class="button-yellow-block">Actualizar</a>
                    <a href="#" class="button-red-block">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
//close the DB connection
mysqli_close($db);

// Includes the site Footer
includeTemplate('footer');
?>