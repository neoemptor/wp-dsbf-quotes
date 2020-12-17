<?php
function dsbf_show_form_shortcode() {
	$content = "
    <script
            src=\"https://code.jquery.com/jquery-3.5.1.min.js\"
            integrity=\"sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=\"
            crossorigin=\"anonymous\">
	</script>
	<script>
	jQuery(document).ready(($) => {
		const CONTACT = 1;
		const QUOTE = 2;
		let itemCount = 1;
		let formType = CONTACT;	 
		
        function displayForm(evt, formName) {
            // Declare all variables
            let i, tabcontent, tablinks;

            // Get all elements with class=\"tabcontent\" and hide them
            tabcontent = document.getElementsByClassName(\"tabcontent\");
            for (i = 0; i < tabcontent.length; i++) {
                if (tabcontent[i].id === \"quote-section\") {
                    tabcontent[i].style.display = \"none\";
                }
            }

            // Get all elements with class=\"tablinks\" and remove the class \"active\"
            tablinks = document.getElementsByClassName(\"tablinks\");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(\" active\", \"\");
            }

            // Show the current tab, and add an \"active\" class to the button that opened the tab
            document.getElementById(formName).style.display = \"block\";
            evt.currentTarget.className += \" active\";
        }

	    $(\".quote-item-add-button\").on(\"click\", (e) => {
	        e.preventDefault();
	        addQuoteItem();
	    });

	    function addQuoteItem() {
	        const anItem = '<div class=\"quote-list-item\"><input id=\"item\" type=\"text\" placeholder=\"Item\"></div>';
	        const aCode = '<div class=\"quote-list-item\"><input id=\"code\" type=\"text\" placeholder=\"Code\"></div>';
	        const aBook = '<div class=\"quote-list-item\"><input id=\"book\" type=\"text\" placeholder=\"Book\"></div>';
	        const aPageNo = '<div class=\"quote-list-item\"><input id=\"page-no\" type=\"text\" placeholder=\"Page No\"></div>';
	        const aQty = '<div class=\"quote-list-item\"><input id=\"quantity\" type=\"text\" placeholder=\"Quantity\"></div>';
	
	        $(\".quote-list-container\").append(anItem + aCode + aBook + aPageNo + aQty);
	    }			    
	    $(\"#submit-quote\").click(() => {
	    
	    const fullName = $(\"#full-name\").val();
	    const email = $(\"#email\").val();
	    const phone = $(\"#phone\").val();
	    const theSubject = $(\"#subject\").val();
	    
				$.ajax({
                            type: \"post\",
                                url: \"<?php echo get_home_url(); ?>/wp-admin/admin-ajax.php\",
                                data: {
                                    action: \"process_contact_form\",
                                    fullName: fullName,
                                    email: email,
                                    phone: phone,
                                    subject: theSubject,
                                    comments: comments,
                                    items: itemCollection,
                                },
                                dataType: \"json\",
                                success: function (data) {
                                    }
                                });  
                            });            	    
	    });
</script>
<style>
html {
    font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif;
}

.quote-form-container {
    max-width: 800px;
    width: 100%;
    height: 100%;
    background-color: white;
    box-shadow: 6px 6px 18px 0px rgba(0, 0, 0, 0.3);
    border-radius: 20px;
    overflow: hidden;
    padding: 30px;
    margin: 0 50px;
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
    font-family: \"Montserrat\", Helvetica, Arial, Lucida, sans-serif;
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
    font-family: \"Montserrat\", Helvetica, Arial, Lucida, sans-serif;
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
.quote-list-header-container {
    display: grid;
    overflow-y: scroll;
    overflow-x: hidden;
    justify-content: space-around;
    grid-template-columns: repeat(5, 1fr);
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

.quote-list-container {
    height: auto;
}

.quote-list-header-container {
    overflow-y: hidden;
    max-height: 50px;
    height: 50px;
    padding: 0;
    margin: 0;
    background-color: #aaa;
}

.quote-list-item,
.quote-list-header {
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

.quote-list-item {
    margin: 0;
    padding: 0;
    border: 1px solid #eee;
    min-height: 20px;
    max-height: 20px;
    height: 20px;
}

.quote-list-item input {
    margin: 0;
    padding: 0;
    border: none;

}

.quote-list-item input::placeholder {
    color: #ddd;
}

.quote-list-header {
    color: #fff;
    background-color: #aaa;
    padding: 5px;
    margin: 5px;
}

.quote-item-add-button {
    min-width: 60px;
    width: 60px;
    height: auto;
    max-height: 40px;
}

/* ============================================= TAB STYLING ============================================ */

/* Style the tab */
.tab {
    overflow: hidden;
    /*border: 1px solid #ccc;*/
    background-color: #f1f1f1;
    max-width: 800px;
    width: 100%;
    margin-left: 50px;
    margin-right: 0;
    padding: 0 30px;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    color: black;
    margin: 0;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    /*display: none;*/
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}

#quote-section {
    display: none;
}

.qandc-container {
    margin-left: auto;
    margin-right: auto;
    width: 800px;

}
</style>
<div class=\"qandc-container\">
	<div class=\"tab\">
		<button class=\"tablinks active\" onclick=\"displayForm(event, 'client-quote');\">Contact</button>
		<button class=\"tablinks\" onclick=\"displayForm(event, 'quote-section');\">Quote</button>
	</div>
	<div class=\"form-container\">
		<div class=\"quote-form-container\">
			<form id=\"client-quote\" class=\"tabcontent\">
				<label for=\"full-name\">Full Name *</label>
				<input type=\"text\" id=\"full-name\" required>

				<label for=\"email\">Email *</label>
				<input type=\"email\" id=\"email\" required>

				<label for=\"phone\">Phone *</label>
				<input type=\"tel\" id=\"phone\" required>

				<label for=\"subject\">Subject *</label>
				<input type=\"text\" id=\"subject\" required>

				<label for=\"comment\">Comment *</label>
				<textarea id=\"comment\" required></textarea>

				<button type=\"submit\" id=\"submit-quote\">Send</button>
			</form>
			<div id=\"quote-section\" class=\"tabcontent\">
				<div class=\"quote-list-header-container\">
					<div class=\"quote-list-header\">Item</div>
					<div class=\"quote-list-header\">Code</div>
					<div class=\"quote-list-header\">Book</div>
					<div class=\"quote-list-header\">Page No</div>
					<div class=\"quote-list-header\">Quantity</div>
				</div>
				<div class=\"quote-list-container\">
					<div class=\"quote-list-item\"><input id=\"item\" type=\"text\" placeholder=\"Item\"></div>
					<div class=\"quote-list-item\"><input id=\"code\" type=\"text\" placeholder=\"Code\"></div>
					<div class=\"quote-list-item\"><input id=\"book\" type=\"text\" placeholder=\"Book\"></div>
					<div class=\"quote-list-item\"><input id=\"page-no\" type=\"text\" placeholder=\"Page No\"></div>
					<div class=\"quote-list-item\"><input id=\"quantity\" type=\"text\" placeholder=\"Quantity\"></div>
				</div>
				<button class=\"quote-item-add-button\">Add</button>
			</div>
		</div>
	</div>
	</div>
	";

	return $content;
}
