<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(90deg, rgba(238, 249, 255, 1) 0%, rgba(251, 251, 251, 1) 0%, rgba(215, 240, 246, 1) 37%, rgba(202, 243, 255, 1) 56%, rgba(93, 221, 247, 1) 100%);
        }
        .confirmation_class {
            text-align: center;
            background: #f0f8ff66;
            padding: 70px;
            border-radius: .4rem;
        }
        .confirmation_class i {
    font-size: 25px; 
    color: #333; 
}
        .confirmation_class input {
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 80%
        }
    </style>
    <title>Confirmation</title>
</head>
<body>
    <div class="confirmation_class">
        <i class="fa-solid fa-unlock-keyhole"></i>
        <h4>Confirmation</h4>
        <label for="code" style="display: none;">Enter code confirmation</label>
        <input type="text" name="code" id="code" placeholder="Enter code confirmation">
    </div>
</body>
</html>
