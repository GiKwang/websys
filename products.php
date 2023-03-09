<?php

function get_products($names) {
    // Create database connection
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }

    // Retrieve products data from database
    if (empty($names)) {
        $sql = "SELECT name, brand, price, imageSrc, link FROM products";
    } else {
        $placeholders = implode(',', array_fill(0, count($names), '?'));
        $sql = "SELECT name, brand, price, imageSrc, link FROM products WHERE name IN ($placeholders)";
    }

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters, if any
    if (!empty($names)) {
        $stmt->bind_param(str_repeat('s', count($names)), ...$names);
    }

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate product cards dynamically
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="pro" onclick="window.location.href = \'' . $row['link'] . '\';">';
            echo '<img src="' . $row['imageSrc'] . '" alt="' . $row['imageSrc'] . '">';
            echo '<div class="des">';
            echo '<span>' . $row['brand'] . '</span>';
            echo '<h5>' . $row['name'] . '</h5>';
            echo '<div class="star">';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '</div>';
            echo '<h4>$' . $row['price'] . '</h4>';
            echo '</div>';
            echo '<a href="#"><i class="fal fa-shopping-cart cart"></i></a>';
            echo '</div>';
        }
    } else {
        echo "No products found.";
    }

    // Close database connection
    $stmt->close();
    mysqli_close($conn);
}

?>
