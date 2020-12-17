<?php
function dsbf_forms_page_html() {
	?>
    <style>
        html {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .quote-form-container {
            display: none;
            max-width: 800px;
            width: 100%;
            height: 100%;
            background-color: white;
            box-shadow: 6px 6px 18px 0 rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            overflow: hidden;
            padding: 30px;
            margin: 50px;
        }

        .quote-form-container input,
        .quote-form-container textarea {
            display: block;
            width: 100%;
            margin: 20px 0;
            background-color: #fff;
            border: 1px solid #bbb;
            padding: 2px;
            color: #4e4e4e;
            font-family: "Montserrat", Helvetica, Arial, Lucida, sans-serif;
        }

        .quote-form-container label {
            display: block;
            font-weight: 700;
            font-size: 16px;
            float: none;
            line-height: 1.3;
            margin: 0 0 4px;
            padding: 0;
            color: #f65403;
            font-family: "Montserrat", Helvetica, Arial, Lucida, sans-serif;
        }

        button {
            background-color: #ff9900;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #fff;
            font-size: 1em;
            padding: 10px 15px;
            margin: 0 0 20px 0;
        }

        .quote-form-container input:focus,
        .quote-form-container textarea:focus {
            border: 1px solid #999 !important;
        }

        .quote-list-container,
        .quote-list-header-container,
        .client-list-container,
        .client-list-header-container {
            display: grid;
            /* overflow-y: scroll; */
            overflow-x: hidden;
            justify-content: space-around;
            grid-template-columns: repeat(7, 1fr);
            border: 1px solid #aaa;
            min-width: auto;
            max-width: 100%;
            width: auto;
            /* min-height: 100px; */
            /* max-height: 100px; */
            height: 100px;
            padding: 0;
            margin: 0;
        }

        .client-list-container, .client-list-header-container {
            grid-template-columns: repeat(1, 1fr);
        }

        .quote-list-container,
        .client-list-container {
            height: auto;
        }

        .quote-list-header-container,
        .client-list-header-container {
            overflow-y: hidden;
            max-height: 50px;
            height: 50px;
            padding: 0;
            margin: 0;
            background-color: #aaa;
        }


        .quote-list-header,
        .client-list-header {
            min-width: auto;
            max-width: 100%;
            width: auto;
            /* min-height: 25px; */
            max-height: 25px;
            height: auto;
            padding: 20px;
            margin: 20px;
            background-color: #eee;
        }

        .quote-list-item,
        .client-list-item {
            margin: 0;
            padding: 10px;
            border: 1px solid #eee;
            min-height: 20px;
            max-height: 100%;
            height: auto;

        }

        .client-list-item:nth-child(even) {
            background-color: #eee;
        }

        .client-list-item {
            border-left-style: none;
            border-right-style: none;
        }

        .quote-list-item input {
            background-color: white;
            margin: 0;
            padding: -50px 0 100% 0;
            border: none;
            height: 100%;
        }

        .quote-list-item input:focus {
            background-color: #eee;
        }

        .quote-list-header,
        .client-list-header {
            color: #fff;
            background-color: #aaa;
            padding: 5px;
            margin: 5px;
        }

        .quote-item-update-button, .quote-item-calc-button {
            min-width: 60px;
            width: 100px;
            height: auto;
            max-height: 40px;
        }

        #save-quote-button {
            width: 100px;
        }

        .client-item {
            display: inline;
            /* margin-left: auto;
			margin-right: auto; */
            width: 100%;

        }

        .client-item-link:hover {
            background-color: #aaa;
            color: #fff;
        }

        a.client-item-link {
            text-decoration: none;
        }


        .item {
            /* display: inline;
			width: 100px;
			height: 100px;
			margin: auto;  */
            background: tomato;
            padding: 5px;
            width: 100px;
            height: 20px;
            margin-top: 10px;
            line-height: 20px;
            color: white;
            text-align: center;
        }

        .item-container {
            display: flex;
            flex-flow: row wrap;
            align-items: stretch;
            justify-content: space-around;
        }

        .col {
            width: 100px;
            height: auto;
            align-self: auto;
            margin: auto;
            padding: 10px;
        }

        .flex-container {
            display: flex;
            flex-flow: row wrap;
            align-items: stretch;
            justify-content: center;
        }

        .client-list-container {
            list-style-type: none;
            margin: 0;
            padding: 0;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0;
            margin-inline-end: 0;
            padding-inline-start: 40px;
            background-color: #fff;
        }

        .client-list-container > ul > li {
            border-bottom: 1px solid grey;
        }

        .client-item-link {
            color: #aaa;
        }

        .client-list-container {
            margin-left: 0;
            padding-left: 0;
        }

    </style>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <ul class="client-list-container"></ul>
        <br>
        <button type="button" id="refresh-client-list-button">Refresh</button>
        <div class="quote-form-container">
            <form id="quote-form-admin">
                <label for="full-name">Full Name *</label>
                <input type="text" id="full-name" required>

                <label for="email">Email *</label>
                <input type="email" id="email" required>

                <label for="phone">Phone *</label>
                <input type="tel" id="phone" required>

                <label for="subject">Subject *</label>
                <input type="text" id="subject" required>

                <label for="comment">Comment *</label>
                <textarea id="comment"></textarea required>
                <button type="submit" id="update-quote-button">Send</button>
            </form>
            <div class="quote-list-header-container">
                <div class="quote-list-header">Item</div>
                <div class="quote-list-header">Code</div>
                <div class="quote-list-header">Book</div>
                <div class="quote-list-header">Page No</div>
                <div class="quote-list-header">Quantity</div>
                <div class="quote-list-header">Price Ea.</div>
                <div class="quote-list-header">Item Total</div>
            </div>
            <div class="quote-list-container"></div>
            <div class="quote-totals-container">
                <div style="text-align: right;" class="quote-list-item">Total: $
                    <div class="total"></div>
                </div>
            </div>

            <button class="quote-item-update-button">Update</button>
            <button class="quote-item-calc-button">Calc</button>
        </div>
    </div>
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script>

        const clientList =
            [
<?php
                global $wpdb;
//	            $date  = sanitize_text_field( $request['theDate'] );
	            $query = "SELECT * FROM local.utb_clients;";

	            $result = $wpdb->get_results( $query );
                foreach ( $result as $client ) {
                ?>
                {
                    "fullName": "<?php echo $client->fullName; ?>",
                    "email": "<?php echo $client->email; ?>",
                    "phone": "<?php echo $client->phone; ?>"
                },
	            <?php } ?>
            ]

        const data =
            [
                {
                    "item": "Megastar Series Female Football Player",
                    "code": "658-3FA",
                    "book": "Aussie Rules",
                    "pageNo": 2,
                    "quantity": 5,
                    "priceEa.": 0.00,
                    "subTotal": 0.00
                },
                {
                    "item": "Megastar Series Male Football Player",
                    "code": "658-3MA",
                    "book": "Aussie Rules",
                    "pageNo": 3,
                    "quantity": 15,
                    "priceEa": 100.00,
                    "subTotal": 0.00
                }
            ];


        $(document).ready(() => {

            $('#quote-form-admin').change((e) => {
                // e.preventDefault();
                recalc();
            });

            $('.quote-item-calc-button').click(() => {
                // e.preventDefault();
                recalc();
            });

            $('.client-list-container').click((e) => {
                // e.preventDefault();
                let theId = e.target.id;
                let parent = e.target.parentElement.id.substr(1, 'client-item-link-'.length);
                console.log('parent: ' + parent + ', id: ' + theId);
                if (theId === 'client-item-link-') {
                    // retrieve id
                    // retrieve record with id
                } else if (parent === 'client-item-link-') {

                }
            });

            function recalc() {
                let tally = 0.00;
                let idx = 0;
                data.forEach(element => {
                    idx++;
                    tally += parseFloat($('#item-total-' + idx).val());
                });

                $('.total').text(tally.toFixed(2));
                let totalCost = $('.total').text();
            }

            function listQuoteItems() {
                let idx = 0;
                data.forEach(element => {
                    idx++;
                    let anItem = '<div class="quote-list-item">' + element.item + '</div>';
                    let aCode = '<div class="quote-list-item">' + element.code + '</div>';
                    let aBook = '<div class="quote-list-item">' + element.book + '</div>';
                    let aPageNo = '<div class="quote-list-item">' + element.pageNo + '</div>';
                    let aQty = '<div class="quote-list-item">' + element.quantity + '</div>';
                    let priceEa = '<div class="quote-list-item"><input id="price-ea-'
                        + idx
                        + '" type="text" placeholder="Price Each" value="0.00"></div>';
                    let itemTotal = '<div class="quote-list-item"><input id="item-total-'
                        + idx
                        + '" type="text" placeholder="Item Total" value="0.00"></div>';

                    $('.quote-list-container').append(anItem + aCode + aBook + aPageNo + aQty + priceEa + itemTotal);
                });

            }

            function listClients() {
                let idx = 0;
                clientList.forEach(element => {
                    idx++;

                    let fullName = `<li><a href="#" id="client-item-link-${idx}" class="client-item-link client-item flex-container"><span class="col">${element.fullName}</span>`;
                    let email = '<span class="col">' + element.email + '</span>';
                    let phone = '<span class="col">' + element.phone + '</span>'
                        + '</a></li>';

                    $('.client-list-container').append(fullName + email + phone);
                });
            }

            listClients();
            listQuoteItems();
        });

    </script>
	<?php
}
