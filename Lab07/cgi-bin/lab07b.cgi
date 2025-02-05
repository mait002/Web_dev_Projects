#!/usr/bin/perl -wT
use strict;
use CGI ':standard';
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);

# Retrieve form data
my $first_name = param('first_name');
my $last_name = param('last_name');
my $street = param('street');
my $city = param('city');
my $province = param('province');
my $postal_code = param('postal_code');
my $phone = param('phone');
my $email = param('email');
my $photo = upload('photo');

# Validation patterns
my $phone_pattern = qr/^\d{10}$/;
my $postal_code_pattern = qr/^[A-Z]\d[A-Z] \d[A-Z]\d$/;
my $email_pattern = qr/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,6}$/;

# Error messages
my @errors;
push @errors, "Invalid phone number (must be 10 digits)" unless $phone =~ $phone_pattern;
push @errors, "Invalid postal code format (L0L 0L0)" unless $postal_code =~ $postal_code_pattern;
push @errors, "Invalid email address format" unless $email =~ $email_pattern;

# HTML header
print header("text/html");

# If there are errors, display them
if (@errors) {
    print start_html(-title => "Error in Submission", -style => { -code => "body { font-family: Arial; color: red; text-align: center; }"});
    print h2("There were errors in your submission:");
    print ul(li(\@errors));
    print p(a({-href => "../lab07/lab07b.html"}, "Return to the form"));
    print end_html;
    exit;
}

# If all data is valid, display the submitted information
print start_html(-title => "Registration Successful", -style => { -code => "body { font-family: Arial; color: darkblue; text-align: center; } .info { font-size: 1.2em; color: darkgreen; margin: 10px 0; }"});
print h2("Registration Successful!");
print p({-class => 'info'}, "Name: $first_name $last_name");
print p({-class => 'info'}, "Address: $street, $city, $province, $postal_code");
print p({-class => 'info'}, "Phone: $phone");
print p({-class => 'info'}, "Email: $email");



# Define a safe directory for upload
my $upload_dir = "/home/mdasurmi/public_html/lab07/pictures";

# Get the filename from the upload object and extract the extension
my $original_filename = param('photo');
my $extension;

# Only allow certain extensions (jpg, png, gif)
if ($original_filename =~ /\.(jpg|jpeg|png|gif)$/i) {
    $extension = lc $1;  # Get and normalize the extension
} else {
    die "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
}

# Generate a safe filename by only allowing certain characters and appending the correct extension
my $filename = "$first_name\_$last_name.$extension";
if ($filename =~ /^([\w.-]+)$/) {
    $filename = $1;  # Untaint the filename
} else {
    die "Invalid filename";
}

# Combine the directory and filename into the full path
my $photo_path = "$upload_dir/$filename";

if ($photo) {
    open(my $out, '>', $photo_path) or die "Could not save photo: $!";
    binmode $out;
    while (my $bytesread = read($photo, my $buffer, 1024)) {
        print $out $buffer;
    }
    close($out);

    # Display the uploaded photo
    print img({
        -src => "../lab07/pictures/$filename",  # Adjust URL to match web path
        -alt => "Uploaded Photo",
        -width => '150px',
        -height => '150px'
    });
}


print end_html;