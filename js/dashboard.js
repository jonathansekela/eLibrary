/*********************************
Jonathan Sekela
sz12 Library dashboard.js
contains main admin dashboard functions
**********************************/

function getCheckedOutBooks() {
	$.ajax({
		type: "POST",
		url: "php/getCheckedOutBooks.php",
		dataType: "json",
		success: function(result) {
			let htmlresponse = "";
			if (result.length === 0) {
				htmlresponse = "<p>There are currently no checked out books.</p>";
			} else {
				// user|title|date due|overdue
				htmlresponse = "<tr><th>User</th><th>Title</th><th>date due</th><th>overdue</th></tr>";
				// @TODO: parse JSON results, fill htmlresponse with proper rows
				for (let i = 0; i < result.length; i++) {
					htmlresponse += "<tr><td>" + 
					result[i].user_id + "</td><td>" + 
					result[i].title + "</td><td>" + 
					result[i].due_date + "</td><td>";
					if (isOverdue(result[i].due_date))
						htmlresponse += "Yes" + "</td></tr>";
					else htmlresponse += "No" + "</td></tr>";
				}
			}
			$("#checked-out-books").html(htmlresponse);
		},
		error: function(xhr, status, error) {
        	alert("Function getCheckedOutBooks(): " + status + ' ||| ' + error);
        }
	})
}
//=======

function addBookToLibrary(qrcode, title, price) {
	$.post({
		url: "php/addBookToLibrary.php",
		data: {
			qrcode: qrcode,
			title: title,
			price: price
		},
		dataType: "text",
		success: function(res) {
			// @TODO: Finish this function and its related php
		},
		error: function(xhr, status, error) {
			alert("Function addBookToLibrary(): " + status + " ||| " + error);
		}
	})
}
//=======

function removeBookFromLibrary(callback = function(form) {
	// ask for confirmation, remove specified book from library
}) {
	var htmlres = `<div>`;
	// book removal form

}
//=======

function getUsers() {

}
//=======

function getUser() {

}