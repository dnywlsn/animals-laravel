<!DOCTYPE html>
<html>
<head>
    <title>Adoption Inquiry</title>
</head>
<body>
    <h1>New Inquiry Received</h1>
    <p>User <strong>{{ $user->name }}</strong> ({{ $user->email }}) is interested in adopting <strong>{{ $animal->name }}</strong>.</p>
    <p>Animal Species: {{ $animal->species }}</p>
    <p>Please follow up with the user as soon as possible.</p>
    <hr>
    <p>This is an automated message from Astana Animal Shelter.</p>
</body>
</html>
