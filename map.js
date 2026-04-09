// Create the map
const map = L.map("food-map").setView([-33.8688, 151.2093], 5);

// Add map tiles
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution: "&copy; OpenStreetMap contributors"
}).addTo(map);

// Restaurant data
const restaurants = [
  {
    name: "Bennelong",
    city: "Sydney",
    price: "$$$",
    rating: "4.8/5",
    coords: [-33.8568, 151.2153]
  },
  {
    name: "Chin Chin",
    city: "Melbourne",
    price: "$$",
    rating: "4.6/5",
    coords: [-37.8159, 144.9692]
  },
  {
    name: "Julius Pizzeria",
    city: "Brisbane",
    price: "$$",
    rating: "4.5/5",
    coords: [-27.4748, 153.0170]
  },
  {
    name: "Petition Kitchen",
    city: "Perth",
    price: "$$$",
    rating: "4.4/5",
    coords: [-31.9523, 115.8613]
  },
  {
    name: "Shobosho",
    city: "Adelaide",
    price: "$$$",
    rating: "4.7/5",
    coords: [-34.9226, 138.5999]
  }
];

// Store markers so buttons can open them
const markers = [];

// Add markers
restaurants.forEach((place) => {
  const marker = L.marker(place.coords).addTo(map);

  marker.bindPopup(`
    <strong>${place.name}</strong><br>
    Area: ${place.city}<br>
    Price: ${place.price}<br>
    Rating: ${place.rating}
  `);

  markers.push({
    name: place.name,
    marker: marker,
    coords: place.coords
  });
});

// Right-side buttons: zoom to location
const locationButtons = document.querySelectorAll(".location-btn");

locationButtons.forEach((button) => {
  button.addEventListener("click", function () {
    const lat = parseFloat(this.dataset.lat);
    const lng = parseFloat(this.dataset.lng);
    const name = this.dataset.name;

    map.setView([lat, lng], 14);

    const selectedMarker = markers.find((item) => item.name === name);
    if (selectedMarker) {
      selectedMarker.marker.openPopup();
    }
  });
});