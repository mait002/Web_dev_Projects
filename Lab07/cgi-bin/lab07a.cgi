#!/usr/bin/perl -wT 
use CGI':standard';
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);

print "Content-type: text/html\n\n";

print <<"HTML";
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First Perl Program</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Matemasie&display=swap" rel="stylesheet">

    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgb(162, 210, 242);
            color: rgb(14, 61, 100);
            margin: 0;
            padding: 0;
            
        }
        .sour-gummy {
            font-family: "Matemasie", sans-serif;
            font-weight: 400;
            font-style: normal;
            text-align: center;
            font-size: 4rem;
            margin: 30% 0;
        }
        footer{
            background-color: rgb(14, 61, 100);
            color: rgb(162, 210, 242);
            margin: 0;
            padding: 5px;
            text-align: center;
            position: absolute;
            bottom: 0;
            font-size: 1rem;
            width: 100%;

        }
        
  
    </style>
</head>
<body>
    <h2 class="sour-gummy">This is my first Perl Program</h2>
    <footer>Maitreyee Das © 2024, CPS530, Toronto Metropolitan University</footer>

</body>
</html>
HTML
