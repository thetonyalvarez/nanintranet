// old script - does not work on safari
function copyToClipboard() {
		const str = '<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head><body>' + document.getElementById("compiled-signature").innerHTML + '</body></html>';

		function listener(e) {
			e.clipboardData.setData("text/html", str);
			e.clipboardData.setData("text/plain", str);
			e.preventDefault();
		}
		document.addEventListener("copy", listener);
		document.execCommand("copy");
		document.removeEventListener("copy", listener);
	};






// Current script - works on safari
jQuery(function() {

    function selectElementContents(el) {
        var range = document.createRange();
        range.selectNodeContents(el);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
	};
	
	function copyToClipboard(data) {

		const str = '<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head><body>' + data + '</body></html>';

        function listener(e) {
            e.clipboardData.setData("text/html", str);
            e.clipboardData.setData("text/plain", str);
            e.preventDefault();
        }

        document.addEventListener("copy", listener);
        document.execCommand("copy");
        document.removeEventListener("copy", listener);
    };

    function copyHtmlToClipboard() {
        var dataHtmlElement = document.getElementById("compiled-signature");

        dataHtmlElement.contentEditable = true;
        dataHtmlElement.readOnly = false;

        selectElementContents(dataHtmlElement);
        copyToClipboard(dataHtmlElement.innerHTML);

        dataHtmlElement.contentEditable = false;
        dataHtmlElement.readOnly = true;

        window.getSelection().removeAllRanges();
    };


    var button = jQuery("button")
    button.on("click", copyHtmlToClipboard)

});






