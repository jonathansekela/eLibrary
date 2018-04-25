/*******************************
Jonathan Sekela
sz12 library utility functions
*******************************/
function isAnInt(aChar) {
	var numcheck = RegExp(/\d/);
	return numcheck.test(aChar);
}
//=======

function isANumber(aString) {
	for (var i = 0; i < aString.length; i++) {
		if (!isAnInt(aString[i])) return false;
	}
	return true;
}
//=======

function isalpha(aChar) {
	var lettercheck = RegExp(/\w/);
	return lettercheck.test(aChar);
}
//=======

function isspace(aChar) {
	var spacecheck = RegExp(/\s/);
	return spacecheck.test(aChar);
}
//=======

function isalnum(aChar) {
	if (!isAnInt(aChar) && !isalpha(aChar)) return false;
	return true;
}
//=======

function isnewline(aChar) {
	var newlinecheck = RegExp(/\n/);
	return newlinecheck.test(aChar);
}
//=======

// function takes a date
// assumes booksDueDate = string
// booksDueDate format: yyyy-mm-dd
function isOverdue (booksDueDate) {
    let todaysDate = new Date(Date.now()).toLocaleString();
    mdy = todaysDate.substr(0, 9); // format: [m]m/[d]d/yyyy
    let thisYear = ""; let thisMonth = ""; let today = "";
    // get today
    while (mdy[0] != '/') {
        thisMonth += mdy[0];
        mdy = mdy.substr(1);
    }
    today = parseInt(today);
    mdy = mdy.substr(1); // remove '/'
    // get thisMonth
    while (mdy[0] != '/') {
        today += mdy[0];
        mdy = mdy.substr(1);
    }
    thisMonth = parseInt(thisMonth);
    mdy = mdy.substr(1); // remove '/'
    // get thisYear
    while (mdy.length > 1) {
        thisYear += mdy[0];
        mdy = mdy.substr(1);
    }
    thisYear += mdy; // get last char from mdy
    thisYear = parseInt(thisYear);

    let dueDay = parseInt(booksDueDate.substr(8));
    let dueMonth = parseInt(booksDueDate.substr(5, 2));
    let dueYear = parseInt(booksDueDate.substr(0, 4));
    return (dueYear < thisYear || dueMonth < thisMonth || dueDay < today);
}