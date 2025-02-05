#!/usr/bin/env python3

import cgi

# Retrieve form data
form = cgi.FieldStorage()
city = form.getvalue("city", "").upper()
province = form.getvalue("province", "").upper()
country = form.getvalue("country", "").upper()
image_url = form.getvalue("image_url", "")

# Print HTML content
print("Content-type: text/html\n")
print(f"""
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Information - Python</title>
    <style>
        body {{
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #eaeaea;
            color: #444;
        }}
        h1 {{
            font-size: 3em;
            color: #fff;
            background-color: #28a745;
            padding: 10px;
            margin-bottom: 20px;
        }}
        img {{
            width: 80%;
            height: auto;
            border: 10px solid #007BFF;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }}
    </style>
</head>
<body>
    <h1>{city}, {country}</h1>
    <h2>{province}</h2>
    <img src="{image_url}" alt="Image of {city}">
</body>
</html>
""")
