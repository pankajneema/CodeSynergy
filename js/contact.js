

document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault();
    alert("start");
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var subject = document.getElementById("subject").value;
    var message = document.getElementById("message").value;
    console.log("your name +",name);
	console.log("your email +",email);
	console.log("your subject +",subject);
	console.log("your message +",message);

    if (subject === '') {
        subject = "Contact Form Submission";
    }

    var textMessage = "Email from: " + name + "\nEmail address: " + email + "\nEmail Subject: " + subject + "\nMessage: \n" + message;
    var htmlMessage = "Email from: " + name + "<br />Email address: " + email + "<br />Message: " + message.replace(/\n/g, "<br />");
    htmlMessage += "<br /> ---  --- <br />";

    var postData = {
        from: { email: 'MS_MQJxca@trial-zr6ke4nj7jmgon12.mlsender.net' },
        to: [{ email: 'pankaj200321@gmail.com' }],
        subject: "Incoming From Portfolio - " + subject,
        text: textMessage,
        html: htmlMessage
    };

    fetch('https://api.mailersend.com/v1/email', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + 'mlsn.9cb07ac92c343359c5e50dbde15075163a9a1b574b1cee90e77aff2281f65dd6' // Replace with your MailerSend API token
        },
        body: JSON.stringify(postData)
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.message === 'OK') {
            document.getElementById("form-message-success").style.display = "block";
            document.getElementById("form-message-success").innerText = "Your message was sent, thank you!";
            document.getElementById("contactForm").reset();
        } else {
            document.getElementById("form-message-warning").style.display = "block";
            document.getElementById("form-message-warning").innerText = "Something went wrong. Please try again later.";
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("form-message-warning").style.display = "block";
        document.getElementById("form-message-warning").innerText = "Something went wrong. Please try again later.";
    });
});


