let itemIndex = 0;
const ITEM_TOTAL_MAX = 20;
const CONTACT = 0;
const QUOTE = 1;
let formType = CONTACT;


function displayForm(evt, formName) {
    // Declare all variables
    let i, tabcontent, tablinks;

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
        addQuoteItemRow();
    });

    $('.quote-item-delete-button').on('click', (e) => {
        e.preventDefault();
        deleteQuoteItem();
    });

    $('#submit-quote').on('click', (e) => {
        e.preventDefault();
        saveQuote();
    });

    async function addQuoteItemRow() {
        console.log(itemIndex);
        if (itemIndex + 1 < ITEM_TOTAL_MAX) {
            itemIndex++;
            const anItem = `<div class="quote-list-item"><input id="item-${itemIndex}" type="text" placeholder="Item"></div>`;
            const aCode = `<div class="quote-list-item"><input id="code-${itemIndex}" type="text" placeholder="Code"></div>`;
            const aBook = `<div class="quote-list-item"><textarea id="book-${itemIndex}" type="text" placeholder="Book" rows="1" cols="50"></textarea></div>`;
            const aPageNo = `<div class="quote-list-item"><input id="page-no-${itemIndex}" type="text" placeholder="Page No"></div>`;
            const aQty = `<div class="quote-list-item"><input id="quantity-${itemIndex}" type="text" placeholder="Quantity"></div>`;

            const row = anItem + aCode + aBook + aPageNo + aQty;

            $('.quote-list-container').append(row);
        } else {
            await Swal.fire({
                position: 'center',
                title: 'You have reached the entry limit of 20 items',
                icon: 'warning',
            })
        }
    }

    async function deleteQuoteItem() {
        if (itemIndex > 0) {
            let count = $(".quote-list-container div").children().length;
            let x = 5;
            while (x > 0 && count > 5) {
                $('.quote-list-item').last().remove();
                count = $(".quote-list-container div").length;
                x--;
            }
            itemIndex--
        } else {
            await Swal.fire({
                position: 'center',
                title: 'You can not delete the first item row   ',
                icon: 'warning',
            })
        }
    }

    function saveQuote() {
        let itemCollection;
        if (formType === CONTACT) {
            const fullName = $('#full-name').val();
            const email = $('#email').val();
            const phone = $('#phone').val();
            const subject = $('#subject').val();
            const comment = $('#comment').val();

            const contactData = {
                action: 'process_contact_form',
                fullName: fullName,
                email: email,
                phone: phone,
                subject: subject,
                comment: comment,
            };

            $.ajax({
                type: 'post',
                url: '<?php echo get_home_url(); ?>/wp-admin/admin-ajax.php',
                action: 'process_form_response',
                data: contactData,
                dataType: 'json',
                success: function (data) {
                    let result = JSON.parse(data);
                    if (result.success) {
                        console('successful add to firestore');
                    } else {
                        console('Error', data, 'data didn\'t save');
                    }
                }
            });
        } else {
            itemCollection = [];
            let itemCount = $('.quote-list-container').children('.quote-list-item').length / 5;

            for (let idx = 0; idx < itemCount; idx++) {
                let anItem = {
                    item: $(`#item-${idx}`).val(),
                    code: $(`#code-${idx}`).val(),
                    book: $(`#book-${idx}`).val(),
                    pageNo: $(`#page-no-${idx}`).val(),
                    quantity: $(`#quantity-${idx}`).val()
                }
                itemCollection.push(anItem);
            }

            contactData.items = itemCollection;
            let quoteData = contactData;

            $.ajax({
                type: 'post',
                url: '<?php echo get_home_url(); ?>/wp-admin/admin-ajax.php',
                action: 'process_form_response',
                data: quoteData,
                dataType: 'json',
                success: function (data) {
                    let result = JSON.parse(data);
                    if (result.success) {
                        console('successful add to firestore');
                    } else {
                        console('Error', data, 'data didn\'t save');
                    }
                }
            });
        }
    }
});

