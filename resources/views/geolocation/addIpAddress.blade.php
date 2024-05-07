<!-- Add this to your showGeoLocation.blade.php view -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add IP Address</title>
    <script>
        document.getElementById('ip_address').addEventListener('input', function() {
            var ipInput = this.value;
            var ipPattern = /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/;
            if (!ipPattern.test(ipInput)) {
                this.setCustomValidity('Enter a valid IP address');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>

    <style>
        /* Form styles */
        .geo-location-form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .btn-submit {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #45a049; /* Darker Green */
        }
    </style>
</head>
<body>

<div class="geo-location-form">
    <h2>Fetch Geolocation</h2>
    <form method="post" action="{{ route('storeGeoLocationInfo') }}">
        @csrf
        <label for="ip_address" class="form-label">Enter IP Address:</label>
        <input type="text" id="ip_address" name="ip_address" class="form-input" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}" title="Enter a valid IP address" required>
        <button type="submit" class="btn-submit">Fetch Geolocation</button>
    </form>

</div>

</body>
</html>
