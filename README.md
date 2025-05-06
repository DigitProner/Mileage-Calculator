
# Mileage & Cost Calculator

A web-based mileage calculator that helps users compute trip distances, cost per mile, and travel expenses with optional markup, free mile thresholds, and trip history logging — powered by Google Maps.

## 🚗 Features

- Google Maps-based distance calculation (origin to destination)
- Round trip option with automatic doubling of distance and free miles
- Optional stop (waypoint) support
- Per-mile cost calculation with markup percentage
- "First X Miles Are Free" deduction
- Trip saving and recent history (stored in localStorage)
- Downloadable PDF summaries
- CSV export of full trip logs
- Responsive layout for desktop and mobile
- Auto-fill destination fields with Google Autocomplete
- Use current location (Geolocation API)
- Optional Work Order and Company Name fields


## 🧰 Tech Stack

- **HTML5 + CSS3 + JavaScript (Vanilla)**
- **Google Maps JavaScript API**
  - Places API
  - Distance Matrix API
- **jsPDF** for client-side PDF generation
- `localStorage` for saving trip data
- Optional backend: PHP for secure proxying of Google API calls

## 📌 Folder Structure

```
📁 mileage-calculator/
├── index.html                   # Main calculator
├── trip_history.html            # Full history with CSV export
├── api/
│   └── calculate.php            # Proxy for Google Distance Matrix
```

## ⚙️ Setup Instructions

1. Clone this repository:
   ```bash
   git clone https://github.com/your-username/mileage-calculator.git
   ```

2. Create an `api/env.php` file:
   ```php
   <?php
   return [
     'GOOGLE_MAPS_API_KEY' => 'your-backend-api-key'
   ];
   ```

3. Ensure the following Google APIs are enabled:
   - Maps JavaScript API
   - Distance Matrix API
   - Places API

4. Replace the frontend API key in your `<script>`:
   ```html
   <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_FRONTEND_KEY&libraries=places"></script>
   ```

5. Launch with any local server (e.g. PHP, Apache, XAMPP):
   ```bash
   php -S localhost:8000
   ```

## 🛡 Security Considerations

- Frontend and backend API keys are separated
- Backend key is IP-restricted and used server-side only

## 📋 TODO

- [ ] Add waypoint support to calculation backend
- [ ] Optional authentication and cloud sync
- [ ] Trip filtering and tag-based search
- [ ] Multi-vehicle support

## 📄 License

MIT License
