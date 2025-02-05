#!/usr/bin/env ruby

require "cgi"

cgi = CGI.new

# Retrieve form data
city = cgi["city"].capitalize
province = cgi["province"].capitalize unless cgi["province"].empty?
country = cgi["country"].capitalize
image_url = cgi["image_url"]

# Print HTML content
puts "Content-type: text/html\n\n"
puts <<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Information - Ruby</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            font-size: 3em;
            color: #fff;
            background-color: #007BFF;
            padding: 10px;
            margin-bottom: 20px;
        }
        img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>#{city}, #{country}</h1>
    <h2>#{province}</h2>
    <img src="#{image_url}" alt="Image of #{city}">
</body>
</html>
HTML
