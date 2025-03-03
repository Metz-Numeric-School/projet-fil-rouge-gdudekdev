document.addEventListener('DOMContentLoaded', function () {
    // Example data, replace with actual data fetching logic
    const stats = {
        totalTrips: 25,
        totalDistance: 1500,
        totalPassengers: 75,
        totalSavings: 300
    };

    document.getElementById('total-trips').textContent = stats.totalTrips;
    document.getElementById('total-distance').textContent = stats.totalDistance + ' km';
    document.getElementById('total-passengers').textContent = stats.totalPassengers;
    document.getElementById('total-savings').textContent = stats.totalSavings + ' €';
});
