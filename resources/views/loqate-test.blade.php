<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loqate Address Validation Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .container { max-width: 600px; margin-top: 80px; }
        .card { box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .result-box { background: #fff; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <div class="card p-4">
        <h4 class="mb-3 text-center">🏠 Loqate Address Validation</h4>
        <form id="lookupForm">
            @csrf
            <div class="mb-3">
                <label for="address" class="form-label">Enter Address or Postal Code</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="e.g., 221B Baker Street, London" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Validate Address</button>
        </form>
        <hr>
        <div id="results" class="result-box d-none">
            <h6>Results:</h6>
            <pre id="output" class="bg-light p-2 border rounded"></pre>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#lookupForm').on('submit', function(e) {
    e.preventDefault();
    let address = $('#address').val();

    $.ajax({
        url: '/loqate/lookup',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            address: address
        },
        success: function(res) {
            $('#results').removeClass('d-none');
            $('#output').text(JSON.stringify(res, null, 2));
        },
        error: function(err) {
            $('#results').removeClass('d-none');
            $('#output').text('Error connecting to Loqate API');
        }
    });
});
</script>
</body>
</html>
