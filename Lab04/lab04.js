/*
Create a function that creates a list of bookmarks for your favourite websites. 
Have the function display each bookmark URL on a separate line along with an icon indicating if the link is 
secure or not (https vs. http). Use a closed green padlock icon for secure and an opened red or grey 
padlock for unsecured. Show at least 2 URLs (one http and one https).

*/
document.getElementById("form1").addEventListener("submit", function (event) {
    event.preventDefault();
    const numOfWeb = document.getElementById("numOfWeb").value;
    getWebsites(numOfWeb);

});

document.getElementById("myBookmarks").addEventListener("click", function () {
    const bookmarks = [
        { url: "https://developer.mozilla.org/en-US/docs/Web/HTML", name: "MDN: HTML" },
        { url: "https://www.youtube.com/", name: "YouTube" },
        { url: "http://127.0.0.1:3000/lab03.html", name: "FileNotFound_1" },
        { url: "http://127.0.0.1:3000/index.html", name: "FileNotFound_2" }
    ];
    createBookmarks(bookmarks);
});


const createBookmarks = (bookmarks) => {

    
        
    
    const preRL = document.getElementById("resultList");
    if (preRL) {
        preRL.setAttribute("class", "");
    }

    document.getElementById("resultTitle").textContent = "Result: ";
    const divElement = document.getElementById("resultList");
    divElement.setAttribute("class", "resultList");

    const bookmarkList = document.getElementById("bookmarks");

    bookmarkList.innerHTML = '';

    bookmarks.forEach(bookmark => {
        const listItem = document.createElement("li");

        const isSecure = bookmark.url.startsWith("https");
        const icon = document.createElement("img");
        
        
        if (isSecure) {
            icon.setAttribute("src", "./assets/lock-solid.svg");
            icon.setAttribute("alt", "green closed padlock")
        }
        else {
            icon.setAttribute("src", "./assets/unlock-solid.svg");
            icon.setAttribute("alt", "red open padlock")
        }

        const link = document.createElement("a");
        link.href = bookmark.url;
        link.textContent = bookmark.name;
        link.target = "_blank";

        listItem.appendChild(icon);
        listItem.appendChild(document.createTextNode(" "));
        listItem.appendChild(link);

        bookmarkList.appendChild(listItem);
    });
    

    


}

const getWebsites = (noOfWebsites) => {
    
    
    const form = document.createElement("form");
    form.setAttribute("id", "websiteForm");


    for (var i = 0; i < noOfWebsites; i++){
        

        const label = document.createElement("label");
        label.setAttribute("for", "website");
        label.textContent = `Website ${i + 1}: `;

        const inputText = document.createElement("input");
        inputText.setAttribute("id", "website");
        inputText.setAttribute("type", "text");
        inputText.setAttribute('name', `website${i}`);
        inputText.setAttribute('placeholder', 'Enter website URL and name (separate by a comma)');
        inputText.setAttribute('required', 'true');


        const inputSub = document.createElement("input");
        inputSub.setAttribute("id", "subWeb");
        inputSub.setAttribute("type", "submit");

        form.appendChild(label);
        form.appendChild(inputText);

        form.appendChild(document.createElement('br'));
        form.appendChild(document.createElement('br')); 

        
    }

    const submitBtn = document.createElement("input");
    submitBtn.setAttribute("type", "submit");
    submitBtn.setAttribute("value", "Submit Websites");
    submitBtn.setAttribute("class", "btn")
    form.appendChild(submitBtn);

    const prevForm = document.getElementById("websiteForm");
    if (prevForm) {
        prevForm.remove();
    }
    document.getElementById("webForm").appendChild(form);

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const numOfWeb = document.getElementById("numOfWeb").value;
        getInput(numOfWeb);
    });
};

const getInput = (numOfWeb) => {
    const bookmarks = [];

    for (let i = 0; i < numOfWeb; i++){
        const input_vals = document.querySelector(`[name="website${i}"]`).value;
        const input_lst = input_vals.split(',');
        const url = input_lst[0];
        const name = input_lst[1];

        bookmarks.push({ url: url, name: name });
    }
    
    createBookmarks(bookmarks);
    
}

/*
A string is a palindrome if it reads the same from front to back as it does from back to front 
(e.g. "kayak", "rotator"  and "noon" are palindromes). 
When determining whether an alphanumeric string is a palindrome, we often ignore spaces, 
punctuation and case in the string (e.g. "A man, a plan, a canal --Panama!" is also considered a palindrome).
Write a JavaScript function that determines whether a string is a palindrome, and write a message 
indicating whether it is or isn't. 
Before that, you will need to write a function to remove all spaces, punctuation, and turn 
uppercase letters into lowercase letters).

*/

document.getElementById("palindrome").addEventListener("submit", function (event) {
    event.preventDefault();

    
    var palToCheck = document.getElementById("palTest").value;
    trimSentence(palToCheck);
});

function trimSentence(palToCheck) {
    var trimmed = palToCheck.toLowerCase().replaceAll(/[\W_]/g, "");

    testPal(trimmed, palToCheck);
    //const new_sen = document.createElement("p");
    //new_sen.textContent = `${trimmed}`;
    //document.body.appendChild(new_sen);

}

function testPal(trimmed, palToCheck) {

    var len = trimmed.length;
    var mid_idx = Math.floor(len / 2);
    var firstHalf = "";
    var lastHalf = "";
    var testPass = false;

    const prevP = document.getElementById("result");
    if (prevP) {
        prevP.remove();
    }

    const paragraph = document.createElement("p");
    paragraph.setAttribute("id", "result");

    
    if (len % 2 === 0) {
        firstHalf = trimmed.slice(0, mid_idx);
        lastHalf = trimmed.slice(mid_idx).split('').reverse().join('');
        if (firstHalf === lastHalf) {
            testPass = true;
        }
    }
    else {
        firstHalf = trimmed.slice(0, mid_idx);
        lastHalf = trimmed.slice(mid_idx+1).split('').reverse().join('');
        if (firstHalf == lastHalf) {
            testPass = true;
        }
    }

    if (testPass) {
        paragraph.textContent = `${palToCheck} is a Palindrome!`;
    }
    else {
        paragraph.textContent = `${palToCheck} is not a Palindrome.`;
    }

    
    document.getElementById("part2").appendChild(paragraph);
}