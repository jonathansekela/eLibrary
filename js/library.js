/*********************************
Jonathan Sekela
sz12 Library library.js
contains main library functions
JQuery required
**********************************/

// function to checkout a book from the library
function checkout(qrcodeNo, userID) {
    $.ajax({
    	type: "POST",
    	url: "php/checkout.php",
    	dataType: "text",
        // @TODO: add scanner functionality to populate qrcode,
        //  add functionality to populate user
        data:
        {
            qrcode: qrcodeNo,
            user: userID
        },
    	success: function(result) {
    		// change #button-text to house result (for now)
            // @TODO: delete errorcheck when done
    		$('#button-text').html(result);
        },
        error: function(xhr, status, error) {
        	alert(status + ' ||| ' + error);
        }
	});
}
//========

// function to return a checked-out book to the library
function returnBook(qrcodeNo, userID) {
    $.ajax({
        type: "POST",
        url: "php/return.php",
        data:
        {
            qrcode: qrcodeNo,
            user: userID
        },
        success: function(result) {
            $("#button-text").html(result);
            console.log(result);
        },
        dataType: "text",
        error: function(xhr, status, error) {
            alert("Function returnBook: " + xhr + " ||| " + status + " ||| "+error);
        }
    })
}
//========

// Function to check if a book is in the db or not
// ONLY returns true or false
function isInLibrary(bookID, callback) {
    let bookAvail = 0;
    $.ajax({
        type: "POST",
        url: "php/isInLibrary.php",
        data: {
            book: bookID
        },
        dataType: "text",
        // if book is available, return true. else, return false.
        success: function(result) {
            let obj = JSON.parse(result);
            callback(obj.is_available === 1)
        },
        error: function(xhr, status, error) {
            alert(status + ' ' + error);
            callback(false);
        }
    });
}
//=======

// function to get book and display information & options
//  for book on page
// used to enable user checkout of books
function getBook(bookID, userNo) {
    // check if user has overdue books
    $.ajax({
        type: "POST",
        url: "php/getBook.php",
        data: {
            book: bookID,
            user: userNo
        },
        dataType: "json",
        success: function(result) {
            // check book availability, check user current checked out books,
            //  structure htmlresponse based on these 2 factors.
            scannedTitle = result.title;
            scannedqrcode = result.qrcode;

            getMyBooks(userNo, function(mybooks) {
                let response = "";
                    for (var i = 0; i < mybooks.length; i++) {
                        if (isOverdue(mybooks[i].due_date)) {
                            // user has overdue books
                            response += "Sorry! You currently have an overdue book: " + mybooks[i].title + " was due on " + dueDate + "<br>";
                        }
                    }
                // user has no overdue or currently checked out books
                if (response === "") {// @TODO: Clean this statement up somehow
                    response += "Would you like to checkout " + scannedTitle + "?"
                    + "<div class='btn-group' role='group' aria-label='...'><button type='button' class='btn btn-default' onClick='checkout(" + scannedqrcode + ", " + userNo + ");'>Yes</button><button type='button' class='btn btn-default'>No</button></div>";
                }
                $("#button-text").html(response);
            });
        },
        error: function(xhr, status, error) {
            alert("Function getBook: " + status + ' ' + error);
        }
    })
}
//=======

// function to show current user all books
//  they currently have checked out
function getMyBooks(user, callback = function(result) {
                                            var htmlresponse = "";
                                            if (result.length > 0) {
                                                for (var i = 0; i < result.length; i++) {
                                                    htmlresponse += "Title: " + result[i].title + "<br>";
                                                    htmlresponse += "due date: " + result[i].due_date + "<br>";
                                                }
                                            } else {
                                                htmlresponse = "You currently have no checked-out or overdue books.";
                                            }
                                            $("#button-text").html(htmlresponse);
                                        }
) {
    $.ajax({
        type: "POST",
        url: "php/getMyBooks.php",
        data: {
            // @TODO: need current user id - a cookie?
            user: user
        },
        dataType: "json",
        success: callback(result),
        error: function(xhr, status, error) {
            alert("getMyBooks error: " + xhr + ' ||| ' + status + ' ||| ' + error);
        }
    })
}