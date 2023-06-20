<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>New contact has been added!</h1>

    <p>New contact added:</p>

    <p>Name: {{ $contact->first_name }}</p>
    <p>Email Adddress: {{ $contact->email }}</p>
    <p>Message: {{ $contact->message }}</p>

</body>

</html>