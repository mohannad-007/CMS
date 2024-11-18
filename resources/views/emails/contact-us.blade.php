<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Al-Naweia Information ContactUs</title>
</head>
<body>
<h2>Details of the message:</h2>
<p><strong>Rate:</strong> {{ $contactData['rate'] }}</p>
<p><strong>Problem/information:</strong> {{ $contactData['information_problem'] }}</p>
<p><strong>Sender's email address:</strong> {{ $contactData['email'] }}</p>
</body>
</html>
