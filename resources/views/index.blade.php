<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geocoding</title>
    <style>
        .suggestion-item {
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ccc;
            margin-bottom: 2px;
        }
        .suggestion-item:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h1>Coordinates</h1>
    <form id="addressForm">
        <input type="text" id="addressInput" name="address" placeholder="Enter address" required autocomplete="off">
        <button type="submit">Get Coordinates</button>
    </form>
    <div id="coordinates"></div>
    <div id="suggestions"></div>

    <script>
        document.getElementById('addressForm').addEventListener('submit', function (event) {
            event.preventDefault();
            fetch('/get-coordinates', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    address: event.target.address.value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('coordinates').innerText = data.error;
                } else {
                    document.getElementById('coordinates').innerText = `Latitude: ${data.latitude}, Longitude: ${data.longitude}`;
                }
            });
        });

        document.getElementById('addressInput').addEventListener('input', function () {
    const query = this.value;
    if (query.length > 2) { // Trigger suggestions after typing at least 3 characters
        fetch('/get-suggestions?query=' + encodeURIComponent(query), {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            const suggestionsDiv = document.getElementById('suggestions');
            suggestionsDiv.innerHTML = '';
            if (Array.isArray(data)) {
                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'suggestion-item';
                    div.innerText = item.display_name;
                    div.addEventListener('click', function () {
                        document.getElementById('addressInput').value = item.display_name;
                        suggestionsDiv.innerHTML = '';
                    });
                    suggestionsDiv.appendChild(div);
                });
            } else {
                suggestionsDiv.innerText = 'No suggestions found';
            }
        })
        .catch(error => {
            console.error('Error fetching suggestions:', error);
        });
    }
});

    </script>
</body>
</html>
