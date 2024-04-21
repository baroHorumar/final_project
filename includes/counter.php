<?php
include '../includes/conn.php';

// Build the query to select all categories
$query = "SELECT DISTINCT category FROM blog";

// Execute the query
$result = mysqli_query($conn, $query);

// Check for errors (optional but recommended)
if (!$result) {
    echo json_encode(array("error" => "Error fetching categories: " . mysqli_error($conn)));
    exit;
}

// Initialize total count and categories array
$totalCount = 0;
$categories = [];

// Extract categories and their counts
while ($row = mysqli_fetch_assoc($result)) {
    $categoryName = $row['category'];
    $countQuery = "SELECT COUNT(*) AS count FROM blog WHERE category='$categoryName'";
    $countResult = mysqli_query($conn, $countQuery);
    if ($countResult) {
        $countRow = mysqli_fetch_assoc($countResult);
        $count = $countRow['count'];
        $totalCount += $count; // Increment total count
        $categories[$categoryName] = $count; // Store category count
    } else {
        echo json_encode(array("error" => "Error fetching count for category: $categoryName"));
        exit;
    }
}

// Sort categories by count in descending order
arsort($categories);

// Initialize an array to hold category data
$categoryData = [];

// Calculate and store percentages for top three categories
$topThreeCategories = array_slice($categories, 0, 3);
foreach ($topThreeCategories as $categoryName => $count) {
    $percentage = ($count / $totalCount) * 100;
    $categoryData[] = array("category" => $categoryName, "percentage" => number_format($percentage, 2));
    unset($categories[$categoryName]); // Remove top three categories from the list
}

// Aggregate the count of remaining categories under "Other"
$otherCount = array_sum($categories);
$otherPercentage = ($otherCount / $totalCount) * 100;
$categoryData[] = array("category" => "Other", "percentage" => number_format($otherPercentage, 2));

// Close the connection
mysqli_close($conn);

// Output category data as JSON
echo json_encode($categoryData);
