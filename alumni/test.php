<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Download Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            /* Light gray background color */
            padding: 20px;
            /* Add padding to the card */
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            color: #777;
            margin-bottom: 20px;
        }

        .btn-download-container {
            text-align: center;
        }

        .btn-download {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .btn-download:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Download Title</h5>
                        <p class="card-text">Your download description goes here. Provide some details about what users will get by downloading this resource.</p>
                        <div class="btn-download-container">
                            <a href="#" class="btn btn-download">Download Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>