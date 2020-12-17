function displayForm(evt, formName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        if (tabcontent[i].id === 'quote-section') {
            tabcontent[i].style.display = "none";
        }

    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(formName).style.display = "block";
    evt.currentTarget.className += " active";
}

jQuery(document).ready(($) => {
    $('.quote-item-add-button').on('click', (e) => {
        e.preventDefault();
        addQuoteItem();
    });
$('#submit-quote').on('click', (e) => {
   e.preventDefault();
   addQuote();
});
    function addQuoteItem() {
        const anItem = '<div class="quote-list-item"><input id="item" type="text" placeholder="Item"></div>';
        const aCode = '<div class="quote-list-item"><input id="code" type="text" placeholder="Code"></div>';
        const aBook = '<div class="quote-list-item"><input id="book" type="text" placeholder="Book"></div>';
        const aPageNo = '<div class="quote-list-item"><input id="page-no" type="text" placeholder="Page No"></div>';
        const aQty = '<div class="quote-list-item"><input id="quantity" type="text" placeholder="Quantity"></div>';

        $('.quote-list-container').append(anItem + aCode + aBook + aPageNo + aQty);
    }

    function addQuote() {
        $.ajax({
            type: 'POST',
            url: 'wp-admin/admin-ajax.php',
            data: {action: 'dsbf_add_test'},
            success: function (data) {
                var result = JSON.parse(data);
                if (result.success) {
                    console('successful add to firestore');
                } else {

                    console('Error', data, 'data didn\'t save');
                }
            }
        });
    }
});

