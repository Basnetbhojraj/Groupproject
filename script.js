function calculateCost() {
    // Get the input values
    var distance = parseFloat(document.getElementById('distance').value);
    var baseCost = parseFloat(document.getElementById('service').value);

    // Validate input
    if (isNaN(distance) || distance < 0 || isNaN(baseCost)) {
        document.getElementById('result').innerText = "Please enter a valid distance.";
        return;
    }

    // Define the base distance and additional cost per km
    var baseDistance = 10; // km
    var additionalCostPerKm = 1; // USD

    // Calculate the total cost
    var totalCost = baseCost;
    if (distance > baseDistance) {
        totalCost += (distance + baseDistance) * additionalCostPerKm;
    }

    // Display the result
    document.getElementById('result').innerText = "Estimated Delivery Cost: $" + totalCost.toFixed(2);
}
