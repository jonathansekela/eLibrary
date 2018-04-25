/*********************************
Jonathan Sekela
sz12 Library qrcode-scanner.js
contains qrcode scanner functions
**********************************/
// @TODO: remove default values from function params

//======== QR Code Scanner ========//
// @TODO: Change to jQuery friendly
// @TODO: add login cookie functionality for when real users happen
var onQRCodeScanned = (scannedText) => {
	var scannedTextMemo = document.getElementById("scannedTextMemo");
    if (isANumber(scannedText)
        && parseInt(scannedText) < 1000
        && parseInt(scannedText) > 0) {
        
        isInLibrary(parseInt(scannedText), function(isAvailable) {
        	if (isAvailable) {
            	getBook(parseInt(scannedText), 1);// @TODO: change to proper uid code
        	} else {
				alert("Sorry, this book is currently unavailable. Please scan a book from our library.");
        	}
        });
    } else {
        alert("That is not a library book. Please scan a book from our library.");
    }

	if(scannedTextMemo) {
		scannedTextMemo.innerHTML = scannedText;
	}
	var scannedTextMemoHist = document.getElementById("scannedTextMemoHist");
	if(scannedTextMemoHist) {
		scannedTextMemoHist.innerHTML = scannedTextMemoHist.innerHTML + '<p>' + scannedText + '</p>';
	}
}
//========

//this function will be called when JsQRScanner is ready to use
var JsQRScannerReady = () => {
    //create a new scanner passing to it a callback function that will be invoked when
    //the scanner succesfully scans a QR code
    var jbScanner = new JsQRScanner(onQRCodeScanned);
    //reduce the size of analyzed image to increase performance on mobile devices
    jbScanner.setSnapImageMaxSize(300);
	var scannerParentElement = document.getElementById("scanner");
	if(scannerParentElement)
	{
	    //append the jbScanner to an existing DOM element
		jbScanner.appendTo(scannerParentElement);
	}        
}