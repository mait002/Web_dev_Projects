/*

Create one web page containing the solutions to all three problems. 
You can use jQuery or vanilla JavaScript for problems 1 and 2.  
You must use jQuery or a combination of jQuery and vanilla JavaScript for problem 3.

Problem 1:
* Create a form that asks the user for their name, address and phone number. For the phone number use the (area code) exchange-number (416) 555-5555 format.
* Write a JavaScript function to validate the form items name and phone number (a name cannot have anything but letters and 
  the phone number must be exactly as shown: 3 digits in parentheses, followed by 3 digits, a dash and 4 digits.
* Write a JavaScript function to transform the phone number into the area code- exchange-number format like 416-555-5555.
* Write a JavaScript function to display the name, address and phone number (with the new format) with large characters and an attractive appearance. Be creative!
* Create a button that will validate the form and produce the final display. Use the DOM only, you cannot refresh the page or use a server-side program to produce the final display.

Problem 2: 
Write a JavaScript function that counts in real time the number of characters in a <textarea> form element. 
Have the number updated in real time and shown in large font next to the input form element. 
Create a second function that counts only the letters (A-Z and a-z) and display that count as well next to the input form.

Problem 3: 
Write a function that when you click an image, it becomes full screen (have the image size increase slowly as an animation). 
In the full screen image, place an icon so that when you click it, the image reverts to its original size and position. 
Use Google Material Icons for the icon.

*/

// ----------------------------------------------- Part 1: -----------------------------------------------------

$("#form").submit( function(event){
    event.preventDefault();

    const form = $("#form");
    
    const name = $("#name").val();
    const address = $("#address").val();
    const phone = $("#phone").val();

    const finalDisplay = $("#finalDisplay");
    finalDisplay.empty();

    if (validateName(name) && validatePhone(phone)){
        display(name, phoneFormat(phone), address);
        hideForm(form);
    }
    else{
        let errMsg = '';
        if (!validateName(name) && validatePhone(phone)){
            errMsg = "Invalid input in the name field (NAME MUST ONLY CONTAIN ALPHABETS)";
    
        }
        else if (!validatePhone(phone) && validateName(name)){
            errMsg = "Invalid input in the phone# field (PHONE NUMBER MUST BE EXACTLY AS SHOWN: 3 digits in parentheses, followed by 3 digits, a dash and 4 digits)";
        }
        else{
            errMsg = "Invalid input in the name and phone# fields (NAME MUST ONLY CONTAIN ALPHABETS & PHONE NUMBER MUST BE EXACTLY AS SHOWN: 3 digits in parentheses, followed by 3 digits, a dash and 4 digits)";
    

        }

        const output = $("<h2>").text(errMsg);
        finalDisplay.append(output);

    }
    

    

    

    
    
});

function validateName(name){
    return /^[a-z]+$/i.test(name);
}

function validatePhone(phone){
    return phone.match(/\(\d{3}\)\d{3}\-\d{4}/);
    
}


function phoneFormat(phone){
    var areaCode = phone.slice(1, 4);
    var exchange = phone.slice(5, 8);
    var number = phone.slice(9);

    return areaCode + "-" + exchange + "-" + number;
}


function display(name, phone, address){
    const finalDisplay = $("#finalDisplay");
    finalDisplay.empty();

    const formattedName = $("<h2>").text(name);
    formattedName.attr("class", "name");

    const formattedAddress = $("<h3>").text(address);
    formattedAddress.attr("class", "address");

    const formattedPhone = $("<h3>").text("Contact#: " + phone);
    formattedPhone.attr("class", "phone");

    finalDisplay.append(formattedName);
    finalDisplay.append(formattedAddress);
    finalDisplay.append(formattedPhone);

}

function hideForm(form){
    return form.css("display", "none");
}
// -------------------------------------------------- x --------------------------------------------------------

// ----------------------------------------------- Part 2: -----------------------------------------------------

$("#notebox").on("input", function(event){
    const characters = $("#notebox").val();
    event.preventDefault();
    charCount(characters);
    alphaCount(characters);
});

function charCount(characters){
    $("#charCount").text(characters.length);
    
}

function alphaCount(characters){
    let count = 0;

    for (let i = 0; i < characters.length; i++){
        if (characters.charAt(i).match(/[a-z]/i)){
            count++;
        }
    }

    $("#alphaCount").text(count);
}


// -------------------------------------------------- x --------------------------------------------------------

// ----------------------------------------------- Part 3: -----------------------------------------------------
const thirdPart = $("#third");
const image = $("#image");


$("img").click(function(event){

    event.preventDefault();

    
    image.attr("class", "large");

    const button = $("<img>").attr("src", "./assets/close.svg").attr("id", "revert");

    thirdPart.append(image);
    thirdPart.append(button);

    $("#revert").click(function(event){
        event.preventDefault();
    
        image.removeClass("large").addClass("small");
       
    
        button.remove();
    
    });

});

// -------------------------------------------------- x --------------------------------------------------------
