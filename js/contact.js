document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault();
    // alert("Hey Email Sending Start");

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var subject = document.getElementById("subject").value || "Contact Form Submission";
    var message = document.getElementById("message").value;

    console.log("your name:", name);
    console.log("your email:", email);
    console.log("your subject:", subject);
    console.log("your message:", message);

    var textMessage = "Email from: " + name + "\nEmail address: " + email + "\nEmail Subject: " + subject + "\nMessage: \n" + message;
    var htmlMessage = "Email from: " + name + "<br />Email address: " + email + "<br />Message: " + message.replace(/\n/g, "<br />");
    htmlMessage += "<br /> ---  --- <br />";

    Email.send({
        Host: "smtp.elasticemail.com",
        Username: "codesynergy@elasticsearch.com",
        Password: "0AEA789AFE444CF02B220C14826611E9FC99",
        To: 'smtpserver391@gmail.com',
        From: "pankaj200321@gmail.com",
        Subject:  "Mail From CODESYNERGY =>" + subject,
        Body: htmlMessage
    })
    .then(function (message) {
        document.getElementById("form-message-success").style.display = "block";
        document.getElementById("form-message-success").innerText = "Your message was sent, thank you!";
        document.getElementById("contactForm").reset();
        setTimeout(function() {
            document.getElementById("form-message-success").innerText = "";
        }, 5000);
    
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("form-message-warning").style.display = "block";
        document.getElementById("form-message-warning").innerText = "Something went wrong. Please try again later.";
        setTimeout(function() {
            document.getElementById("form-message-warning").innerText = "";
        }, 5000);
    });

});
